<?php
$key=getenv('apikey');
$id=$_GET['id'];
$region="NA1";
$summoners=array();
$champions=array();
$spells=array();
$masteries=array();
$keystones=array();
$remap=array(0,1,3,2);

$data = json_decode(file_get_contents("https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$region/$id?api_key=$key"), true);
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
        $masteries[$i][$remap[$mTree]-1]+=$mtmp['rank'];
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
        $pId=0;
            foreach($data['participants'] as $participant){
                
                echo "<p class='team ";
                if ($participant['teamId']==100)
                    echo "red'>";
                else
                    echo "blue'>";
                echo strtoupper($participant['summonerName'])." is playing ".strtoupper($champname[$participant['championId']]['name'])." using ".strtoupper($spellname[$participant['spell1Id']]['name'])."/".strtoupper($spellname[$participant['spell2Id']]['name']);
                echo " - ";
                echo $masteries[$pId][0]."/".$masteries[$pId][1]."/".$masteries[$pId][2]." (".$keystonename["$keystones[$pId]"].")";
            $pId++;
            }
           
        
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