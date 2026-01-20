<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Enum;

use FacebookAds\Object\ServerSide\DeliveryCategory as FbDeliveryCategory;

enum DeliveryCategory: string
{
    case IN_STORE = FbDeliveryCategory::IN_STORE;
    case CURBSIDE = FbDeliveryCategory::CURBSIDE;
    case HOME_DELIVERY = FbDeliveryCategory::HOME_DELIVERY;
}
