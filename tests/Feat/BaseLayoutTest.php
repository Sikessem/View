<?php

it('should render anonymous component', function () {
    $this->blade(<<<'BLADE'
<s-base-layout>
    Hello World!
</s-base-layout>
BLADE)->assertSeeInOrder(['view-root', config('app.name', 'Sikessem'), 'view-app', 'Hello World!']);

    $this->blade(<<<'BLADE'
<s-base-layout>
    <s:head>
        <meta name="author" content="Sigview Kessé Emmanuel"/>
    </s:head>
    <s:body>
        Hello World!
    </s:body>
</s-base-layout>
BLADE)->assertSeeInOrder(['Sigview Kessé Emmanuel', 'Hello World!']);
});
