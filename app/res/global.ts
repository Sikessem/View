import { NameInputComponent } from 'App/Components/Hello/Hello';
import { construct } from 'App/Helpers/Helpers';

const components = [NameInputComponent];

components.forEach(component => {
  const elements = document.querySelectorAll<HTMLInputElement>(component.selector);

  elements.forEach(element => {
    const directive = construct<NameInputComponent>(component, {
      element,
    });
    directive.init();
  });
});
