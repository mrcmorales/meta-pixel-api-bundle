<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Factory\CustomData;

use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use MrcMorales\MetaPixelApiBundle\Enum\ContentType;
use MrcMorales\MetaPixelApiBundle\Enum\DeliveryCategory;

final class PurchaseCustomDataFactory
{
    /**
     * @param Content[]|null $contents
     * @param non-empty-string|null $status
     */
    public static function create(
        string $currency,
        float $value,

        ?ContentType $contentType = null,
        ?array $contentIds = null,


        ?array $contents = null,
        ?DeliveryCategory $deliveryCategory = null,
        ?string $status = null,
        ?string $orderId = null,
        ?float $predictedLtv = null,
    ): CustomData {
        return CustomDataFactory::create(
            currency: $currency,
            value: $value,
            contentIds: $contentIds,
            contents: $contents,
            contentType: $contentType?->value,
            orderId: $orderId,
            predictedLtv: $predictedLtv,
            status: $status,
            deliveryCategory: $deliveryCategory?->value,
        );
    }
}
