import { it, expect } from 'vitest';

import DefaultContainer, { Container } from '../app/src/Core/Container';
import type DefaultContainerType from '../app/src/Types/Container';
import { type ContainerType } from '../app/src/Types/Container';

it('should match Container definition', () => {
    const container: ContainerType = new Container;
    const defaultContainer: DefaultContainerType = new DefaultContainer;
    expect(container).toEqual(defaultContainer);
});
