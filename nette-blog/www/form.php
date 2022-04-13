<?php


declare(strict_types=1);


if (@!include __DIR__ . '/../vendor/autoload.php') {
  die('Nainstalujte balíčky pomocí `composer require nette/forms`');
}

use Nette\Forms\Form;
$form = new Form;
$form->addText('Username', 'Jméno:')
  ->setRequired();

$form->addPassword('Password', 'Heslo:')
  ->setRequired();

$form->addSubmit('send', 'Registrovat');

if ($form->isSuccess()) {
  //echo 'Formulář byl správně vyplněn a odeslán';
  $data = $form->getValues();
  //var_dump($data);
  foreach ($data as $key => $value){
    echo $key . " je: ". $value . "<br>";
  }
}
else{

  echo '
<!doctype html>
<meta charset="utf-8">
<script src="https://nette.github.io/resources/js/3/netteForms.js"></script>
';
}
$form->render();

?>
<style>
  input {
    display: block;
    margin: 5px auto;
    text-align: center;
    box-shadow: 0 0 10px #666;
    width: 240px;
    height: 30px;
    background: #f2f2f2;
  }
  .button {
    width: 240px;
    height: 30px;
    background-color: #000;
    color: #fff;
  }


</style>
