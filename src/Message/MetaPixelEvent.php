<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Message;

use MrcMorales\MetaPixelApiBundle\Event\Interface\EventInterface;

final class MetaPixelEvent
{
    public function __construct(public EventInterface $event)
    {
    }
}