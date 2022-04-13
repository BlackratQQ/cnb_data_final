<?php
declare(strict_types=1);
require "vendor/autoload.php";


// int - INTEGER cele cislo
// float - cislo vc desetinnych mist
// string - je string
// array - pole
// boolean - true / false
// object

function jeSamohlaska(string $slovo): bool
{
    $samohlasky = ['a', 'e', 'i', 'o', 'u', 'y'];
    $slovo_a = str_split($slovo);
    if (in_array($slovo_a[0], $samohlasky)) {
        return true;
    }
    return false;
}

function pridejWay(string $slovo): string
{
    if (!str_ends_with($slovo, 'way')) {
        return $slovo . 'way';
    }
    return $slovo;
}

function pridejAy(string $slovo): string
{
    //Hello becomes Ellohay
    $slovo_a = str_split($slovo);
    $prvni = $slovo_a[0];
    $slovo_a[0] = "";

    return implode('', $slovo_a) . $prvni . 'ay';

}

function malyVelky($slovo, $vystup): string
{
    $upIndex = [];
    $upLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $upLetters_a = str_split($upLetters);

    $slovo_a = str_split($slovo);
    $vystup = strtolower($vystup);
    $vystup_a = str_split($vystup);
    for ($i = 0; $i < count($slovo_a); $i++) {

        if (in_array($slovo_a[$i], $upLetters_a)) {
            $upIndex[$i] = 1;
        } else {
            $upIndex[$i] = 0;
        }
    }

    dump($upIndex);

    for ($i = 0; $i < count($upIndex); $i++) {
        if ($upIndex[$i] == 1) {
            $vystup_a[$i] = strtoupper($vystup_a[$i]);
        }
    }
    $vystup = implode('', $vystup_a);

    return $vystup;
}




$jmeno = '';
$vystup = '';
//if true
if (isset($_POST['jmeno'])) {
    $jmeno = $_POST['jmeno'];
}

dump($jmeno);
dump(jeSamohlaska($jmeno));

if (jeSamohlaska($jmeno)) {
    $vystup = pridejWay($jmeno);
} else {
    //tady je souhlaska
    $vystup = pridejAy($jmeno);
}

$vystup = malyVelky($jmeno, $vystup);



dump($vystup);


echo "
<form action='' method='post'>
    Hod jméno:
    <input type=text size=16 name='jmeno' value='{$jmeno}'>
    <input type=submit value=odeslat>
</form>
";


/*
Write some PHP code that translates a string (word, sentence, or paragraph) into “pig-latin” using the following rules.
Words that start with a consonant have their first letter moved to the end of the word and the letters “ay” added to the end.
Hello becomes Ellohay

Words that start with a vowel have the letters “way” added to the end.
apple becomes appleway
Words that end in “way” are not modified.
stairway stays as stairway
Punctuation must remain in the same relative place from the end of the word.
can’t becomes antca’y
end. becomes endway.
Hyphens are treated as two words
this-thing becomes histay-hingtay
Capitalization must remain in the same place.
Beach becomes Eachbay
McCloud becomes CcLoudmay

 */