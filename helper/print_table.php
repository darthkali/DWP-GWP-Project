<form action="" method="post">
    <table border="1">
        <tbody>
        <tr>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>GebDatum</th>
            <th>Funktion FSR</th>
            <th>Rolle</th>
            <th>Optionen</th>
            </tr>
        <? foreach($content as $key => $tableRow) : ?>
            <tr>
                <? foreach ($tableRow as $tableCell) : ?>
                    <td> <?=$tableCell;?></td>
                <? endforeach; ?>
            </tr>
        <? endforeach; ?>

        </tbody>
    </table>
</form>
