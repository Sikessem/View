import { type ComponentType } from '../Types/Component';
import { type ComposerType } from '../Types/Composer';
import { Container } from './Container';


export class Composer extends Container implements ComposerType
{
    compose(components : Array<ComponentType>)
    {
        components.forEach(component => {
            const elements = document.querySelectorAll<HTMLInputElement>(component.getSelector());
        
            elements.forEach(element => {
                const directive = this.getService<typeof component>(component, { element });
                directive.init();
            });
        });
    }
}

export default Composer;
