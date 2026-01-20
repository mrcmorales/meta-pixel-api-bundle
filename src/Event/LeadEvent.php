<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Event;

use FacebookAds\Object\Values\ProductEventStatEventValues;
use MrcMorales\MetaPixelApiBundle\Event\Abstract\AbstractPixelEvent;

final class LeadEvent extends AbstractPixelEvent
{
    const string EVENT_NAME =  ProductEventStatEventValues::LEAD;
}
