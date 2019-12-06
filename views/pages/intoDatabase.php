<?
switch($siteId){

    case 0: header('Location: index.php?c=event&a=Events'); break;
    case 1: header('Location: index.php?c=event&a=CreateEvent'); break;
}
die;