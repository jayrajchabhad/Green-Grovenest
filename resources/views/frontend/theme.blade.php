@stack('styles')
<style>
.underline{
    height: 4px;
    width: 100px;
    background-color: {{$appSetting->line}};
    margin: 10px 0px;
}
 *{
    /* font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
    font-family:{{ $appSetting->font_style }};


}


/* home page css    */
/* Toast Notification Styling */
.toast-container {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: #333;
    color: #fff;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    opacity: 0;
    transform: translateX(-100%);
    transition: all 0.4s ease-in-out;
    
}

/* Show the Toast */
.toast-container.show {
    opacity: 1;
    transform: translateX(0);
}

/* Animation for Smooth Appearance */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.coupon-code{
    color: {{ $appSetting->header_footer}};
}
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.6) !important;
    backdrop-filter: blur(1px); /* Increase blur effect */
}

.modal-content {
    background: rgba(255, 255, 255, 0.95); /* Light background to ensure visibility */
    border-radius: 10px;
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.3);
    width: 400px;

}

.modal-body,
.modal-title {
    color: #333; /* Dark text for contrast */
    font-weight: bold;
}

.modal.fade .modal-dialog {
    transition: transform 0.3s ease-out;
}


.modal-dialog {
    position: fixed;
    left: 20px; /* Adjust the distance from the left */
    bottom: 50px; /* Adjust the distance from the bottom */
    max-width: 300px; /* Adjust modal width */
    margin: 0;
}



.modal-backdrop {
    display: none !important; /* Removes the full-screen dark overlay */
}
    .product-name a {
    display: block;
    white-space: nowrap;     
    overflow: hidden;       
    text-overflow: ellipsis; 
    max-width: 100%;         
}

.carousel-item img {
    width: 100%;
    height: 500px; /* Adjust this based on your design */
    object-fit: cover; /* Ensures images fill the space without distortion */
}
.selling-price{
    color: {{$appSetting->header_footer}};
}

@media (max-width: 768px) {
    .carousel-item img {
        height: 150px; /* Smaller height for mobile */
    }
}





/* footer */
.footer-area{
    padding: 40px 0px;
    
    background-color:{{ $appSetting->primary }};
    color: #fff;
}
.footer-area a{
    text-decoration: none;
}
.footer-area .footer-heading{

    font-size: 24px;
    color: #fff;
}
.footer-area .footer-underline{
    height: 1px;
    width: 70px;
    background-color: #ddd;
    margin: 10px 0px;
}
.copyright-area{
    padding: 14px 0px;
    background-color: #262626;
}
.copyright-area p{
    margin-bottom: 0px;
    color: #fff;
}
.copyright-area .social-media{
    text-align: end;

}
.copyright-area .social-media a{
    margin: 0px 10px;
    color: #fff;
    width: 20px;
}

/* footer-end */



