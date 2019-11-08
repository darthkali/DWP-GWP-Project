<!DOCTYPE html>
<html lang="de">
<head>
    <title>Nutzerverwaltung</title>
    <meta name="description" content="Nutzerverwaltung">
    <? include_once '../head.php';?>
</head>

<body>
<? include '../navMenuBar.php';?>

<div id="SitePicture" class="fadeInImg">
    <img class="center" src="/FSAI-Site/assets/images/matrix.jpg" alt="ProfilPageImage">
</div>

<div id="Content" class="fadeIn">
    <h1>Nutzerverwaltung</h1>
    <?
    function printTable($content, $borderIsVisible = true)
    {

        $rows = count($content);
        $cols = count($content[0]);

        if($cols != 6)
        {
            echo 'Fehler';
        }
        else
        {

            $border = $borderIsVisible ? 'border ="1"' : '';
            $html = '<table ' . $border . '>';

            $html .= '<tr>';
            for($col = 0; $col < $cols; ++$col)
            {
                $html .= '<th>';
                $html .= isset($content[0][$col]) ? $content[0][$col] : '---';
                $html .= '</th>';
            }
            $html .= '</tr>';

            for($row = 1; $row < $rows; ++$row)
            {

                $html .= '<tr>';
                for($col = 0; $col < $cols - 1; ++$col)
                {
                    $html .= '<td>';
                    $html .= isset($content[$row][$col]) ? $content[$row][$col] : '---';
                    $html .= '</td>';
                }

                $html .= '<td>';
                $html .= '<input type="image" name="edit[8c9aa635455b033d2bcb9c3b24489ec7]" title="User bearbeiten" src="/FSAI-Site/assets/images/edit.png" alt="Edit" style="outline:0;">';
                $html .= '<input type="image" name="message[8c9aa635455b033d2bcb9c3b24489ec7]" title="Nachricht senden" src="/FSAI-Site/assets/images/email.png" alt="Nachricht" style="outline:0;">';
                $html .= '<input type="image" name="delete[8c9aa635455b033d2bcb9c3b24489ec7]" title="User entfernen" src="/FSAI-Site/assets/images/entfernen.png" alt="Delete" style="outline:0;" onclick="return confirm("Soll der Benutzer: Test Test wirklich entfernt werden?")">';


                $html .= '</td>';
                $html .= '</tr>';

            }
            $html .= '</table>';
            echo $html;
        }
    }

    $myArray = array(
        array('Vorname','Nachname', 'GebDatum','Funktion FSR', 'Rolle' ,'Optionen'),
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
        array('Timo','Weiß','','Archiviertes Mitglied','User'),

    );

    printTable($myArray);
    ?>
</div>


<? include '../footer.php';?>
</body>
</html>