<?php 
$API_key = 'AIzaSyAs4l4Z8glwmNPlTYfXAvn47_QdFYKS808';
$channelID = 'UCfYDyZ9XxOFw9J3ijgd8pYA';
$maxResult = 3; 
$apiError = 'Video not Found';
try{
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResult.'&key='.$API_key.''); 
  
    if($apiData){ 
        $videoList = json_decode($apiData); 
    }else{  
        throw new Exception('Invalid API key or channel ID.');
    }   
}catch(Exception $e){
    $apiError = $e->getMessage();
}   

?>