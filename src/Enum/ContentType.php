<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Enum;

use FacebookAds\Object\ServerSide\Content as FbDeliveryCategory;

enum ContentType: string
{
    case PRODUCT = 'product';
    case PRODUCT_GROUP = 'product_group';
}