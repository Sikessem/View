export abstract class BaseComponent
{
    static instances: number = 1;
    static selector: string;
    protected id: number;

    constructor(public element: HTMLElement)
    {
        this.id = ++BaseComponent.instances
    }

    abstract init(): void;
}

export default BaseComponent;
