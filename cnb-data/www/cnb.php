<?php
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
echo "<br>";
//rozdíl začátek a konec roku
$diff = $array_months[0]["avg"] - $array_months[11]["avg"];
echo $diff . "ff";




echo "<br>";



echo "<br>";




$cars = array (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
);


echo $cars[0][0].": In stock: ".$cars[0][1].", sold: ".$cars[0][2].".<br>";
echo $cars[1][0].": In stock: ".$cars[1][1].", sold: ".$cars[1][2].".<br>";
echo $cars[2][0].": In stock: ".$cars[2][1].", sold: ".$cars[2][2].".<br>";
echo $cars[3][0].": In stock: ".$cars[3][1].", sold: ".$cars[3][2].".<br>";

echo "<hr>";

$autobazar = array (
  "volvo" => array("znacka" => "Volvo","skladem" => 22,"prodano" => 18),
  "bmw" => array("BMW",15,13),
  "saab" => array("Saab",5,2),
  "land rover" => array("Land Rover",17,15)
);

echo $autobazar["volvo"]["znacka"].": In stock: ".$autobazar["volvo"]["skladem"].", sold: ".$autobazar["volvo"]["prodano"].".<br>";
echo $autobazar[1][0].": In stock: ".$autobazar[1][1].", sold: ".$autobazar[1][2].".<br>";
echo $autobazar[2][0].": In stock: ".$autobazar[2][1].", sold: ".$autobazar[2][2].".<br>";
echo $autobazar[3][0].": In stock: ".$autobazar[3][1].", sold: ".$autobazar[3][2].".<br>";