<?php

namespace Sikessem\View\Components;

use Illuminate\View\ComponentAttributeBag;
use Sikessem\View\Component;

class Menu extends Component
{
    /**
     * @param  array<mixed>  $list
     * @param  array<string,string>|ComponentAttributeBag  $itemAttributes
     */
    public function __construct(
        public array $list = [],
        public bool $ordered = false,
        public array|ComponentAttributeBag $itemAttributes = [],
    ) {}
}
