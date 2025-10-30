<?php
declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Event;

use FacebookAds\Object\ServerSide\Event;

interface EventInterface
{
    public function toEvent(): Event;
}