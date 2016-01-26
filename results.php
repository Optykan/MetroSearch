<?php
  $key=getenv('apikey');
  if(!$key)
    $key = $_GET['apikey'];
  $id=$_GET['id'];
  $region="NA1";
  $summonerIdList=array();
  $summoners=array();
  $champions=array();
  $spells=array();
  $masteries=array();
  $keystones=array();
  $remap=array(0,1,3,2);
  $extrasEnabled=array("y", "y", "y", "rgba(155, 89, 182,0.8)", "rgba(155, 89, 182,0.8)");
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

  if (isset($_COOKIE['pref']))
    $extrasEnabled=explode("/", $_COOKIE['pref']);

  $ranked=json_decode(file_get_contents("https://na.api.pvp.net/api/lol/na/v2.5/league/by-summoner/$summonerIdRequest/entry?api_key=$key"), true);
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

        <div data-role="dialog" id="options" data-close-button='true'>
            <h1 class='oheader'>Options</h1>
            <div class="row">
                <label class="switch" id="dynSplash">
                    <input class="prefSwitch" type="checkbox" id="dynSplashCheck">
                    <span class="check"></span>
                </label>
                <p>
                    Enable dynamic splashes (~1MB/unique champ)
                </p>
            </div>
            <div class="row">
                <label class="switch" id="rankBg">
                    <input class="prefSwitch" type="checkbox" id="rankBgCheck">
                    <span class="check"></span>
                </label>
                <p>
                    Enable ranked background images (~25KB/unique rank)
                </p>
            </div>
            <div class="row">
                <label class="switch" id="rankBorder">
                    <input class="prefSwitch" type="checkbox" id="rankBorderCheck">
                    <span class="check"></span>
                </label>
                <p>
                    Enable ranked borders (~25KB/unique rank)
                </p>
            </div>
            <hr></hr>

            <div class='row' style="margin-top:20px;">
                <p class='boxText' style="padding-left:0px;">
                    Set custom ranked hover color:
                </p>
                <div class="input-control text" data-role="input">
                    <input class='prefSwitch' id='splashBgHoverCol' type="text" placeholder="#HEX or RGB(A)" onkeyup="hoverCol(this)">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
            <div class='row'>
                <p class='boxText' style="padding-left:0px;">
                    Set custom splash hover color :
                </p>
                <div class="input-control text" data-role="input">
                  <input class='prefSwitch' id='rankBgHoverCol' type="text" placeholder="#HEX or RGB(A)"  onkeyup="hoverCol(this)">
                  <button class="button helper-button clear"><span class="mif-cross"></span></button>
              </div>
            </div>


        </div>
        <div class="settings" onclick="showDialog('#options');">
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
        <script src="js/preferences.js"></script>
        <script src='js/time.js'></script>
        <script>
            var open = false;
            document.getElementsByClassName("dialog-close-button")[0].addEventListener('click', function() {
                showDialog('#options');
            }, false);

            function showDialog(id) {
                var dialog = $(id).data('dialog');
                if (open) {
                    savePref();
                    open = false;
                    dialog.close();
                } else {
                    loadPref();
                    open = true;
                    dialog.open();
                }
            }
            $(document).click(function(event) {
                var target = $(event.target);
                if (!target.is("#options *,#options,.settings,.icon") && open)
                    showDialog('#options');
            });
        </script>
    </body>

    </html>
