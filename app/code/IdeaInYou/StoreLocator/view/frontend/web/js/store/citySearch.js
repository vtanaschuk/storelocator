define([
    'jquery',
    'mage/url',
    'jquery/ui'

], function ($,urlbuild) {
    'use strict';

    $.widget('namespace.widgetname', {
        options: {
            autocomplete: 'off',
            minSearchLength: 2,
        },

        _create: function () {
            this.element.attr('autocomplete', this.options.autocomplete);
            $(this.element).autocomplete({
                source: function( request, response ) {
                    $.ajax( {
                        url: urlbuild.build('/ancustomer/city/search'),
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    } );
                },
                minLength: 3,
                // appendTo: "#city_results"
            });
        },

        // Private method (begin with underscore)
    });

    return $.namespace.widgetname;
});
