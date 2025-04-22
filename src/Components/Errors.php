<?php

namespace Sikessem\View\Components;

use Sikessem\View\Component;

class Errors extends Component
{
    public function __construct(
        public string $tag = 'ul',
        public string $errorTag = 'li',
        public ?string $icon = null,
    ) {}
}
