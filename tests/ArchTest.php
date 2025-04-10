<?php

declare(strict_types=1);

test('globals')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

test('classes')
    ->expect('Sikessem\View')
    ->toUseStrictTypes();

test('contracts')
    ->expect('Sikessem\View\Contracts')
    ->interfaces()
    ->toOnlyBeUsedIn('Sikessem\View', 'Sikessem\View\Contracts');

test('concerns')
    ->expect('Sikessem\View\Concerns')
    ->traits()
    ->toOnlyBeUsedIn('Sikessem\View', 'Sikessem\View\Concerns');
