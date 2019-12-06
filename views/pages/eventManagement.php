
<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets/images/matrix.jpg'?>" alt="ProfilPageImage">
</div>
<div class="Content" id="fadeIn">
    <h1>Eventverwaltung</h1>
    <?
    $html = '<table border ="1">';
    $html .= '<tr>'.
        '<th>EventID</th>' .
        '<th>Erstellt am</th>'.
        '<th>Eventname</th>'.
        '<th>Datum</th>'.
        '<th>Bildpfad</th>'.
        '<th>Optionen</th>'.
        '</tr>';

    foreach($eventList as $event) {
        $html .= '<tr>';
        $html .= '<td>'. $event['ID']. '</td>';
        $html .= '<td>'. date_format(date_create($event['CREATED_AT']), 'd.m.Y H:i:s'). '</td>';
        $html .= '<td>'. $event['NAME']. '</td>';
        $html .= '<td>'. date_format(date_create($event['DATE']), 'd.m.Y'). '</td>';
        $html .= '<td>'. $event['PICTURE']. '</td>';

        $html .= '<td>';
        $html .= '<a href="index.php?c=event&a=EditEvent&delete=0&eventId='.$event['ID'].'"><input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="Event bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit" style="outline:0;"></a>';
        $html .= '<a href="index.php?c=event&a=EditEvent&delete=1&eventId='.$event['ID'].'&picturePath='.$event['PICTURE'].'"><input type="image" name="delete[8c9aa635455b033d2bcb9c3b24489ec7]" title="Event entfernen" src="/FSAI-Site/assets/images/entfernen.png" alt="Delete" style="outline:0;"></a>';
        $html .= '</td>';
        $html .= '</tr>';

    }
    $html .= '</table>';
    echo $html;
    ?>
    <a href="?c=event&a=CreateEvent"><button type="button">Neues Event anlegen<i class="fa fa-floppy-o" aria-hidden="true"></i></button></a>
    <a href="index.php?c=event&a=CreateLocation"><button type="button">Neue Location erstellen</button></a>
</div>
