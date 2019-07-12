;define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function($) {
        "use strict";
        //creating jquery widget
        $.widget('VendorName.Popup', {
            options: {
                modalForm: '#popup',
                modalButton: '#product-addtocart-button'
            },
            _create: function() {
                this.options.modalOption = this.getModalOptions();
                this._bind();
            },
            getModalOptions: function() {
                /** * Modal options */
                var options = {
                    type: 'popup',
                    responsive: true,
                    clickableOverlay: false,
                    title: $.mage.__('PopUp'),
                    modalClass: 'popup',
                    buttons: [{
                        text: $.mage.__('Yes, I got you!'),
                        class: '',
                        click: function () {
                            this.closeModal();
                        }
                    }]
                };
                return options;
            },
            _bind: function(){
                var modalOption = this.options.modalOption;
                var modalForm = this.options.modalForm;
                $(document).on('click', this.options.modalButton, function(){
                    $(modalForm).modal(modalOption);
                    $(modalForm).trigger('openModal');
                });
            }
        });

        return $.VendorName.Popup;
    }
);