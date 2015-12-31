<?php

$champname = json_decode(file_get_contents("json/champions.json"), true);
$spellname = json_decode(file_get_contents("json/spells.json"), true);
for ($i=0;$i<=10;$i++){
    echo $champname[$i]['name']."\n";
}
?>