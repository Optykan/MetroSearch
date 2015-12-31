<?php
$key=getenv('apikey');
$id=$_GET['id'];
$region="NA1";
$summoners=array();
$champions=array();
$spells=array();
$masteries=array();
$keystones=array();

$data = json_decode(file_get_contents("https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$region/$id?api_key=$key"), true);
echo "https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$region/$id?api_key=$key";
$gameQueue = $data['gameQueueConfigId'];
$players=10;

  if($gameQueue === 2 || $gameQueue === 31 || $gameQueue === 32 || $gameQueue === 7 || $gameQueue === 33 || $gameQueue === 14 || $gameQueue === 16 || $gameQueue === 17 || $gameQueue === 25 || $gameQueue === 4 || $gameQueue === 6 || $gameQueue === 42 || $gameQueue === 61 || $gameQueue === 65 || $gameQueue === 70 || $gameQueue === 76 || $gameQueue === 83 || $gameQueue === 91 || $gameQueue === 92 || $gameQueue === 93 || $gameQueue === 96 || $gameQueue === 300 || $gameQueue === 310){
        $players = 10;
    }
    else if($gameQueue === 8 || $gameQueue === 9 || $gameQueue === 41 || $gameQueue === 52){
        $players=6;
    }
    else if($gameQueue === 72){
        $players=2;
    }
    else if($gameQueue === 73){
        $players=4;
    }

for ($i=0;$i<$players;$i++){
    $keystones[$i]=0;
    $summoners[$i]=$data['participants'][$i]['summonerName'];
    $champions[$i]=$data['participants'][$i]['championId'];
    $spells[$i][0]=$data['participants'][$i]['spell1Id'];
    $spells[$i][1]=$data['participants'][$i]['spell2Id'];
    
    for($k=0;$k<3;$k++){
        $masteries[$i][$k]=0;
    }
    foreach($data['participants'][$i]['masteries'] as $mtmp){
        $mTree=floor(($mtmp['masteryId']-6000)/100);
        $masteries[$i][$mTree-1]+=$mtmp['rank'];
        $keyCheck=floor($mtmp['masteryId']-(6000+$mTree*100));
        if($keyCheck>60){
            $keystones[$i]=$mtmp['masteryId'];
        }
    }
    
}

$champname = json_decode(file_get_contents("json/champions.json"), true);
$spellname = json_decode(file_get_contents("json/spells.json"), true);
$keystonename = json_decode(file_get_contents("json/masteries.json"), true);
?>
    <html>

    <head>
        <link href='https://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>
        <link href='css/styles.css' rel='stylesheet'>

        <script src='js/time.js'></script>
    </head>

    <body>
        <?php 
            
            for ($i=0;$i<$players;$i++){
                echo "<p class='team ";
                if ($i>=$players/2)
                    echo "red'>";
                else
                    echo "blue'>";
                echo strtoupper($summoners[$i])." is playing ".strtoupper($champname[$champions[$i]]['name'])." using ".strtoupper($spellname[$spells[$i][0]]['name'])."/".strtoupper($spellname[$spells[$i][1]]['name']);
                echo " - ";
                echo $masteries[$i][0]."/".$masteries[$i][1]."/".$masteries[$i][2]."(".$keystonename["$keystones[$i]"].")";
                
            }
        var_dump($keystones);
        echo "\n";
        var_dump($keystonename);
        ?>

            <script>
                var time = <?=$time?>;
                //time = time + 180;     --still unclear about offset
                setInterval(function () {
                    document.getElementById('time').innerHTML = SecondsToHMS(time);
                    time = time + 1;
                }, 1000);
            </script>
    </body>

    </html>