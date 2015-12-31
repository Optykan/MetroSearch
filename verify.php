<?php
    function verify(){
    defined('auth') or die("403 - forbidden");
    $key=getenv('apikey');
    if(!$key)
        die ("500 - server missing");

    $name=$_GET['inputname'];
    $name = strtolower(preg_replace('/\s+/', '', $name));
    if(strlen($name)<3 || strlen($name)>17){
        echo "name must be between 3-17 characters";
        exit(0);
    }

    $summID="https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/".$name."?api_key=".$key;
    $json = file_get_contents($summID);
    $data = json_decode($json, true);
    $id = $data[$name]['id']; 

    if(strpos($http_response_header[0],'200') !== false){
        /*$url="https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/NA1/".$id."?api_key=".$key;
        $response = file_get_contents($summID);

        if(strpos($http_response_header[0],'404')!==false) {
            echo "summoner not in game";
        }
        elseif (strpos($http_response_header[0],'429') !==false){
            echo "please wait 10 seconds";
        }
            elseif (strpos($http_response_header[0],'400') !==false){
            echo "bad request";
        }
        elseif (strpos($http_response_header[0],'403') !==false){
            echo "access denied";
        }
        elseif (strpos($http_response_header[0],'200') !==false){
            echo "success";
        }*/
        echo "ID=".$id;

    }
    elseif (strpos($http_response_header[0],'400') !== false){
        echo "400 - bad request";
    }
    elseif (strpos($http_response_header[0],'401') !== false){
        echo "401 - unauthorized";
    }
    elseif (strpos($http_response_header[0],'403') !== false){
        echo "403 - access denied";
    }
    elseif (strpos($http_response_header[0],'404') !== false){
        echo "404 - summoner not found";
    }
    elseif (strpos($http_response_header[0],'429') !== false){
        echo "429 - rate limit exceeded";
    }
    elseif (strpos($http_response_header[0],'500') !== false){
        echo "500 - api error";
    }
    elseif (strpos($http_response_header[0],'503') !== false){
        echo "503 - api down";
    }
    }
    if (isset($_GET['inputname'])){
        verify();
    }
?>