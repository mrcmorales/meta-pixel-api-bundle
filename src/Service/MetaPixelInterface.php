<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Service;

use MrcMorales\MetaPixelApiBundle\Event\EventInterface;

interface MetaPixelInterface
{
    public function track(EventInterface $event): void;

    public function setCredentials(string $pixelId, ?string $accessToken = null): self;
}