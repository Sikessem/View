<?php

namespace Sikessem\View\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentSlot;
use Sikessem\View\Component;

class BaseLayout extends Component
{
    /**
     * @param  array<string,mixed>  $data
     */
    public function __construct(
        public string $bodyId = 'view-app',
        public string $rootId = 'view-root',
        public ?ComponentSlot $head = null,
        public ?ComponentSlot $body = null,
        public array $data = [],
    ) {}

    /**
     * The properties / methods that should not be exposed to the component template.
     *
     * @var array
     */
    protected $except = ['data'];

    public function render(): View|Factory
    {
        return view('view::layouts.base', $this->data); // @phpstan-ignore-line
    }
}
