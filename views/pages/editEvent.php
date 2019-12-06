<?
if($delete == 1){
    sendHeaderByControllerAndAction('event', 'EventManagement');
}else{
    header('Location: index.php?c=event&a=CreateEvent&eventId='.$eventData['ID']);
}
die;