/* Layout: One Column
Theme: Basic Gray

Layout.css contains the layout properties for your order form, 
including width, height, margin, padding, position, float, 
display and text-align.

NOTE: There are additional classes that are not listed here 
because they currently have no attributes. You can locate 
these by downloading and using Firebug.
===============================================================*/

@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic);
/* The above link needs to be moved to appearance.css */

* {
    margin: 0;
    padding: 0;
}

#wrapper {
    /* Wraps around everything and sets the total width of the order form */
    position: relative;
    width: 960px;
    margin: 0 auto;
}

#header {
    /* The top area that contains your banner or logo */
    width: 960px;
}

#content {
    /* Content wrapper */
    position: relative;
    width: 960px;
    margin: 0 auto;
}



/* PRODUCT GRID
===============================================================*/

.productImage {
    /* Image in the product grid */
    margin: 8px 0 10px 0;
    border: 1px solid #eee;
}

.price {
    /* Price in the right column of the product grid */
    display: block;
}

.productDescription {
    /* Paragraph for short product description */
    margin-bottom: 13px;
}

.optionsDrop {
    /* Dropdown for product options */
    padding: 4px 4px 4px 6px;
    margin-bottom: 13px;
    width: 200px;
}

.subscriptionPlan {
    display: block;
}

.qtyField {
    /* Quantity field in product grid */
    padding: 4px 4px 4px 6px;
    width: 30px;
    display: block;
    text-align: right;
    margin: 0 auto;
    margin-bottom: 5px;
}



/* HTML AREAS (Insert custom HTML by going to the HTML area tab)
===============================================================*/

#topCustomHTML {
    /* HTML area below header image. */
    margin: 35px 0 15px 0;
}

#middleCustomHTML {
    /* HTML area below product grid. */
    margin: 35px 0 60px 0;
    clear: both;
}

#bottomCustomHTML {
    /* This is your footer. */
    width: 960px;
    margin: 40px auto 20px auto;
    padding: 15px;
    text-align: center;
    clear: both;
}



/* FORMS
===============================================================*/

input {
    margin: 0 0 7px 0;
}

.paymentLabel {
    /* Labels for payment method table */
    display: block;
}

.choosePlan {
    /* Radio buttons used to choose pay plan or shipping option */
    margin-right: 5px;
}



/* Form fields and labels
---------------------------------------------*/

.checkout, .checkoutDone {
    /* Form fields used in checkout forms */
    padding: 4px 4px 4px 6px;
    margin: 0;
    width: 200px;
}

.checkoutBottom, .checkoutBottomDone {
    /* Provides bottom padding for last form field in a form */
    padding: 4px 4px 4px 6px;
    margin: 0 0 20px 0;
    width: 200px;
}

.checkoutTop, .checkoutTopDone {
    /* Provides top padding for first form field in a form */
    padding: 4px 4px 4px 6px;
    margin: 10px 0 0 0;
    width: 200px;
}

.checkoutLabel {
    /* Checkout form label */
    padding: 0 0 -3px 0;
    margin: 0 0 -3px 0;
}

.checkoutShort, .promoField {
    /* Smaller form field */
    padding: 4px;
    margin: 0;
    width: 125px;
}

.promoLabel {
    padding-top: 3px;
}

.checkoutShortest {
    /* Even smaller form field */
    padding: 5px;
    margin: 0;
    width: 70px;
}

.addressTableInfo {
    margin-bottom: 0px;
}

.paymentIcon {
    /* Credit card, pay pal and check icons in payment information table */
    margin: 0 7px -5px 4px;
}



/* Tables
---------------------------------------------*/

.viewCart {
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0 15px 0;
    float: left;
    border-radius: 4px;
}

.viewCart th, .billingTable th, .shippingTable th, .shipMethodTable th, .paymentMethodTable th, .payplanTable th, .orderSummary th {
    padding: 10px 10px 10px 15px;
    text-align: left;
}

.viewCart td, .shipMethodTable td, .paymentMethodTable td, .payplanTable td, .orderSummary td {
    padding: 10px 10px 10px 15px;
    vertical-align: top;
}

.billingTable td, .shippingTable td {
    padding: 8px 0 0 15px;
    vertical-align: top;
}

.billingTable {
    /* Table for entering billing address */
    width: 470px;
    border-collapse: collapse;
    margin: 0 20px 20px 0;
    text-align: left;
    float: left;
    height: 500px;
}

.shippingTable {
    /* Table for entering shipping address */
    width: 470px;
    border-collapse: collapse;
    margin: 0 0 20px 0;
    text-align: left;
    float: right;
    height: 500px;
}

.orderSummary {
    /* Table for order form summary */
    position: relative;
    width: 470px;
    border-collapse: collapse;
    margin-bottom: 20px;
    text-align: left;
    float: right;
    clear: right;
}

.shipMethodTable {
    /* Table for shipping options */
    width: 470px;
    border-collapse: collapse;
    margin-bottom: 20px;
    margin-right: 20px;
    text-align: left;
    float: left;
    clear: left;
}

