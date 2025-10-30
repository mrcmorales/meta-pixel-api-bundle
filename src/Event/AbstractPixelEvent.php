<?php
declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Event;

abstract class AbstractPixelEvent implements EventInterface
{
    public function __construct(
        private readonly array $extra = []
    ) {}

    public function getExtra(): array
    {
        return $this->extra;
    }
}