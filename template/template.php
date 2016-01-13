<!--
DECLARED SUMMONER ID is $i
$data is JSON data

-->
<?php $champNameTemp=$champname[$data['participants'][$i]['championId']]; ?>
<div class='pseudotile'>
    <div class="tile tile-wide-y" data-role="tile" data-effect="slideRight">
        <div class="tile-content">
            <div class="image-container">
                <div class="frame">
                  <div class="live-slide">
                      <div class="image-container">
                          <div class="frame">
                              <img src="/assets/splash/<?=$champNameTemp?>.jpg">
                          </div>
                      </div>
                  </div>
                    <?php
                    foreach($skins['data'][$champNameTemp]['skins'] as $skinList){
                      if ($skinList['num']>0)
                        #ignore zero because zero is already handled before
                        include("live-slide.php");
                    }
                    ?>

                    <!-- DECLARE BORDER-->
                    <img src="../assets/ranked/SILVER/border.png" style="position:absolute; top:0px;">
                </div>
                <div class="image-overlay">
                    Overlay text
                </div>
            </div>
        </div>
    </div>
    <div class="tile tile-small" data-role="tile">
        <div class="image-container spell">
            <div class="frame">
                <img src="<?=$spellname[$data['participants'][$i]['spell1Id']]['image']?>">
            </div>
            <div class="image-overlay">
                <?=$spellname[$data['participants'][$i]['spell1Id']]['cooldown']?>s
            </div>
        </div>
    </div>
    <div class="tile tile-small" data-role="tile">
        <div class="image-container spell">
            <div class="frame">
                <img src="<?=$spellname[$data['participants'][$i]['spell2Id']]['image']?>">
            </div>
            <div class="image-overlay">
                <?=$spellname[$data['participants'][$i]['spell12d']]['cooldown']?>s
            </div>
        </div>
    </div>

    <div class="tile ranked silver" data-role="tile">
        <div class="image-container">
            <div class="frame">
                <img src="/assets/ranked/SILVER/I.png">
            </div>
            <div class="image-overlay">
                Bronze 5 </br>
                25 LP </br>
                o o x - -
            </div>
        </div>
        <span class="tile-badge bg-blue">$LP</span>
    </div>
    <div class="tile tile-small" data-role="tile">
        <div class="tile-content ">
            <div class="image-container spell">
                <div class="frame">
                    <img src="/assets/keystone/6362.png">
                </div>
                <div class="image-overlay">
                    18/12/0
                </div>
            </div>
        </div>
    </div>
    <div class="tile tile-small" data-role="tile">
        <div class="tile-content ">RUNES</div>
    </div>
</div>
