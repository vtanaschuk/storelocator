define([
    'jquery',
    'underscore',
    'Magento_Ui/js/modal/alert',
    'IdeaInYou_StoreLocator/js/store/storeLocatorMap'
], function ($, _, alert, map) {
    $.widget('IdeaInYou.storeLocatorForm', {
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
            $(this.options.formSelector).parent().on('submit', this.formClick.bind(this))

        },

        formClick: function (e) {
            let self = this;
            e.preventDefault();
            $.ajax({
                url: this.options.submitUrl,
                type: 'GET',
                datatype: 'json',
                data: {
                    storeName : $("#storeName").val(),
                    description : $("#description").val(),
                    country : $("#country").val(),
                    state : $("#state").val(),
                    city : $("#city").val(),
                    address : $("#address").val(),
                    post : $("#post").val(),
                    lat : $("#lat").val(),
                    lng : $("#lng").val(),
                },

            }).done(
                function (data) {




                    if (data.success) {

                        $(self.options.formSelector).hide();
                        $(self.options.messageSelector).show();

                        let row = document.createElement("tr");

                        const attr1 = document.createAttribute("data-latitude");
                        attr1.value = data.data.lat;
                        const attr2 = document.createAttribute("data-longitude");
                        attr2.value = data.data.lng;

                        row.classList.add('mapZoom');

                        row.setAttributeNode(attr1);
                        row.setAttributeNode(attr2);

                        row.innerHTML =
                            '<td>'+data.data.storeName+'</td>' +
                            '<td>'+data.data.description+'</td>' +
                            '<td>'+data.data.country+'</td>' +
                            '<td>'+data.data.state+'</td>' +
                            '<td>'+data.data.city+'</td>' +
                            '<td>'+data.data.address+'</td>' +
                            '<td>'+data.data.post+'</td>'+
                            '<td>'+data.data.lat+'</td>'+
                            '<td>'+data.data.lng+'</td>';

                        document.querySelectorAll("#mapTable tbody")[0].appendChild(row);


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
            });
        }
    });

    return $.IdeaInYou.storeLocatorForm;
});

