<?
switch($siteId){

    case 0: header('Location: index.php?c=pages&a=Events'); break;
    case 1: header('Location: index.php?c=pages&a=CreateEvent'); break;
}
die;