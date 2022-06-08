define([
    'jquery',
    'underscore',
    'Magento_Ui/js/modal/alert',
    'Magento_Ui/js/model/messageList'
], function ($, _, alert) {
    $.widget('mage.storeLocator', {
        options: {
            formSelector: '',
            submitUrl: '',
            messageSelector: ''
        },

        _create: function () {
            this._super();
            this._bindSubmit();
        },

        _bindSubmit: function () {
            $(this.options.formSelector).on('submit', this.formClick.bind(this))
        },

        formClick: function (e) {
            let self = this;
            e.preventDefault();
            $.ajax({
                url: this.options.submitUrl,
                type: 'GET',
                data: {
                    storeName : $("#storeName").val(),
                    description : $("#description").val(),
                    country : $("#country").val(),
                    state : $("#state").val(),
                    city : $("#city").val(),
                    address : $("#address").val(),
                    post : $("#post").val(),
                },
            }).done(function (data) {
                if (data.success) {
                    $(self.options.formSelector).hide();
                    $(self.options.messageSelector).show();

                    $("#mapTable").load(document.URL + " #mapTable>*");
                    $("#map").load(document.URL + "#map");


                    setTimeout(function () {
                        $(self.options.messageSelector).hide();
                    }, 3000)

                } else {
                    alert({
                        title: $.mage.__('Something wrong'),
                        content: $.mage.__(data.error_message + '\nPlease, try again!')
                    });
                }
            }).error(function (qXHR, textStatus, errorThrown) {
                alert({
                    title: $.mage.__('Something wrong'),
                    content: $.mage.__('Please, try again!')
                });
                console.log(qXHR, textStatus, errorThrown)
            });
        }
    });

    return $.mage.storeLocator;
});

