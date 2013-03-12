/* Layout: One Column
Theme: Basic Gray

Appearance.css contains the costmetic properties for your order 
form, such as fonts, colors, background images and borders.

NOTE: There are additional classes that are not listed here 
because they currently have no attributes. You can locate 
these by downloading and using Firebug.
===============================================================*/

/*@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);
This is the correct location for import, remove import link in layout.css when ready
*/

body, td {
  font: 15px/1.5  'Open Sans', Helvetica, Arial, sans-serif;
	color: #222;
	}
	
img, img a {
    border: 0 none;
	}



/* PRODUCT GRID
===============================================================*/

.priceBold {
	/* Price subtotal on bottom right of product grid */
	font-weight: bold;
	}

.discountedPrice {
	text-decoration: line-through;
	}

.totalPrice {
	/* Subtotal label on bottom left of product grid */
	font-weight: bold;
	}

.optionChosen {
	font-style: italic;
	color: #999;
	font-size: 14px;
	}

.updateCart {
	/* Link to update quantity */
	font-size: 10px;
	}

.promoField {
    /* Text fields for promo code */
	border: 1px solid #ddd;
	border-radius: 2px;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
    font-size: 13px;
	}



/* FORMS
===============================================================*/

.checkout, .checkoutShort, .checkoutShortest, .checkoutBottom, .checkoutTop, .qtyField, .optionsDrop  {
	/* Form fields used in checkout forms */
	border: 1px solid #ddd;
	border-radius: 2px;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
    font-size: 13px;
	color: #222;
	}

.checkoutDone, .checkoutTopDone, .checkoutBottomDone {
	/* Form fields used on confirmation page */
    font-size: 13px;
	color: #222;
	}

.viewCart, .shippingTable, .billingTable, .paymentMethodTable, .shipMethodTable, .payplanTable, .orderSummary {
	outline: 1px solid  #ddd;
    border-collapse: collapse;
	}
	
.viewCart th, .viewCartShort th, .payPlan th, .summaryCart th, .shippingInfo th, .billingInfo th, .billingTable th, .shippingTable th, .paymentInfo th, .signinTable th, .paymentMethodTable th, .shipMethodTable th, .payplanTable th, .orderSummary th {
	background: #eee;
	background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#dddddd));
	background: -moz-linear-gradient(top,   #ffffff,  #dddddd);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dddddd');
    }

.viewCart td, .viewCartShort td, .payPlan td, .summaryCart td, .shippingInfo td, .billingInfo td, .paymentInfo td, .orderSummary td {
	border-top: 1px solid  #ddd;
	}

.subtotal {
	background-color: #f5f5f5;
	font-weight: bold;
	}

.cartDiscount {
    /* Discount text */
	color: #f00;
    }

.paymentDate, .paymentAmount, .financeDate, .financeAmount { /* Shown in payplan pay schedule box */
	font-size: 12px;
	}

.payplanSummaryHeader { /* Header for payplan pay schedule box */
	font-size: 12px;
	font-weight: bold;
	}



/* UPSELLS
===============================================================*/

#upsellContainer {
  	overflow: hidden;
	}

.upsell {
	background-color: #fcfbe9;
	border: 1px solid #f1edb4;
	}

.upsellRegPrice {
	font-style: italic;
	}

.upsellPrice {
	color: #ff0000;
	}
	
.upsell img {
	border: 1px solid #ddd;
	}



/* TYPOGRAPHY
===============================================================*/

h1 {
    /* Used for product names */
	font-size: 16px;
	}

h2 {
    /* Used for upsell product names */
    font-size: 16px;
    }

h3 {
    /* Used for upsell headline */
    font-size: 15px;
	font-weight: normal;
    color: #555;
	text-transform: uppercase;	
	}



/* LINKS AND BUTTONS
===============================================================*/

a {
	color: #1675a2;
	}

a:hover {
	color: #1675a2;
	}

.codeButton, .continueButton  {
	display: inline-block;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	font-weight: bold;
	font-size: 14px;
	color: #fff;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	box-shadow: 0 1px 2px rgba(0,0,0,.2);
	border: solid 1px #666;
	background: #444;
	background: -webkit-gradient(linear, left top, left bottom, from(#777777), to(#444444));
	background: -moz-linear-gradient(top,  #777777,  #444444);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#777777', endColorstr='#444444');
    }
	
.upsellButton  {
	display: inline-block;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	font-weight: bold;
	font-size: 12px;
	color: #fff;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	-webkit-border-radius: 3px; 
	-moz-border-radius: 3px;
	border-radius: 3px;
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.1);
	-moz-box-shadow: 0 1px 1px rgba(0,0,0,.1);
	box-shadow: 0 1px 1px rgba(0,0,0,.1);
	border: solid 1px #666;
	background: #444;
	background: -webkit-gradient(linear, left top, left bottom, from(#777777), to(#444444));
	background: -moz-linear-gradient(top,  #777777,  #444444);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#777777', endColorstr='#444444');
    }

.codeButton:hover, .continueButton:hover, .upsellButton:hover {
	color: #fff;
    background: #444;
	background: -webkit-gradient(linear, left top, left bottom, from(#888888), to(#555555));
	background: -moz-linear-gradient(top,  #888888,  #555555);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#888888', endColorstr='#555555');
	text-decoration: none;
	}

.codeButton:active, .continueButton:active, .upsellButton:active {
	position: relative; 
	top: 1px;
    }



/* MISC
===============================================================*/

.errorMessage {
	color: #dd4949;
	}
