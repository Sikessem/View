import { BaseComponent } from "App/Core/Component";

export class NameInputComponent extends BaseComponent
{
  static selector = '[hello]';
  protected color = 'blue';

  constructor(public element: HTMLInputElement, public formater = new FormData())
  {
    super(element);
  }

  init()
  {
    this.element.style.color = this.element.getAttribute('color') || this.color;

    this.element.addEventListener('input', (event) => {
      this.helloInput(event.target as HTMLInputElement);
    });
  }

  getOutputId(): string
  {
    return (this.element.id || this.id) + 'Output';
  }

  helloInput(input: HTMLInputElement)
  {
    const output = this.findOutput() ?? this.makeOutput();
    output.innerHTML = '<div class="m-4 text-xl">Hello, <b class="text-3xl">' + input.value + '</b>.</div>';
  }

  findOutput(): HTMLOutputElement|null
  {
    const output = document.getElementById(this.getOutputId());
    
    if (output instanceof HTMLOutputElement) {
      return output;
    }

    return null;
  }

  makeOutput(): HTMLOutputElement
  {
    const output = document.createElement('output');
    output.setAttribute('id', this.getOutputId());
    this.element.parentElement?.appendChild(output);
    return output;
  }
}
