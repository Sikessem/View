<?php

namespace Sikessem\View\Components;

use Sikessem\View\FormControl;

class Textarea extends FormControl
{
    public string $name;

    public string $id;

    public ?string $value;

    public function __construct(
        string $name,
        ?string $id = null,
        string|array|null $value = null,
        ?string $current = null,
        ?string $default = null,
        public bool $invalid = false,
        public ?string $icon = null,
    ) {
        parent::__construct('textarea');
        $id ??= $name;
        $value = (array) $value;
        $current ??= $value['current'] ?? $value[0] ?? null;
        $default ??= $value['default'] ?? $value[1] ?? $value[0] ?? null;
        $value = old($name) ?: $current ?? $default;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
    }
}
