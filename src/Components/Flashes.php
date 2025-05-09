<?php

namespace Sikessem\View\Components;

use Illuminate\Support\Collection;
use Sikessem\View\Component;

class Flashes extends Component
{
    /**
     * @var Collection<int|string,non-falsy-string>
     */
    public Collection $messages;

    /**
     * @param  array<int|string,string>  $messages
     */
    public function __construct(
        array $messages = [],
        public string $tag = 'ul',
        public string $flashTag = 'li',
        public ?string $icon = null,
    ) {
        $messages = collect($messages)
            ->map(function ($message, $type) {
                /** @var string */
                $message = is_int($type) ? session($message, '') : session($type, $message);

                return $message;
            })
            ->filter(fn ($message) => ! empty($message));
        $this->messages = $messages;
    }
}
