<?php

namespace Sikessem\View\Components;

use Sikessem\View\Component;

class Text extends Component
{
    public function __construct(
        public ?string $tag = null,
        public ?string $value = null,
        public ?string $icon = null,
        public bool $escape = false,
        public bool $translate = false,
    ) {}
}
