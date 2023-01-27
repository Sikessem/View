import { type ComponentType } from "../Types/Component";

export abstract class BaseComponent implements ComponentType
{
    static selector: string = '[ske]';
    static instances: number = 1;
    protected id: number;


    constructor(element: HTMLElement)
    {
        this.setElement(element);
        this.id = ++BaseComponent.instances
    }

    public static getSelector(): string
    {
        return this.selector;
    }

    public static setSelector(selector: string)
    {
        this.selector = selector;
    }

    protected element!: HTMLElement;

    getElement(): HTMLElement
    {
        return this.element;
    }

    setElement(element: HTMLElement): this
    {
        this.element = element;
        return this;
    }

    abstract init(): void;
}

export default BaseComponent;
