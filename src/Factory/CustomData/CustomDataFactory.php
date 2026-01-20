<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Factory\CustomData;

use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;

final class CustomDataFactory
{
    private function __construct()
    {
    }

    /**
     * @param non-empty-string|null $currency
     * @param float|null $value
     * @param non-empty-string|null $contentName
     * @param non-empty-string|null $contentCategory
     * @param list<non-empty-string>|null $contentIds
     * @param list<Content>|null $contents
     * @param 'product'|'product_group'|null $contentType
     * @param non-empty-string|null $orderId
     * @param float|null $predictedLtv
     * @param int|null $numItems
     * @param non-empty-string|null $status
     * @param non-empty-string|null $searchString
     * @param non-empty-string|null $itemNumber
     * @param 'home_delivery'|'store_pickup'|'curbside'|null $deliveryCategory
     * @param array<string, scalar>|null $customProperties
     * @return CustomData
     */
    public static function create(
        ?string $currency = null,
        ?float $value = null,
        ?string $contentName = null,
        ?string $contentCategory = null,
        ?array $contentIds = null,
        ?array $contents = null,
        ?string $contentType = null,
        ?string $orderId = null,
        ?float $predictedLtv = null,
        ?int $numItems = null,
        ?string $status = null,
        ?string $searchString = null,
        ?string $itemNumber = null,
        ?string $deliveryCategory = null,
        ?array $customProperties = null,
    ): CustomData {
        $customData = new CustomData();

        $currency !== null && $customData->setCurrency($currency);
        $value !== null && $customData->setValue($value);
        $contentName !== null && $customData->setContentName($contentName);
        $contentCategory !== null && $customData->setContentCategory($contentCategory);
        $contentIds !== null && $contentIds !== [] && $customData->setContentIds($contentIds);
        $contents !== null && $contents !== [] && $customData->setContents($contents);
        $contentType !== null && $customData->setContentType($contentType);
        $orderId !== null && $customData->setOrderId($orderId);
        $predictedLtv !== null && $customData->setPredictedLtv($predictedLtv);
        $numItems !== null && $customData->setNumItems((string) $numItems);
        $status !== null && $customData->setStatus($status);
        $searchString !== null && $customData->setSearchString($searchString);
        $itemNumber !== null && $customData->setItemNumber($itemNumber);
        $deliveryCategory !== null && $customData->setDeliveryCategory($deliveryCategory);

        if ($customProperties !== null && $customProperties !== []) {
            foreach ($customProperties as $key => $value) {
                $customData->addCustomProperty($key, $value);
            }
        }

        return $customData;
    }
}
