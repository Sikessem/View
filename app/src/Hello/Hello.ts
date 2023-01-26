export class NameInputDirective
{
  constructor(public element: HTMLInputElement) {}

  init()
  {
    this.element.style.color = 'blue';
    this.element.addEventListener('input', (event) => {
      this.helloInput(event.target as HTMLInputElement);
    });
  }

  helloInput(input: HTMLInputElement)
  {
    const output = this.findOutput() ?? this.makeOutput();
    output.innerHTML = '<div class="m-4 text-xl">Hello, <b class="text-3xl">' + input.value + '</b>.</div>';
  }

  findOutput(): HTMLOutputElement|null
  {
    const output = document.getElementById('nameOutput');
    
    if (output instanceof HTMLOutputElement) {
      return output;
    }

    return null;
  }

  makeOutput(): HTMLOutputElement
  {
    const output = document.createElement('output');
    output.setAttribute('id', 'nameOutput');
    this.element.parentElement?.parentElement?.appendChild(output);
    return output;
  }
}
