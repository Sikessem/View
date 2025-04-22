<?php

namespace Sikessem\View;

class Directives
{
    public static function view(string $expression): string
    {
        return '{!! \Sikessem\View\Facade::make('.$expression.') !!}';
    }

    public static function tag(string $expression): string
    {
        return '{!! \Sikessem\View\Facade::openTag('.$expression.') !!}';
    }

    public static function endtag(): string
    {
        return '{!! \Sikessem\View\Facade::closeTag() !!}';
    }
}
