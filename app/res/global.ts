import { NameInputComponent } from 'App/Components/Hello/Hello';
import { Composer } from 'App/Core/Composer';

const composer = new Composer()
composer.compose([
  NameInputComponent,
]);