.carousel-item .custom-carousel-content{

    width: 50%;
    transform: translate(0%, -10%);
}
.custom-carousel-content{
    text-align: start;
}
.custom-carousel-content h1{
    font-size: 40px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 30px;
}
.custom-carousel-content h1 span{
    color: #fbff00;
}
.custom-carousel-content p{
    font-size: 18px;
    font-weight: 400;
    color: #fff;

    margin-bottom: 30px;
}
.custom-carousel-content .btn-slider{
    border: 1px solid #fff;
    border-radius: 0px;
    padding: 8px 26px;
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* navbar css */

.main-navbar{
    border-bottom: 1px solid #ccc;
}
.main-navbar .top-navbar{

    background-color: {{ $appSetting->primary }} ;
    padding-top: 10px;
    padding-bottom: 10px;
}
.main-navbar .top-navbar .brand-name{
    color: #fff;
}
.main-navbar .top-navbar .nav-link{
    color: #fff;
    font-size: 16px;
    font-weight: 500;
}
.main-navbar .top-navbar .dropdown-menu{
    padding: 0px 0px;
    border-radius: 0px;
}
.main-navbar .top-navbar .dropdown-menu .dropdown-item{
    padding: 8px 16px;
    border-bottom: 1px solid #ccc;

    font-size: 14px;
}
.main-navbar .top-navbar .dropdown-menu .dropdown-item i{
    width: 20px;
    text-align: center;
    color: #2874f0;
    font-size: 14px;
}
.main-navbar .navbar{
    padding: 0px;
    background-color: #ddd;
}
.main-navbar .navbar .nav-item .nav-link{
    padding: 8px 20px;
    color: #000;
    font-size: 15px;
}

@media only screen and (max-width: 600px) {
    .main-navbar .top-navbar .nav-link{
        font-size: 12px;
        padding: 8px 10px;
    }
}

/* Category Start */

.category-card{
    border: 1px solid #ddd;
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
    margin-bottom: 24px;
    background-color: #fff;
}
.category-card a{
    text-decoration: none;
}
.category-card .category-card-img{
    max-height: 260px;
    overflow: hidden;
    border-bottom: 1px solid #ccc;
}
.category-card .category-card-body{
    padding: 10px 16px;
}
.category-card .category-card-body h5{
    margin-bottom: 0px;

    font-size: 18px;
    font-weight: 600;
    color: #000;
    text-align: center;
}
/* Category End */

/* Product Card */


.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
}


.product-card{
    background-color: #fff;
    margin-bottom: 24px;
}

