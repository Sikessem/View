import { type ContainerType } from "../Types/Container";
import { type OptionsType } from "../Types/Options";

export class Container implements ContainerType
{
    constructor(options: OptionsType = {})
    {
        this.setOptions(options);
    }
    
    protected options: OptionsType = {};

    getOptions(): OptionsType
    {
        return this.options;
    }

    public setOptions(options: OptionsType): this
    {
        this.options = options;
        return this;
    }
    
    addOptions(options: OptionsType): this
    {
        return this.setOptions({
            ...this.getOptions(),
            ...options
        });
    }

    public getService<T>(target: Function, args: {[key: string|number]: any}): T
    {
        if (typeof target !== 'function' && typeof target !== 'object') {
            return Reflect.construct<any[], T>(target, []);
        }
        
        const matches = /constructor\((.*)\)/g.exec(target.toString());
        const params = (matches ? (matches[1] ?? '') : '').split(', ');
        
        const values = this.parseValues(params, args);
        return Reflect.construct(target, values);
    }

    protected parseValues(params: Array<string>, args: {[key: string|number]: any}): Array<any>
    {
        const values: any[] = [];
        
        let key = 0;
        
        params.forEach(param => {
            values[key] = args[param] ?? args[key] ?? null;
            ++key;
        })
        
        return values;
    }
}

export default Container;
