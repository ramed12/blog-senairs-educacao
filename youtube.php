<?php 
$API_key = 'AIzaSyAs4l4Z8glwmNPlTYfXAvn47_QdFYKS808';
$channelID = 'UCfYDyZ9XxOFw9J3ijgd8pYA';
$maxResult = 3; 
$apiError = 'Video not Found';

$conn = mysqli_connect('localhost', 'blog_sesi', 'S3s1@F!rgs221271','blog_sesi');

try{
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResult.'&key='.$API_key.''); 
  
    if($apiData){ 
        $videoList = json_decode($apiData); 
        
        $sql = "SELECT * FROM youtube WHERE data_insert >= NOW() LIMIT 3";
        foreach($videoList->items as $video){
            
        $sql = "SELECT * FROM youtube WHERE url_video = '".$video->id->videoId."'";
        $query = $conn->query($sql);
        $find = mysqli_num_rows($query);
            if($find == 0){
            $youtube = "INSERT INTO youtube (data_insert,image_default,image_medium,image_high ,url_video,title) VALUES('".date('Y-m-d H:i:s')."','".$video->snippet->thumbnails->default->url."','".$video->snippet->thumbnails->medium->url."','".$video->snippet->thumbnails->high->url."','".$video->id->videoId."','".$video->snippet->title."')";
    
            $conn->query( $youtube );
            }
        }
    }else{  
        throw new Exception('Invalid API key or channel ID.');
    }   
}catch(Exception $e){
    $apiError = $e->getMessage();
}   

?>