<?php 
session_start();
$url 	= $_GET['image']; //image url
$str 	= parse_url($url); // parse url to explode it
$path 	= explode('/', $str['path']); // explode url path to array with "/"

if (!file_exists('images')) { //check for images dir
    mkdir('images', 0777, true); //create the dir if not exists
}

copy($url, 'images/'.end($path)); // grab the image to local files
$_SESSION['message'] = 'Downloaded Success'; // success message
return header('location: icons.php?keyword='.$_GET['back'].'&page='.$_GET['page']); //redirect back to search result page
?>