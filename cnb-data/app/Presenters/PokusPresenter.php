<?php
declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Tracy\Debugger;

final class PokusPresenter extends Nette\Application\UI\Presenter
{
public function actionDownloader(){
  $url = 'https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/vybrane.txt?od=01.01.2021&do=31.12.2021&mena=EUR&format=txt';
  $data = file_get_contents("$url");
  $data = explode("Kurz\n", $data);
//  $kurz = '|Kurz';
//  $info= substr_replace($data[0], $kurz, -1,  );
  $array = explode ("\n", $data[1]);

  $array_months = array();

  foreach($array as $value) {
    if ($value == null) {
      continue;
    }
    $parts = explode('|', $value);
    $datum = explode ('.', $parts[0]);
    $month_int = (int) $datum[1];
    $value_thousand = str_replace (',', '',$parts[1]);
    $value_int = (int) $value_thousand;
    $array_months[$month_int]["sum"] = ($array_months[$month_int]["sum"] + $value_int);
    $array_months[$month_int]["count"] = $array_months[$month_int]["count"]+1;
  }

  //reIndexace pole
  $array_months = array_values($array_months);

  foreach ($array_months as $key => $month ){
    $array_months[$key]["avg"] = round ( ($month["sum"]) / ($month["count"]) /1000, 3);
    $array_months[$key]["sum"] = $array_months[$key]["sum"] / 1000;
  }

  echo $array_months["sum"];

  //rozdíl začátek a konec roku
  $diff = $array_months[0]["avg"] - $array_months[11]["avg"];

  $this->template->array_months = $array_months;
  $this->template->diff = $diff;

}

}