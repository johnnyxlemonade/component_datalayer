<?php declare(strict_types=1);

namespace Lemonade\DataLayer;
use stdClass;

final class Utils {

    /**
     * @param stdClass $data
     * @param string $propertyName
     * @param int|float|string|null $propertyValue
     * @return void
     */
    public static function addProperty(stdClass $data, string $propertyName, int|float|string|null $propertyValue = null): void {

        if ($propertyValue !== null && $propertyValue !== "") {
            $data->{$propertyName} = $propertyValue;
        }
    }

    /**
     * @param stdClass $ecommerce
     * @param array $items<Item>
     * @return void
     */
    public static function addItems(stdClass $ecommerce, array $items = []): void {
        
        $index = 0;
        
        if(!empty($items)) {
            foreach ($items as $val) {
                
                $item = new stdClass();
                $item->item_id = $val->item_id;
                $item->item_name = $val->item_name;
                $item->index = $index++;

                self::addProperty($item, "price", $val->price);
                self::addProperty($item, "quantity", $val->quantity);
                self::addProperty($item, "affiliation", $val->affiliation);
                self::addProperty($item, "coupon", $val->coupon);
                self::addProperty($item, "currency", $val->currency);
                self::addProperty($item, "discount", $val->discount);
                self::addProperty($item, "item_brand", $val->item_brand);
                self::addProperty($item, "item_category", $val->item_category);
                self::addProperty($item, "item_category2", $val->item_category2);
                self::addProperty($item, "item_category3", $val->item_category3);
                self::addProperty($item, "item_category4", $val->item_category4);
                self::addProperty($item, "item_category5", $val->item_category5);
                self::addProperty($item, "item_list_id", $val->item_list_id);
                self::addProperty($item, "item_list_name", $val->item_list_name);
                self::addProperty($item, "item_variant", $val->item_variant);
                self::addProperty($item, "location_id", $val->location_id);

                $ecommerce->items[] = $item;
            }
        } else {

            $ecommerce->items = [];
        }
    }
    
}