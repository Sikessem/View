import fs from 'node:fs';
import path from 'node:path';

import { it, expect } from 'vitest';

import DefaultComponent, { Component } from '../app/src/Core/Component';
import type DefaultComponentType from '../app/src/Types/Component';
import { type ComponentType } from '../app/src/Types/Component';

import { JSDOM } from 'jsdom';

const page = fs.readFileSync(path.resolve(__dirname, '../app/res/index.html'), 'utf8');
const dom = new JSDOM(page);
const { document } = dom.window;

it('should match Component definition', () => {
    expect(Component).toEqual(DefaultComponent);

    document.querySelectorAll<HTMLElement>('[hello]').forEach(querySelected => {
        const component: ComponentType = new Component(querySelected);
        const defaultComponent: DefaultComponentType = new DefaultComponent(querySelected);

        component.init();
        defaultComponent.init();

        expect(component).toBeInstanceOf(Component);
        expect(defaultComponent).toBeInstanceOf(DefaultComponent);

       expect(component.toString()).toEqual(defaultComponent.toString());
    });
});
