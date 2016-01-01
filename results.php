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
                
                for($k=0;$k<3;$k++){
                    $masteries[$i][$k]=0;
                }
                foreach($data['participants'][$pId]['masteries'] as $mtmp){
                    $mTree=floor(($mtmp['masteryId']-6000)/100);
                    $masteries[$pId][$remap[$mTree]-1]+=$mtmp['rank'];
                    $keyCheck=floor($mtmp['masteryId']-(6000+$mTree*100));
                    if($keyCheck>60){
                        $keystones[$pId]=$mtmp['masteryId'];
                    }
                }
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