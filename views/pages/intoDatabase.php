<?
switch($siteId){
    case 0: sendHeaderByControllerAndAction('event', 'Events'); break;
    case 1: sendHeaderByControllerAndAction('event', 'CreateEvent'); break;
}
die;