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

  //$data = json_decode(file_get_contents("https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$region/$id?api_key=$key"), true);
  $data =json_decode(file_get_contents("json/testfile.json"));

  $skins =json_decode(file_get_contents("json/skins.json"));
  $champname = json_decode(file_get_contents("json/champions.json"), true);
  $spellname = json_decode(file_get_contents("json/spells.json"), true);
  $keystonename = json_decode(file_get_contents("json/masteries.json"), true);

  $gameQueue = $data['gameQueueConfigId'];
  $players=10;
  if($gameQueue === 8 || $gameQueue === 9 || $gameQueue === 41 || $gameQueue === 52){
      $players=6;
  }
?>
    <html>

    <head>
        <link href='https://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>
        <link href='css/styles.css' rel='stylesheet'>

        <script src='js/time.js'></script>
    </head>

    <body>
      <div class="row tile-container red">
        <?php
            for ($i =0;$i<$players/2;$i++){
              include('template.php');
            }

        ?>
      </div>
      <div class="row tile-container blue">
        <?php
            for ($i=$players/2;$i<$players;$i++){
                include('template.php');
            }

        ?>
      </div>

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
