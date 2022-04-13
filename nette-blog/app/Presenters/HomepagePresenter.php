<?php
declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

class HomepagePresenter extends Nette\Application\UI\Presenter

{
  protected function createComponentRegistrationForm(): Form
  {
    $form = new Form;
    $form->addText('name', 'Jméno:')
      ->setRequired();

    $form->addPassword('password', 'Heslo:')
      ->setRequired();

    $sex = [
      'm' => 'muž',
      'f' => 'žena'
    ];
    $form->addRadioList('gender', 'Pohlaví:', $sex)
      ->setRequired();

    $form->addSubmit('send', 'Registrovat');
    $form->onSuccess[] = [$this, 'formSuccess'];

    return $form;
  }
  public function formSuccess(Form $form, $data): void
  {
    var_dump($data);
    /*    $this->template->render(__DIR__ . '/templates/Homepage/myTemplate.latte');*/



    // tady zpracujeme data odeslaná formulářem
    // $data->name obsahuje jméno
    // $data->password obsahuje heslo
    $this->template->add('form_name', $data->name);
    $this->template->add('form_password', $data->password);
    $this->template->add('form_gender', $data->gender);
  }
}



