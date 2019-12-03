<?
if($delete == 1){
    header('Location: index.php?c=pages&a=EventManagement');
}else{
    header('Location: index.php?c=pages&a=CreateEvent&eventId='.$eventData['ID']);
}
die;