<?php

declare(strict_types=1);

namespace Sikessem\View;

class Runtime
{
    public static function instance(): self
    {
        return new self;
    }
}
