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
        case 'reset_password':
            include "view/reset_password.php";
            break;
        case 'product_full':
            include "view/product_full.php";
            break;
        case 'blog_post':
            include "view/blog_post.php";
            break;
        case 'privacy_policy':
            include "view/privacy_policy.php";
            break;
        case 'terms':
            include "view/terms.php";
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
        case 'account':
            include "view/account.php";
            break;
        case 'blog':
            include "view/blog_category.php";
            break;
        case 'login':
            include "view/login.php";
            break;
        case 'register':
            include "view/register.php";
            break;
        case 'forgot_password':
            include "view/forgot_password.php";
            break;
        case 'page_404':
            include "view/page_404.php";
            break;
        case 'search':
            include "view/search.php";
            break;
        default:
            include "view/home.php";
            break;
    }
} else {
    include "view/home.php";
}
include "view/component/footer.php";
