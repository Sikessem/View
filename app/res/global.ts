import { NameInputComponent } from 'App/Components/Hello/Hello';

const components = [NameInputComponent];

components.forEach(component => {
  const elements = document.querySelectorAll<HTMLInputElement>(component.selector);

  elements.forEach(element => {
    const directive = new component(element);
    directive.init();
  });
})
