<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets\images\matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">
    <h1>Nutzerverwaltung</h1>
    <?
    $activeUsers = array(
        array('Danny','Steinbrecher', '24.12.1989', 'Sprecher', 'Admin'),
        array('Anton','Bespablov','','Finanzer','User'),
        array('Frieder','Ullmann','','stellv. Finanzer','User'),
        array('Nico','Merkel','','stellv. Sprecher','User'),
        array('Marcel','van der Heide','','Mitglied','User'),
        array('Dennis','Krischal','','Mitglied','User'),
        array('Adrian','Petzold','','Mitglied','User'),
        array('Chritian','Harder','','Mitglied','User'),
        array('Michael','Hopp','','Mitglied','User'),
        array('Sarah','Stefan','','Mitglied','User'),
        array('Niclas','Jarowsky','','Mitglied','Admin'),
    );
    $notActiveUsers = array(
        array('Timo','Weiß','','Archiviertes Mitglied','User'),
    );
    ?>

    <a href="<?=$_SERVER['SCRIPT_NAME']?>/?p=newUser"> <button type="button">neuen Nutzer anlegen<i class="fa fa-floppy-o" aria-hidden="true"></i></button></a>


    <br><br>
    <h3>Aktive Nutzer</h3>
    <?
    $rows = 12;
    $cols = count($accounts[0]);

    $border =  'border ="1"';
    $html = '<table ' . $border . '>';
    $html .= '<tr>'.
        '<th>id</th>' .
        '<th>Vorname</th>'.
        '<th>Nachname</th>'.
        '<th>Geburtstag</th>'.
        '<th>E-Mail</th>'.
        '<th>Rolle</th>'.
        '<th>Optionen</th>'.
        '</tr>';


        foreach($accounts as $index => $account) {
    $html .= '<tr>';

            $html .= '<td>'. $accounts[$index][ 'ID' ]. '</td>';
            $html .= '<td>'. $accounts[$index]['FIRSTNAME'    ]. '</td>';
            $html .= '<td>'. $accounts[$index]['LASTNAME'     ]. '</td>';
            $html .= '<td>'. $accounts[$index]['DATE_OF_BIRTH']. '</td>';
            $html .= '<td>'. $accounts[$index]['EMAIL'        ]. '</td>';
            $html .= '<td>'. $accounts[$index]['ROLE_ID'  ]. '</td>';




        $html .= '<td>';
            $html .= '<a href="';
            $html .= $_SERVER['SCRIPT_NAME'];
            $html .= '/?p=profil">';
                $html .= '<input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="User bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit" style="outline:0;"></a>';
            $html .= '<input type="image" name="message[8c9aa635455b033d2bcb9c3b24489ec7]" title="Nachricht senden" src="/FSAI-Site/assets/images/email.png" alt="Nachricht" style="outline:0;">';
            $html .= '<input type="image" name="delete[8c9aa635455b033d2bcb9c3b24489ec7]" title="User entfernen" src="/FSAI-Site/assets/images/entfernen.png" alt="Delete" style="outline:0;" onclick="return confirm("Soll der Benutzer: Test Test wirklich entfernt werden?")">';


            $html .= '</td>';
        $html .= '</tr>';

    }
    $html .= '</table>';
    echo $html;

    ?>

        <?// printTable($accounts);   ?>
    <br>
    <h3>Archivierte Nutzer</h3>
        <?printTable($notActiveUsers);   ?>
</div>
>