<?php $champNameTemp=$champname[$data['participants'][$i]['championId']]['key'];?>
<div class='pseudotile'>
    <div class="tile tile-wide-y" data-role="tile" data-effect="slideRight">
        <div class="tile-content">
            <div class="image-container">
                <div class="frame">
                  <div class="live-slide">
                      <div class="image-container">
                          <div class="frame">
                              <img src="assets/splash/<?=$champNameTemp?>.jpg">
                          </div>
                      </div>
                  </div>

                    <?php if($extrasEnabled[0]=="y"):
                      foreach($skins['data'][$champNameTemp]['skins'] as $skinList):
                        if ($skinList['num']>0): ?>

                        <div class="live-slide" style="display:none;">
                            <div class="image-container">
                                <div class="frame">
                                    <img src="assets/splash/skins/<?=$champNameTemp?>_<?=$skinList['num']?>.jpg">
                                </div>
                            </div>
                        </div>
                    <?php endif; endforeach; endif;?>

                    <!-- DECLARE BORDER-->
                    <?php if($extrasEnabled[2]=="y"):?>
                    <img src="assets/ranked/<?=$ranked[$summonerIdList[$i]][0]['tier']?>/border.png" style="position:absolute; top:0px;">
                  <?php endif;?>
                </div>
                <div class="image-overlay" style="background-color:<?=$extrasEnabled[4]?>">
                    <?=$data['participants'][$i]['summonerName']?>
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
                <?=$spellname[$data['participants'][$i]['spell2Id']]['cooldown']?>s
            </div>
        </div>
    </div>

    <div class="tile ranked  <?php if($extrasEnabled[1]=="y") echo "bg".strtolower($ranked[$summonerIdList[$i]][0]['tier']); else echo strtolower($ranked[$summonerIdList[$i]][0]['tier']); ?>" data-role="tile">
        <div class="image-container">
            <div class="frame">
                <img src="assets/ranked/<?php if(isset($ranked[$summonerIdList[$i]][0]['tier'])) echo $ranked[$summonerIdList[$i]][0]['tier']; else echo 'ETC';?>/<?php if (isset($ranked[$summonerIdList[$i]][0]['entries'][0]['division'])) echo $ranked[$summonerIdList[$i]][0]['entries'][0]['division']; else echo 'Unranked'?>.png">
            </div>
            <div class="image-overlay" style="background-color:<?=$extrasEnabled[3]?>">
                <p>
                  <?php if(isset($ranked[$summonerIdList[$i]][0]['tier'])){
                    echo $ranked[$summonerIdList[$i]][0]['tier']." ".$ranked[$summonerIdList[$i]][0]['entries'][0]['division'];
                    echo "</br>".$ranked[$summonerIdList[$i]][0]['entries'][0]['leaguePoints']." LP";
                    echo "</br><span class='wins'>".$ranked[$summonerIdList[$i]][0]['entries'][0]['wins']."W </span>// <span class='losses'>".$ranked[$summonerIdList[$i]][0]['entries'][0]['losses']."L</span>";
                  }  else echo "UNRANKED";?>
                </p>
            </div>
        </div>
        <?php if (isset($ranked[$summonerIdList[$i]][0]['entries'][0]['leaguePoints'])): ?>
        <span class="tile-badge bg-blue"><?=$ranked[$summonerIdList[$i]][0]['entries'][0]['leaguePoints']?></span>
      <?php endif; ?>
    </div>
    <div class="tile tile-small" data-role="tile">
        <div class="tile-content ">
            <div class="image-container spell">
                <div class="frame">
                    <img src="assets/keystone/6362.png">
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
