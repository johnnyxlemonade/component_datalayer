

# Datalayer
DataLayer je javascriptová proměnná, která v analytice slouží k předávání dat do Google Tag Manageru (GTM). 



## Layer

```php
use Lemonade\DataLayer\Layer;

$layer = new Layer();
$layer->create(\Lemonade\DataLayer\Content::class); // instance tridy
$layer->render(); // vraci string
$layer->toArray(); // vraci pole
$layer->withTagManager("TAG_MANAGER_ID", false); // vraci vcetne tagmanageru (volitelny reset eccomerce)

```

### search
Probehlo hledani na strance.

```php

use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Model\Search;

$layer = new Layer();
$layer->create(new Search("hledání"));;


```

### share
Probehlo sdileni obsahu na socialni site.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Model\Share;

$layer = new Layer();
$layer->create(new Share("facebook", "image","C_12345"));
```


### add_to_cart	
Vlozeni produktu do kosiku.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Currency;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;
use Lemonade\DataLayer\Data\Item;

$layer = new Layer();
$content = new Eccomerce(Event::CART_ADD, 100, Currency::CZK); // vychozi mena je CZK, vychozi castka 0
$content->addItem(new Item("SKU_64789", "Stan and Friends Tee"));
$layer->create($content);
```

### remove_from_cart
Odebrani z kosiku. Vlastni udalost je potreba pridat do tagmanageru.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;

$layer = new Layer();
$layer->create(new Eccomerce(Event::CART_REMOVE));
```

### view_cart
Zobrazeni nakupniho kosiku.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Data\Coupon;
use Lemonade\DataLayer\Model\Eccomerce;

$layer = new Layer();
$content = new Eccomerce(Event::CART_VIEW);
$content->addItem(new Item("SKU_12345", "Stan and Friends Tee"));
$content->addCoupon(new Coupon("SUMMER_FUN"));
$layer->create($content);
```

### add_to_wishlist
Vlozeni produktu mezi oblibene.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Currency;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;
use Lemonade\DataLayer\Data\Item;

$layer = new Layer();
$content = new Eccomerce(Event::WISHLIST_ADD);
$content->addItem(new Item("SKU_12345", "Stan and Friends Tee"));
$content->addItem(new Item("SKU_64789", "Stan and Friends Tee"));
$layer->create($content);
```

### remove_from_wishlist
Vlozeni produktu mezi oblibene. Vlastni metoda, nutne zadat do tagmanageru.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Currency;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;

$layer = new Layer();
$content = new Eccomerce(Event::WISHLIST_REMOVE);
$layer->create($content);
```

### view_item
Zobrazeni detail produktu.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;

$layer = new Layer();
$content = new Eccomerce(Event::DETAIL_PRODUCT);
$content->addItem(new Item("SKU_12345", "Stan and Friends Tee"));
$layer->create($content);
```


### add_shipping_info
Uzivatel vybral dopravni metodu.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;
use Lemonade\DataLayer\Data\Shipping;
use Lemonade\DataLayer\Data\Item;

$layer = new Layer();
$content = new Eccomerce(Event::SHIPPING_ADD);
$content->addShiping(new Shipping("PPL"));
$content->addItem(new Item("SKU_12345", "Stan and Friends Tee"));
$content->addItem(new Item("SKU_64789", "Stan and Friends Tee"));

```


### add_payment_info
Uzivatel vybral platebni metodu

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;
use Lemonade\DataLayer\Data\Payment;
use Lemonade\DataLayer\Data\Item;

$layer = new Layer();
$content = new Eccomerce(Event::PAYMENT_ADD);
$content->addShiping(new Payment("Platební karta"));
$content->addItem(new Item("SKU_12345", "Stan and Friends Tee"));
$content->addItem(new Item("SKU_64789", "Stan and Friends Tee"));
```

### begin_checkout
Zahajen checkout.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;
use Lemonade\DataLayer\Data\Item;

$layer = new Layer();
$content = new Eccomerce(Event::CHECKOUT);
$content->addCoupon(new Coupon("SUMMER_FUN"));
$content->addItem(new Item("SKU_12345", "Stan and Friends Tee"));
$content->addItem(new Item("SKU_64789", "Stan and Friends Tee"));
```

### purchase
Zaplaceno.

```php
use Lemonade\DataLayer\Layer;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Model\Eccomerce;
use Lemonade\DataLayer\Data\Coupon;
use Lemonade\DataLayer\Data\Payment;
use Lemonade\DataLayer\Data\Shipping;
use Lemonade\DataLayer\Data\Transaction;
use Lemonade\DataLayer\Data\Item;

$layer = new Layer();
$content = new Eccomerce(Event::PURCHASE, 100);
$content->addTransaction(new Transaction("1234567890"));
$content->addShiping(new Shipping("PPL"));
$content->addPayment(new Payment("Platební karta"));
$content->addCoupon(new Coupon("SUMMER_FUN"));
$content->addItem(new Item("SKU_12345", "Stan and Friends Tee"));
$content->addItem(new Item("SKU_64789", "Stan and Friends Tee"));
```

