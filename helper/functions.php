<?
function sortByName($left, $right){
    return strcasecmp($left['name'], $right['name']);
}

function validInput($str, $check)
{

    if (is_array($check)) {
        foreach ($check as $checkValue) {
            if (strpos($str, $checkValue) !== false) {
                return false;
            }
        }
    } else{
        if (strpos($str, $check) !== false) {
            return false;
        }
    }
    return true;
}


function printTable($content, $borderIsVisible = true)
{


    $rows = count($content);
    $cols = count($content[0]);

        $border = $borderIsVisible ? 'border ="1"' : '';
        $html = '<table ' . $border . '>';
        $html .= '<tr>'.
                     '<th>Vorname</th>'.
                     '<th>Nachname</th>'.
                     '<th>GebDatum</th>'.
                     '<th>Funktion FSR</th>'.
                     '<th>Rolle</th>'.
                     '<th>Optionen</th>'.
                 '</tr>';


        for($row = 0; $row < $rows; ++$row)
        {

            $html .= '<tr>';
            for($col = 0; $col < $cols; ++$col)
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

function createContent($path)
{
    $content = [];
    $keys = ['$frontname', '$rearname', '$dateOfBirth', '$functionFSR', '$role'];
    $file = fopen($path, 'r');

    while ($line = fgets($file)) {
        $content[] = array_combine($keys, explode(',', $line));
    }
    fclose($file);
    return $content;
}