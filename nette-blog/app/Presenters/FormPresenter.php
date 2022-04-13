<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

class FormPresenter extends Nette\Application\UI\Presenter
{
  protected function createComponentLoginForm(): Form
  {
    $form = new Form;
    $form->addText('Username', 'Jméno:')
      ->setRequired();

    $form->addPassword('Password', 'Heslo:')
      ->setRequired();

    $form->addSubmit('send', 'Registrovat');
    $form->onSuccess[] = [$this, 'commentFormSucceeded'];
    return $form;
  }
  public function commentFormSucceeded(\stdClass $data): void
  {
//    foreach ($data as $key => $value) {
//      echo $key . " je: " . $value . "<br>";
//    }


  }
}

