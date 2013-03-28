Infusion("Ecomm.OrderForms", function() {

    var ns = Infusion.Ecomm.OrderForms;

    var messages = {};

    ns.init = init;
    ns.placeOrder = placeOrder;
    ns.ajaxSubmitForm = ajaxSubmitForm;
    ns.submitProductOptions = submitProductOptions;
    ns.copyShipping = copyShipping;
    ns.submitFormUponChangeOnShipping = submitFormUponChangeOnShipping;
    ns.submitFormUponChangeOnBilling = submitFormUponChangeOnBilling;
    ns.placeOrderRetry = placeOrderRetry;
    ns.initPaymentSelection = initPaymentSelection;
    ns.formProcessing = formProcessing;
    ns.bindTooltip = bindTooltip;

    function init(internationalizedMessages) {
        for (var key in internationalizedMessages) {
            if (internationalizedMessages.hasOwnProperty(key)) {
                messages[key] = internationalizedMessages[key];
            }
        }
    }

    function placeOrderRetry() {
        var validationError = validatePaymentSelection();

        if (validationError != "") {
            alert(validationError);
        } else {
            var formAction = Infusion.Url.getViewUrl('orderFormProcessing', 'placeOrderRetry');
            jQuery('#orderFormLockDownForm').attr("action", formAction);
            jQuery('#orderFormLockDownForm').submit();
        }
    }

    // Places an order through the order form
    function placeOrder(needsShippingInfo, formName, proceedToCheckout, removePurchasableProductId, upSellId) {

        var errorMessages = validateOptions();

        if (needsShippingInfo == "true") {

            var shippingRadioButtons = jQuery('input[id^=shipping]');
            var shippingSelected = false;
            shippingRadioButtons.each(function() {
                var radio = jQuery(this);
                if (radio.is(':checked')) {
                    shippingSelected = true;
                    return false;
                }
            });

            if (!shippingSelected) {
                errorMessages += "\nYou must select a shipping option.";
            }
        }

        if (errorMessages.length > 0) {
            errorMessages = errorMessages.replace(/^\n+/, "");
            alert(errorMessages);
            return;
        }

        var validationError = validatePaymentSelection();

        if (validationError != "") {
            alert(validationError);
        } else {
            if (jQuery("#submitted").val() == "true") {
                alert("Your order is currently being processed.");
                return;
            } else {
                addHiddenFields();
                submitForm(formName, proceedToCheckout, removePurchasableProductId, upSellId);
            }
        }
    }

    //Validates the required status on the for submitted product options
    function validateOptions() {

        var errorMessage = '';

        jQuery('input[id*="_req"]').each(function() {
            var isRequired = jQuery(this).val();
            var newId = this.id.replace(/req/, 'opt');
            var $option = jQuery('#' + newId);
            var selectedValue = $option.val();
            var tagName = $option.get(0).tagName;

            if ('SELECT' == tagName) {
                if ( isRequired === 'true' && (selectedValue == 0 || selectedValue == '') ) {
                    errorMessage += '\n' + $option.find(":selected").text() + ".";
                }
            } else if ('INPUT' == tagName) {

                var productIdFieldName = this.id.replace(/req/, 'pid');
                var productId = jQuery('#' + productIdFieldName).val();

                var defaultValueFieldName = this.id.replace(/req/, 'def');
                var defaultValue = jQuery('#' + defaultValueFieldName).val();

                if (selectedValue == defaultValue) {
                    selectedValue = '';
                }

                var labelFieldName = this.id.replace(/req/, 'lab');
                var label = jQuery('#' + labelFieldName).val();
                if(isRequired === 'true' || selectedValue.length > 0){
                    var result = sjax("/Product/checkRawOption.jsp?pid=" + productId + "&order=" + this.id.substring(this.id.length - 1) + "&texter=" + selectedValue, "");
                    if (result) {
                        result = result.replace(/^\n+/, "");
                        if(result.length > 0) {
                            errorMessage += '\n\n[' + label + ']\n' + result;
                        }
                    }
                }
            }
        });

        return errorMessage;
    }

    //Submits the form without AJAX
    function submitForm(formName, proceedToCheckout, removePurchasableProductId, upSellId) {

        formProcessing(proceedToCheckout, removePurchasableProductId, upSellId);

        var formAction = Infusion.Url.getViewUrl("orderFormProcessing", "updateOrderForm");
        jQuery('#' + formName).attr("action", formAction);

        jQuery('#' + formName).submit();
    }

    //Submits the form with AJAX, it updates the the elements specified after the changes have been submitted.
    function ajaxSubmitForm(formName, proceedToCheckout, removePurchasableProductId, upSellId, orderFormId, cartRenderAction, elementsToUpdate) {

        formProcessing(proceedToCheckout, removePurchasableProductId, upSellId);

        var formAction = Infusion.Url.getViewUrl("orderFormProcessing", "asynchronousUpdateOrderForm");
        jQuery('#' + formName).attr("action", formAction);

        var callBackUpdate = function () {

            //Loop through the elements and refresh each one individually
            for (var x = 0; x < elementsToUpdate.length; x++) {
                //For each element, we want the 'loading' spinner to appear in lieu of the content, so the user will not
                //interact with any inputs while the ajax request is waiting ofr a response (INF-15860).
                var showSpinner = true;

                //The height passed into the ajax request so the original table dimensions is maintined with the loading
                //spinner. This is to prevent the 'jittery' look of the order form when the content is refreshed quickly.
                var elementTable = jQuery('#' + elementsToUpdate[x]).find('table');
                var eleHeight =  elementTable.height() + "px";
                var elementTableStyle = elementTable.attr('class');

                //Do not display a 'loading' spinner for upsell content. It is not necessary
                if(elementsToUpdate[x] == 'UP_SELLS'){
                    showSpinner = false;
                }

                var divURL = Infusion.Url.getViewUrl("orderFormRendering", "renderOrderFormElement");
                Infusion.Ajax.ajaxFill({
                    url: divURL,
                    id: elementsToUpdate[x],
                    data: {
                        orderFormId: orderFormId,
                        elementType: elementsToUpdate[x],
                        cartRenderAction: cartRenderAction
                    },
                    dataType: "html",
                    showSpinner: showSpinner,
                    tableStyle: elementTableStyle,
                    tableHeight: eleHeight
                });

            }

            //Reset the hidden fields
            jQuery('#purchasableProductIds').val('');
            jQuery('#quantities').val('');
            jQuery('#removePurchasableProductId').val('');
            jQuery('#upSellId').val('');
            jQuery('#proceedToCheckout').val('false');
        };

        //Submit the form to update the state of the order
        Infusion.Ajax.ajaxSubmit({skipNotice: true, afterSubmit: callBackUpdate, id: formName});
    }

    //Submits a set of product options to record
    function submitProductOptions(formName, proceedToCheckout, removePurchasableProductId, upSellId, orderFormId, cartRenderAction, elementsToUpdate, purchasableProductId, order) {

        if (getProductOptions(purchasableProductId, order)) {
            ajaxSubmitForm(formName, proceedToCheckout, removePurchasableProductId, upSellId, orderFormId, cartRenderAction, elementsToUpdate);

            //Reset the hidden fields that drive the product option selection
            jQuery("#optionsPurchasableProductId").val('');
            jQuery("#productOptionId").val('');
            jQuery("#productOption").val('');
        }
    }

    //Gets the options that were set for the product specified and sets it into the form so that it will be posted
    function getProductOptions(purchasableProductId, order) {

        var $option = jQuery('#' + purchasableProductId + '_opt' + order);
        var productOptions = $option.val();
        var productOptionIds = jQuery('#' + purchasableProductId + '_opt' + order + '_hidden').val();

        if (productOptionIds.length > 0) {
            jQuery("#optionsPurchasableProductId").val(purchasableProductId);
            jQuery("#productOptionId").val(productOptionIds);
            jQuery("#productOption").val(productOptions);
        }

        return true;
    }

    function reloadCustomHTML() {
        var viewUrl = Infusion.Url.getViewUrl("orderFormManagement", "getCartLayoutHtmlElements");
    }

    //Prepares all of the data needed in order to submit the update cart request
    function formProcessing(proceedToCheckout, removePurchasableProductId, upSellId) {

        var purchasableProductIds = [];
        var purchasableProductIdQueryString = "";
        var quantities = [];
        var quantityQueryString = "";

        jQuery('input[name^="qty_"]').each(function() {
            purchasableProductIds.push(jQuery(this).attr("name").replace(/qty_/, ""));
            quantities.push(jQuery(this).val());
        });

        for (var x = 0; x < purchasableProductIds.length; x++) {
            purchasableProductIdQueryString += purchasableProductIds[x];
            if (x < purchasableProductIds.length - 1) {
                purchasableProductIdQueryString += ",";
            }
        }

        for (var x = 0; x < quantities.length; x++) {
            quantityQueryString += quantities[x];
            if (x < quantities.length - 1) {
                quantityQueryString += ",";
            }
        }

        jQuery('#purchasableProductIds').val(purchasableProductIdQueryString);
        jQuery('#quantities').val(quantityQueryString);

        if (removePurchasableProductId > 0) {
            jQuery('#removePurchasableProductId').val(removePurchasableProductId);
        }

        if (upSellId > 0) {
            jQuery('#upSellId').val(upSellId);
        }

        if (proceedToCheckout) {
            jQuery('#proceedToCheckout').val('true');
        } else {
            jQuery('#proceedToCheckout').val('false');
        }
    }

    //Copies the billing address to the shipping address
    function copyShipping(copyCheckBox, targetPage, stateLabel, formName, orderFormId, cartRenderAction) {
        if (copyCheckBox.checked) {

            if(targetPage == 'onestep' || targetPage == 'register'){
                jQuery('#shipFirstName').val(jQuery('#firstName').val());
                jQuery('#shipLastName').val(jQuery('#lastName').val());
                jQuery('#shipCompany').val(jQuery('#company').val());
                jQuery('#shipAddressLine1').val(jQuery('#addressLine1').val());
                jQuery('#shipAddressLine2').val(jQuery('#addressLine2').val());
                jQuery('#shipCity').val(jQuery('#city').val());
                jQuery('#shipZipCode').val(jQuery('#zipCode').val());
                jQuery('#shipPhoneNumber').val(jQuery('#phoneNumber').val());

                //State
                jQuery('#state').val(jQuery('#state').val().toUpperCase());
                jQuery('#shipState').val(jQuery('#state').val());

                //Country...
                jQuery('#shipCountry').val(jQuery('#country').val());

                if (jQuery('#shipCountry').val() == 'United States' || jQuery('#shipCountry').val() == 'Canada') {
                    jQuery('#shippingStateRequired').html('*' + stateLabel);
                } else {
                    jQuery('#shippingStateRequired').html(stateLabel);
                }

                var $shipCountry = jQuery('#shipCountry');
                var shippingStateRequired = false;
                if ($shipCountry.val() == 'United States' || $shipCountry.val() == 'Canada') {
                    shippingStateRequired = true;
                }
                submitFormUponChangeOnShipping(formName, orderFormId, cartRenderAction, shippingStateRequired);
            }
        }
    }

    function submitFormUponChangeOnShipping(formName, orderFormId, cartRenderAction, shipStateRequired) {
        if (shipStateRequired) {
            if (jQuery('#shipAddressLine1').val() != ''
                && jQuery('#shipCity').val() != ''
                && jQuery('#shipZipCode').val() != ''
                && jQuery('#shipCountry').val() != ''
                && jQuery('#shipState').val() != '') {

                ajaxSubmitForm(formName, false, 0, 0, orderFormId, cartRenderAction, ['ORDER_FORM_PRODUCT_LIST', 'SHIPPING_OPTIONS', 'ORDER_FORM_SUMMARY', 'PAYMENT_PLANS'])
            }
        } else {
            if (jQuery('#shipAddressLine1').val() != ''
                && jQuery('#shipCity').val() != ''
                && jQuery('#shipZipCode').val() != ''
                && jQuery('#shipCountry').val() != '') {

                ajaxSubmitForm(formName, false, 0, 0, orderFormId, cartRenderAction, ['ORDER_FORM_PRODUCT_LIST', 'SHIPPING_OPTIONS', 'ORDER_FORM_SUMMARY', 'PAYMENT_PLANS'])
            }
        }
    }

    function submitFormUponChangeOnBilling(formName, orderFormId, cartRenderAction, stateRequired) {
        if (stateRequired) {
            if (jQuery('#addressLine1').val() != ''
                && jQuery('#city').val() != ''
                && jQuery('#zipCode').val() != ''
                && jQuery('#country').val() != ''
                && jQuery('#state').val() != '') {
                ajaxSubmitForm(formName, false, 0, 0, orderFormId, cartRenderAction, ['ORDER_FORM_PRODUCT_LIST', 'SHIPPING_OPTIONS', 'ORDER_FORM_SUMMARY', 'PAYMENT_PLANS'])
            }
        } else {
            if (jQuery('#addressLine1').val() != ''
                && jQuery('#city').val() != ''
                && jQuery('#zipCode').val() != ''
                && jQuery('#country').val() != '') {
                ajaxSubmitForm(formName, false, 0, 0, orderFormId, cartRenderAction, ['ORDER_FORM_PRODUCT_LIST', 'SHIPPING_OPTIONS', 'ORDER_FORM_SUMMARY', 'PAYMENT_PLANS'])
            }
        }
    }


    function initPaymentSelection() {
        if (jQuery('#cardType').val() !== "Maestro") {
            maestroNotSelected();
        }

        jQuery('#creditCardType').live("click", function() {
            jQuery('tr.cellLow').show();
            if (jQuery('#cardType').val() !== "Maestro") {
                maestroNotSelected();
            } else {
                maestroSelected();
            }
        });

        jQuery('#payPalType').live("click", function(e) {
            if (jQuery('#shippingRequired').val() === "true") {
                alert("Please note that your shipping address will be overwritten with the address you choose using PayPal.");
            }
            jQuery('tr.cellLow').hide();
            maestroNotSelected();
            e.stopImmediatePropagation();
        });

        jQuery('#cardType').live('change', function() {
            if (jQuery('#cardType').val() !== "Maestro") {
                maestroNotSelected();
            } else {
                maestroSelected();
            }
        });

        bindTooltip('tooltip');

        function maestroSelected() {
            jQuery('tr.maestro').show();
        }

        function maestroNotSelected() {
            jQuery('tr.maestro').hide();
        }
    }

    function validatePaymentSelection() {
        var validationError = "";
        var isCreditCardSelected = false;

        // If there are radio buttons of payment type (meaning there is more than one payment option)
        if (jQuery('input:radio[name=paymentType]').length > 0) {
            var payTypeRadio = jQuery('input:radio[name=paymentType]:checked').val();

            if (!payTypeRadio) {
                validationError = validationError + messages["orderform.paymentType.required.error"];
            } else if (payTypeRadio == 'creditcard') {
                isCreditCardSelected = true;
            }

        } else if (jQuery('#creditCardType').val() == 'creditcard') {
            isCreditCardSelected = true;
        }

        if (isCreditCardSelected) {

            var cardNumber = jQuery('#cardNumber').val();

            if (jQuery.trim(cardNumber).length == 0) {
                validationError = validationError + messages["orderform.validation.creditCard.number.required.error"] + "\n";
            } else {
                var cardFormat = /^\d{14,19}$/;
                if (!cardFormat.test(cardNumber)) {
                    validationError = validationError + messages["orderform.validation.creditCard.number.format.error"] + "\n";
                }
            }

            var cvcField = jQuery('#verificationCode');
            if (cvcField.length > 0) {
                if (jQuery.trim(cvcField.val()).length == 0) {
                    validationError = validationError + messages["orderform.validation.creditCard.cvc.required.error"] + "\n";
                } else {
                    var cvcFormat = /^\d{3,4}$/;
                    if (!cvcFormat.test(cvcField.val())) {
                        validationError = validationError + messages["orderform.validation.creditCard.cvc.format.error"] + "\n";
                    }
                }
            }
        }

        return validationError;
    }

    function bindTooltip(className){
        jQuery('.'+className).qtip({
            content: '<img src="/resources/styledcart/images/tooltip-box.png" />',
            position: {
                corner: {
                    target: 'topMiddle',
                    tooltip: 'bottomMiddle'
                }
            },
            style: {
                border: {
                    width: 0
                },
                background: '#ffffffff',
                width: 206,
                padding: 1
            }
        });

    }
});