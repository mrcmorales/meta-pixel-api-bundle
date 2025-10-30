<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Factory;

use FacebookAds\Object\ServerSide\CustomData;

final class CustomDataFactory
{
    /**
     * Crea un objecte CustomData per Meta Pixel
     *
     * @param string|null $currency Moneda (ex: "EUR")
     * @param float|null $value Valor de l’event
     * @param string|null $contentName Nom del contingut/producte
     * @param string|null $contentCategory Categoria del contingut/producte
     * @param array|null $contentIds Identificadors únics del producte o contingut
     * @param string|null $contentType Tipus de contingut (ex: "product", "event", "product_group")
     */
    public static function create(
        ?string $currency = null,
        ?float $value = null,
        ?string $contentName = null,
        ?string $contentCategory = null,
        ?array $contentIds = null,
        ?string $contentType = null
    ): CustomData {
        $customData = new CustomData();

        if ($currency) {
            $customData->setCurrency($currency);
        }

        if ($value !== null) {
            $customData->setValue($value);
        }

        if ($contentName) {
            $customData->setContentName($contentName);
        }

        if ($contentCategory) {
            $customData->setContentCategory($contentCategory);
        }

        if ($contentIds) {
            $customData->setContentIds($contentIds);
        }

        if ($contentType) {
            $customData->setContentType($contentType);
        }

        return $customData;
    }
}
