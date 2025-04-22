<?php

use Sikessem\View\Contracts\IsManager;

test('view() helper should be an instance of '.IsManager::class, function () {
    expect(view())->toBeInstanceOf(IsManager::class);
});
