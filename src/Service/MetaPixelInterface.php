<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Service;

use MrcMorales\MetaPixelApiBundle\Event\EventInterface;

interface MetaPixelInterface
{
    public function track(EventInterface $event): void;
    public function getPixelId(): string;
    public function setAccessToken(string $accessToken): self;
}