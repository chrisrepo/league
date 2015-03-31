<?php
include('php-riot-api.php');
include('FileSystemCache.php');

//testing classes
//using double quotes seems to make all names work (see issue: https://github.com/kevinohashi/php-riot-api/issues/33)
$summoner_name = "chrisrep"; 

$test = new riotapi('na');


$testCache = new riotapi('na', new FileSystemCache('cache/'));
//$r = $test->getSummonerByName($summoner_name);

//$r = $test->getSummoner($summoner_id);
//$r = $test->getSummoner($summoner_id,'masteries');
//$r = $test->getSummoner($summoner_id,'runes');
//$r = $test->getSummoner($summoner_id,'name');
//$r = $test->getStats($summoner_id);
//$r = $test->getStats($summoner_id,'ranked');
//$r = $test->getTeam($summoner_id);
//$r = $test->getLeague($summoner_id);
//$r = $test->getGame($summoner_id);
//$r = $test->getChampion();
try {
    $list = $test->getSummonerByName($summoner_name);
    $me = $list[$summoner_name];
    $id = $me['id'];
    
    $stats = $test->getStats($id,'summary');
    $statsRanked = $test->getStats($id,'ranked');
    $champsRanked = $statsRanked['champions'];
    $statR = $champsRanked['3'];
    $myStats = $statR['stats'];
    echo '<br><br> Ranked:<br>';
    echo 'Total champion kills this season: '. $myStats['totalChampionKills'].'<br>';
    $averageCs = $myStats['totalMinionKills']/$myStats['totalSessionsPlayed'];
    echo 'Average CS per game: '.$averageCs.'<br>';
    print_r($statsRanked);
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
};

?>