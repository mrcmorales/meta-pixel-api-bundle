<?php
declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Event\Interface;

use FacebookAds\Object\ServerSide\Event;

interface EventInterface
{
    public function toEvent(): Event;
    public function getExtra(): array;
    public function getPixelId(): ?string;
}