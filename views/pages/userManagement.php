<div class="SitePicture" id="fadeInImg">
    <img class="center" src="<?=ROOTPATH.'assets\images\matrix.jpg'?>" alt="ProfilPageImage">
</div>

<div class="Content" id="fadeIn">
    <h1>Nutzerverwaltung</h1>

    <div class="filterButton">
    <?php if($role === false) : ?>
        <a href="index.php/?c=user&a=userManagement&role=3">Nur Mitarbeiter anzeigen</a>
    <?php else : ?>
        <a href="index.php/?c=user&a=userManagement">Alle anzeigen</a>
    <?php endif; ?>
    <?php
    $active = filter_input(INPUT_POST, 'onlyMember', FILTER_VALIDATE_BOOLEAN);
    ?>
    </div>

    <br><br>
    <h3>Aktive Nutzer</h3>
    <?
    $html = '<table border ="1">';
    $html .= '<tr>'.
        '<th>Vorname</th>'.
        '<th>Nachname</th>'.
        '<th>Geburtstag</th>'.
        '<th>E-Mail</th>'.
        '<th>Rolle</th>'.
        '<th>Optionen</th>'.
        '</tr>';

    foreach($accounts as $index => $account) {
        $html .= '<tr>';
        $html .= '<td>'. $accounts[$index]['FIRSTNAME'    ]. '</td>';
        $html .= '<td>'. $accounts[$index]['LASTNAME'     ]. '</td>';
        $html .= '<td>'. $accounts[$index]['DATE_OF_BIRTH']. '</td>';
        $html .= '<td>'. $accounts[$index]['EMAIL'        ]. '</td>';
        $html .= '<td>'. $accounts[$index]['ROLE_ID'  ]. '</td>';

        $html .= '<td>';
        $html .= '<a href="index.php?c=user&a=newUser&UserId='.$accounts[$index]['ID' ].'"><input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="User bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit" style="outline:0;"></a>';
        $html .= '<a href="index.php?c=user&a=EditUser&UserId='.$accounts[$index]['ID' ].'"><input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="User löschen" src="/FSAI-Site/assets/images/entfernen.png" alt="Edit" style="outline:0;"></a>';
        $html .= '</td>';
        $html .= '</tr>';
    }
        $html .= '</table>';
        echo $html;
    ?>
</div>