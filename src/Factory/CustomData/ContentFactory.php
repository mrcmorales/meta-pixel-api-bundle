<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Factory\CustomData;

use FacebookAds\Object\ServerSide\Content;
use MrcMorales\MetaPixelApiBundle\Enum\DeliveryCategory;

final class ContentFactory
{
    private function __construct() {}

    /**
     * @param non-empty-string $productId
     * @param int<1, max> $quantity
     * @param float|null $itemPrice
     * @param non-empty-string|null $title
     * @param non-empty-string|null $description
     * @param non-empty-string|null $brand
     * @param non-empty-string|null $category
     * @param DeliveryCategory|null $deliveryCategory
     */
    public static function create(
        string $productId,
        int $quantity,
        ?float $itemPrice = null,
        ?string $title = null,
        ?string $description = null,
        ?string $brand = null,
        ?string $category = null,
        DeliveryCategory|null $deliveryCategory = null,
    ): Content {
        $content = new Content();

        $content->setProductId($productId)
            ->setQuantity($quantity);

        if ($itemPrice !== null) {
            $content->setItemPrice($itemPrice);
        }
        if ($title !== null) {
            $content->setTitle($title);
        }

        if ($description !== null) {
            $content->setDescription($description);
        }

        if ($brand !== null) {
            $content->setBrand($brand);
        }

        if ($category !== null) {
            $content->setCategory($category);
        }

        if ($deliveryCategory !== null) {
            $content->setDeliveryCategory($deliveryCategory->value);
        }

        return $content;
    }
}
