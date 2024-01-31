<?php declare(strict_types=1);

namespace Lemonade\DataLayer;

enum Event: string
{

    case DEFAULT_PAGE = "default_page";
    case DEFAULT_CONSENT = "default_consent";
    case CART_ADD = "add_to_cart";
    case CART_REMOVE = "remove_from_cart";
    case CART_VIEW = "view_cart";
    case DETAIL_PRODUCT = "view_item";
    case WISHLIST_ADD = "add_to_wishlist";
    case WISHLIST_REMOVE = "remove_from_wishlist";
    case SHIPPING_ADD = "add_shipping_info";
    case PAYMENT_ADD = "add_payment_info";
    case CHECKOUT = "begin_checkout";
    case PURCHASE = "purchase";
    case SEARCH = "search";
    case SHARE = "share";

}