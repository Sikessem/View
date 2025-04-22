<?php

namespace Sikessem\View\Components;

use Sikessem\View\Component;

class Label extends Component
{
    public function __construct(
        public ?string $text = null,
        public ?string $icon = null,
    ) {}
}
