<?php
  $key=getenv('apikey');
  $id=$_GET['id'];
  $region="NA1";
  $summonerIdList=array();
  $summoners=array();
  $champions=array();
  $spells=array();
  $masteries=array();
  $keystones=array();
  $remap=array(0,1,3,2);
  $time=0;

  $data = json_decode(file_get_contents("https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$region/$id?api_key=$key"), true);
  //$data =json_decode(file_get_contents("json/testfile.json"), true);

  $skins =json_decode(file_get_contents("json/skins.json"), true);
  $champname = json_decode(file_get_contents("json/champions.json"), true);
  $spellname = json_decode(file_get_contents("json/spells.json"), true);
  $keystonename = json_decode(file_get_contents("json/masteries.json"), true);

  $summonerIdRequest="";

  $gameQueue = $data['gameQueueConfigId'];
  $players=10;
  if($gameQueue === 8 || $gameQueue === 9 || $gameQueue === 41 || $gameQueue === 52){
      $players=6;
  }

  for ($i=0;$i<$players;$i++){
    $summonerIdRequest.=$data['participants'][$i]['summonerId'].",";
  }
  $summonerIdList=explode(",",substr($summonerIdRequest, 0, -1));

  $ranked=json_decode(file_get_contents("https://na.api.pvp.net/api/lol/na/v2.5/league/by-summoner/$summonerIdRequest/entry?api_key=$key"));
  //$ranked=json_decode(file_get_contents("json/testranked.json"), true);
?>
    <html>

    <head>
        <link href='https://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/metro/3.0.13/css/metro.min.css" rel='stylesheet'>
        <link href="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/css/metro-icons.min.css" rel='stylesheet'>
        <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/metro/3.0.13/css/metro-responsive.css" rel="stylesheet">-->
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
        <link href='css/styles.css' rel='stylesheet'>
        <link href="css/options.css" rel="stylesheet">
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.blue-pink.min.css">

        <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
        <script src="js/metro.js"></script>
    </head>

    <body>
        <div class="row tile-container red">
            <?php
            for ($i =0;$i<$players/2;$i++){
              include("template/template.php");
            }

        ?>
        </div>
        <h1 class="middle">VS</h1>
        <div class="row tile-container blue">
            <?php
            for ($i=$players/2;$i<$players;$i++){
                include("template/template.php");
            }

        ?>
        </div>

        <div data-role="dialog,draggable" id="options" data-close-button='true'>
            <h1>Options</h1>
            <div class="row">
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect is-checked" id="dynSplash" for="dynSplashCheck">
                    <input type="checkbox" id="dynSplashCheck" class="mdl-switch__input">
                    <span class="mdl-switch__label"></span>
                </label>
                <p>
                    Enable dynamic splashes
                </p>
            </div>
            <div class="row">
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect is-checked" id="rankBg" for="rankBgCheck">
                    <input type="checkbox" id="rankBgCheck" class="mdl-switch__input">
                    <span class="mdl-switch__label"></span>
                </label>
                <p>
                    Enable ranked background images
                </p>
            </div>
            <div class="row">
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect is-checked" id="rankBorder" for="rankBorderCheck">
                    <input type="checkbox" id="rankBorderCheck" class="mdl-switch__input">
                    <span class="mdl-switch__label"></span>
                </label>
                <p>
                    Enable ranked borders
                </p>
            </div>

        </div>
        <div class="settings" onclick="(function(){$('#options').data('dialog').open();})()">
            <i class="icon ion-android-options"></i>
        </div>
        <!--<script>

                //time = time + 180;     --still unclear about offset
                setInterval(function () {
                    document.getElementById('time').innerHTML = SecondsToHMS(time);
                    time = time + 1;
                }, 1000);
            </script>-->
        <!-- Remove the next JS to prevent angled clicking -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

        <script src='js/time.js'></script>
        <script>
            function showDialog(id) {
                var dialog = $(id).data('options');
                dialog.open();
            }
        </script>
    </body>

    </html>
