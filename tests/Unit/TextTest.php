<?php

it('should render text component', function () {
    expect('Sigview Kessé Emmanuel<contact@sigview.ci>')->toBeRenderOf('<s-text value="Sigview Kessé Emmanuel<contact@sigview.ci>"/>');
});

it('should translate text component', function () {
    expect('Sigview Kessé Emmanuel<contact@sigview.ci>')->toBeRenderOf('<s-translate-text value="Sigview Kessé Emmanuel<contact@sigview.ci>"/>');
});

it('should escape text component', function () {
    expect('Sigview Kessé Emmanuel&lt;contact@sigview.ci&gt;')->toBeRenderOf('<s-escape-text value="Sigview Kessé Emmanuel<contact@sigview.ci>"/>');
});