.product-card a{
    text-decoration: none;
}
.product-card .stock{
    position: absolute;
    color: #fff;
    border-radius: 4px;
    padding: 2px 12px;
    margin: 8px;
    font-size: 12px;
}
.product-card .product-card-img{
    max-height: 300px;
    overflow: hidden;
    border-bottom: 1px solid #ccc;
    height: 290px; /* Fixed height for consistency */

}
.product-card .product-card-img img{
    width: 100%;

}
.product-card .product-card-body{
    padding: 10px 10px;
}
.product-card .product-card-body .product-brand{
    font-size: 14px;
    font-weight: 400;
    margin-bottom: 4px;
    color: #937979;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
.product-card .product-card-body .product-name{
    font-size: 20px;
    font-weight: 600;
    color: #000;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
.product-card .product-card-body .selling-price{
    font-size: 22px;
    color: #000;
    font-weight: 600;
    margin-right: 8px;
}
.product-card .product-card-body .original-price{
    font-size: 18px;
    color: #937979;
    font-weight: 400;
    text-decoration: line-through;
}
.product-card .product-card-body .btn1{
    border: 1px solid;
    margin-right: 3px;
    border-radius: 0px;
    font-size: 12px;
    margin-top: 10px;
}
/* Product Card End */

/* Product View */
    /* Container Styling */
    .container.my-4 {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Heading */
h4.fw-bold {
    font-size: 22px;
    color: #333;
    margin-bottom: 15px;
}

/* Product Card */
.col-12.col-sm-5.col-md-4.text-center {
    transition: transform 0.3s ease-in-out;
    padding: 10px;
}

.col-12.col-sm-5.col-md-4.text-center:hover {
    transform: scale(1.05);
}

/* Product Image */
.col-12.col-sm-5 img {
    max-width: 130px;
    border-radius: 8px;
    transition: transform 0.3s ease-in-out;
}

.col-12.col-sm-5 img:hover {
    transform: scale(1.1);
}

/* Product Name */
.fw-bold.mb-0.text-dark {
    font-size: 16px;
    font-weight: 600;
}

/* Product Price */
.text-muted.mb-0 {
    font-size: 15px;
    color: #777;
}


/* Total Price */
.fw-bold.fs-5.text-center {
    font-size: 18px;
    font-weight: bold;
    color: #222;
}

/* Disclaimer */
.small.text-muted.mt-2.text-center {
    font-size: 12px;
    color: #777;
}
.product{
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 10px;
}
.description-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
}
.description-card h4 {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}
.product-description {
    color: #555;
    line-height: 1.6;
    overflow: hidden;
    max-height: 100px;
    transition: max-height 0.5s ease-in-out;
}
.product-description.expanded {
    max-height: 1000px;
}
.read-more-btn {
    color: #007bff;
    font-weight: bold;
    cursor: pointer;
    border: none;
    background: none;
    padding: 5px 0;
    transition: color 0.3s ease;
}
.read-more-btn:hover {
    color: #0056b3;
    text-decoration: underline;
}

.rating {
    display: flex;
    flex-direction: row; /* Normal left-to-right order */
    justify-content: start;
}

.rating input {
    display: none; /* Hide radio buttons */
}

.rating label {
    font-size: 30px;
    color: #ccc; /* Default star color */
    cursor: pointer;
    transition: color 0.2s;
}

/* Make selected stars gold */
.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: gold;
}


.review-container {
    background: #f9f9f9;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}
.review-container h4{
    font-size: 20px;
        font-weight: bold;
        color: #333;
}

.review {
    background: white;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.review strong {
    font-size: 16px;
    color: #333;
}
.review-stars {
    color: gold;
}
.review p {
    margin-top: 5px;
    color: #555;
}

.product-view .product-name{
    font-size: 24px;
    color: {{ $appSetting->primary }};
}
.product-view .product-name .label-stock{
    font-size: 13px;
    padding: 4px 13px;
    border-radius: 5px;
    color: #fff;

    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
    float: right;
}
.product-view .product-path{
    font-size: 13px;
    font-weight: 500;
    color: #252525;
    margin-bottom: 16px;
}
.product-view .selling-price{
    font-size: 26px;
    color: {{ $appSetting->header_footer }};
    font-weight: 600;
    margin-right: 8px;
}
.product-view .original-price{
    font-size: 18px;
    color: #8a8989;
    font-weight: 400;

    text-decoration: line-through;
}
.product-view .btn1{
    border: 1px solid;
    border-radius: 3px;
    margin-right: 3px;
    font-size: 14px;
    margin-top: 10px;
}
.product-view .btn1:hover{
    background-color: {{ $appSetting->button }};
    color: #fff;
}
.product-view .input-quantity{
    border: 1px solid #000;
    margin-right: 3px;
    font-size: 12px;
    margin-top: 10px;
    width: 58px;

    outline: none;
    text-align: center;
}
.colorSelectionLabel{
    color: silver;
    padding: 2px 10px;
    /* border: 1px solid #000; */
    border-radius: 100%;
    font-size: 14px;
    cursor: pointer;
}
.colorSelectionLabel:active{
    background-color: #fff !important;
    border: 2px solid #000;
}
/* Product View */

/* Cart or Wishlist */
.shopping-cart .cart-header{
    padding: 10px;
}
.shopping-cart .cart-header h4{
    font-size: 18px;
    margin-bottom: 0px;
}
.shopping-cart .cart-item a{
    text-decoration: none;
}
.shopping-cart .cart-item{

    background-color: #fff;
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
    padding: 10px 10px;
    margin-top: 10px;
}
.shopping-cart .cart-item .product-name{
    font-size: 16px;
    font-weight: 600;
    width: 100%;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    cursor: pointer;
}
.shopping-cart .cart-item .price{
    font-size: 16px;
    font-weight: 600;
    padding: 4px 2px;
}
.shopping-cart .btn1{

    border: 1px solid;
    margin-right: 3px;
    border-radius: 0px;
    font-size: 10px;
}
.shopping-cart .btn1:hover{
    background-color: {{ $appSetting->button }};
    color: #fff;
}
.shopping-cart .input-quantity{
    border: 1px solid #000;
    margin-right: 3px;
    font-size: 12px;
    width: 40%;
    outline: none;
    text-align: center;
}
/* Cart or Wishlist */


.checkout .form-control{
    border-radius: 0px !important;
}
.checkout .form-control:focus{
    border: 1px solid #000 !important;
    box-shadow: none !important;
}
.checkout .nav-link{
    border: 1px solid #000;
    border-radius: 0px;
    margin-bottom: 8px;
}
.checkout .tab-content{
    padding-right: 10px;
}

</style>