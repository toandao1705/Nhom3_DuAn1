<?php
include "view/component/header.php";


if ((isset($_GET['act'])) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        case 'deals':
            include "view/deals.php";
            break;
        case 'about':
            include "view/about.php";
            break;
        case 'shop':
            include "view/shop.php";
            break;

        case 'cart':
            include "view/cart.php";
            break;

        case 'checkout':
            include "view/checkout.php";
            break;

        case 'invoice':
            include "view/invoice.php";
            break;

        case 'contact':
            include "view/contact.php";
            break;



        default:
            include "view/home.php";
            break;
    }
} else {
    include "view/home.php";
}
include "view/component/footer.php";
