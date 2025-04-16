import { type OptionsType } from "./Options";

export interface ContainerType
{
    public getOptions(): OptionsType;

    public setOptions(options: OptionsType): this;

    public addOptions(options: OptionsType): this;

    public getService<T>(target: Function, args: {[key: string|number]: any}): T;
}

export default ContainerType;
