<?
if($delete == 1){
    header('Location: index.php?c=event&a=EventManagement');
}else{
    header('Location: index.php?c=event&a=CreateEvent&eventId='.$eventData['ID']);
}
die;