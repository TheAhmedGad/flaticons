<?php 
session_start();
$url 	= $_GET['image'];
$str 	= parse_url($url);
$path 	= explode('/', $str['path']);

if (!file_exists('images')) {
    mkdir('images', 0777, true);
}

copy($url, 'images/'.end($path));
$_SESSION['message'] = 'Downloaded Success';
return header('location: icons.php?keyword='.$_GET['back'].'&page='.$_GET['page']);
?>