<?php

namespace MrcMorales\MetaPixelApiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class MetaPixelApiBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
