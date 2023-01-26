import { NameInputDirective } from "App/Hello/Hello";

const element = document.querySelector<HTMLInputElement>('#name');

if (element) {
  const directive = new NameInputDirective(element);
  directive.init();
}
