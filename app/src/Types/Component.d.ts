export interface ComponentType extends Function
{
    public static getSelector(): string;
    public static getSelector(selector: string): this;
    public init(): void;
}

export default ComponentType;
