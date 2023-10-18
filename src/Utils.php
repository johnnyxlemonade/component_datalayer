<?php declare(strict_types=1);

namespace Lemonade\DataLayer;

use stdClass;

final class Utils
{

    /**
     * @param stdClass $data
     * @param string $propertyName
     * @param int|float|string|null $propertyValue
     * @return void
     */
    public static function addProperty(stdClass $data, string $propertyName, int|float|string|null $propertyValue = null): void
    {

        if ($propertyValue !== null && $propertyValue !== "") {

            $data->{$propertyName} = $propertyValue;
        }
    }

    /**
     * @param stdClass $ecommerce
     * @param array $items <Item>
     * @return void
     */
    public static function addItems(stdClass $ecommerce, array $items = []): void
    {

        $index = 0;

        if (!empty($items)) {
            foreach ($items as $val) {

                $item = new stdClass();
                $item->item_id = $val->item_id;
                $item->item_name = $val->item_name;
                $item->index = $index++;

                self::addProperty(data: $item, propertyName: "price", propertyValue: $val->price);
                self::addProperty(data: $item, propertyName: "quantity", propertyValue: $val->quantity);
                self::addProperty(data: $item, propertyName: "affiliation", propertyValue: $val->affiliation);
                self::addProperty(data: $item, propertyName: "coupon", propertyValue: $val->coupon);
                self::addProperty(data: $item, propertyName: "currency", propertyValue: $val->currency);
                self::addProperty(data: $item, propertyName: "discount", propertyValue: $val->discount);
                self::addProperty(data: $item, propertyName: "item_brand", propertyValue: $val->item_brand);
                self::addProperty(data: $item, propertyName: "item_category", propertyValue: $val->item_category);
                self::addProperty(data: $item, propertyName: "item_category2", propertyValue: $val->item_category2);
                self::addProperty(data: $item, propertyName: "item_category3", propertyValue: $val->item_category3);
                self::addProperty(data: $item, propertyName: "item_category4", propertyValue: $val->item_category4);
                self::addProperty(data: $item, propertyName: "item_category5", propertyValue: $val->item_category5);
                self::addProperty(data: $item, propertyName: "item_list_id", propertyValue: $val->item_list_id);
                self::addProperty(data: $item, propertyName: "item_list_name", propertyValue: $val->item_list_name);
                self::addProperty(data: $item, propertyName: "item_variant", propertyValue: $val->item_variant);
                self::addProperty(data: $item, propertyName: "location_id", propertyValue: $val->location_id);

                $ecommerce->items[] = $item;
            }

        } else {

            $ecommerce->items = [];
        }
    }

}