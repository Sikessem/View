import { it, expect } from 'vitest';

import DefaultComposer, { Composer } from '../app/src/Core/Composer';
import type DefaultComposerType from '../app/src/Types/Composer';
import { type ComposerType } from '../app/src/Types/Composer';

it('should match Composer definition', () => {
    const composer: ComposerType = new Composer;
    const defaultComposer: DefaultComposerType = new DefaultComposer;
    expect(composer).toEqual(defaultComposer);
});