.payplanTable {
    /* Table for choosing pay plan */
    width: 470px;
    border-collapse: collapse;
    margin-bottom: 20px;
    text-align: left;
    float: left;
}

#shipPaymentContainer {
    width: 470px;
    float: left;
}

.tableOption { /**/
    /* Paragraph for shipping or pay plan option */
    margin: 0 0 11px 0;
}

.payplanSummary { /* Box that shows payment schedule for payment plan */
    background-color: #fff;
    width: 200px;
    margin: -12px 0 15px 0;
}

.paymentDate { /* Date shown in .paypanSummary box */
    width: 100px;
    display: inline-block;
    border-bottom: 1px dashed #ddd;
}

.paymentAmount { /* Payment amount shown in .paypanSummary box */
    width: 65px;
    text-align: right;
    display: inline-block;
    border-bottom: 1px dashed #ddd;
}

.financeDate { /* Finance charge label shown in .paypanSummary box */
    color: #777;
    font-style: italic;
    width: 100px;
    display: inline-block;
}

.financeAmount { /* Finance charge amount shown in .paypanSummary box */
    color: #777;
    font-style: italic;
    width: 65px;
    text-align: right;
    display: inline-block;
}

.promoCode {
    /* Table for promo code field */
    width: 453px;
    border-collapse: collapse;
    margin-left: 15px;
}

.promoCode td {
    height: 30px;
}

.paymentMethodTable {
    /* Table for entering payment method */
    width: 100%;
    border-collapse: collapse;
    margin: -5px 0 10px 0;
    text-align: left;
    float: right;
}

td.pay1 {
    /* First column in .paymentMethodTable */
    width: 220px;
    padding-bottom: 20px;
}

td.pay2 {
    /* First column in .paymentMethodTable */
    width: 231px;
    padding-bottom: 20px;
}

td.pay3 {
    /* First column in .paymentMethodTable */
    width: 186px;
    padding-bottom: 20px;
}

td.pay4 {
    /* First column in .paymentMethodTable */
    width: 314px;
    padding-bottom: 20px;
}

td.rightAlign {
    text-align: right;
    vertical-align: top;
    padding-top: 10px;
    height: 20px;
}

th.rightAlign {
    text-align: right;
}

th.rightAlignTop {
    text-align: right;
    vertical-align: top;
    padding-top: 20px;
    width: 150px;
}

td.rightAlignTop {
    text-align: right;
    padding-top: 20px;
    width: 150px;
    height: 20px;
}

td.rightAlignBottom {
    text-align: right;
    vertical-align: top;
    padding: 10px 10px 20px 0;
    width: 150px;
}

th.leftAlign {
    text-align: left;
    height: 15px;
}

td.leftAlign {
    text-align: left;
}

td.centerAlign, th.centerAlign {
    text-align: center;
}

td .rightCell {
    text-align: right;
}

.productCell {
    width: 80%; !important
}

.qtyCell {
    width: 10%; !important
}

.priceCell {
    width: 10%; !important
}

.checkoutLinks {
    /* Container for 'Checkout' and 'Continue Shopping' buttons */
    width: 300px;
    height: 30px;
    margin: 0 0 40px 0;
    text-align: right;
    float: right;
    clear: both;
}



/* UPSELLS
===============================================================*/

#upsellContainer {
    /* Contains all upsells */
    width: 960px;
    margin-bottom: 60px;
    clear: both;
}

.upsell {
    /* Box that contains single upsell */
    width: 283px;
    float: left;
    margin: 0 10px 20px 0;
    padding: 10px 10px 12px 15px;
}

.upsellImage {
    float: left;
    margin: 6px 15px 0 0;
}

.upsellItem {
    /* Product name */
    font-weight: bold;
    margin-right: 10px;
}

.upsellAdd {
    /* Add to cart button for upsells */
    float: right;
    margin: 7px 7px 0 0;
}

.upsellPrice {
    margin-left: 9px;
}



/* TYPOGRAPHY
===============================================================*/

h1 {
    /* Used for product names */
    margin: 2px 0 2px 0;
}

h2 {
    /* Used for upsell product names */
    margin-right: 10px;
    display: inline;
}

#upsellContainer h2 {
    /* Used for upsell product names */
    margin: 5px 12px 0 0;
    display: inline-block;
}

h3 {
    /* Used for upsell headline */
    margin: 0 0 5px 0;
    padding-bottom: 3px;
}



/* LINKS AND BUTTONS
===============================================================*/

a {
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.codeButton {
    padding: 3px 15px 3px 15px;
    margin: 0 0 0 15px;
    cursor: pointer;
}

.continueButton {
    padding: 3px 15px 3px 15px;
    margin: 10px 0 0 10px;
    cursor: pointer;
}

.upsellButton {
    margin: 0 0 0 1px;
    padding: 1px 8px 2px 8px;
    cursor: pointer;
}
