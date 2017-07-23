<?php 
session_start();
$url 	= $_GET['image'];
$str 	= parse_url($url);
$path 	= explode('/', $str['path']);

copy($url, 'images/'.end($path));
$_SESSION['message'] = 'Downloaded Success';
return header('location: icons.php?keyword='.$_GET['back'].'&page='.$_GET['page']);
?>