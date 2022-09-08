<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        *{
            padding: 0;
            border-spacing:0;
            margin: 0;
        }
        table {
            border: 1px solid black;
            margin: 50px;
            width: 450px;
        }
        td {
            border: 1px solid black;
            padding: 5px;
        };
    </style>
</head>
<body>

<form  method="post" id='form'>
    <p>Найти успешные сделки в диапазоне от <input type="date" name="From" id=""> по <input type="date" name="To" id=""></p>
    <input type="submit" value="Найти">
</form>

<?php

$date_from = strtotime($_POST['From']);
$date_to = strtotime($_POST['To']);

require_once(__DIR__ . '/intr-sdk-test/vendor/autoload.php');

// Configure API key authorization: api_key
Introvert\Configuration::getDefaultConfiguration()->setApiKey('key', '23bc075b710da43f0ffb50ff9e889aed');
function getBudgetInDateRage($date_from, $date_to){
    $api = new Introvert\ApiClient();
    $offset = 0;
    $budget = 0;
    $count = 50;
    try {
        $result = $api->lead->getAll(null, 142, null, null, $count, $offset);
        while($result['count'] == $count){
            for($i = 0; $i < $result['count']; $i++){
                if($date_from < $result['result'][$i]['date_close'] && $result['result'][$i]['date_close'] < $date_to){
                    $budget += $result['result'][$i]['price'];
                }
            }
            $offset += $count;
            $result = $api->lead->getAll(null, 142, null, null, $count, $offset);
        }
        for($i = 0; $i < $result['count']; $i++){
            if($date_from < $result['result'][$i]['date_close'] && $result['result'][$i]['date_close'] < $date_to){
                $budget += $result['result'][$i]['price'];
            }
        }
        return $budget;

    } catch (Exception $e) {
        return false;
    }
}
function getClients() {
    return [
        [
            'id' => 1,
            'name' => 'intrdev',
            'api' => '23bc075b710da43f0ffb50ff9e889aed'
        ],
        [
            'id' => 2,
            'name' => 'artedegrass',
            'api' => 'someApi',
        ],
        [
            'id' => 5,
            'name' => 'some Company',
            'api' => '23bc075b710da43f0ffb50ff9e889aed'
        ],
    ];
}

function getClientsBudget($date_from, $date_to){
    $allBudget = 0;
    $clients = getClients();
    echo "<table><caption>Успешные сделки в диапазоне от ".date('d.m.y', $date_from)." по ".date('d.m.y', $date_to)."</caption><thead><tr><td>ID клиента</td><td>Название</td><td>Сумма успешных сделок</td></tr></thead><tbody>";
    for($i = 0; $i < count($clients); $i++){
        Introvert\Configuration::getDefaultConfiguration()->setApiKey('key', $clients[$i]['api']);
        if(getBudgetInDateRage($date_from, $date_to)){
            $clientBudget = getBudgetInDateRage($date_from, $date_to);
            $allBudget += $clientBudget;
            echo "<tr>";
            echo "<td>".$clients[$i]['id']."</td>";
            echo "<td>".$clients[$i]['name']."</td>";
            echo "<td>".$clientBudget."</td>";
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td>".$clients[$i]['id']."</td>";
            echo "<td>".$clients[$i]['name']."</td>";
            echo "<td>У клиента нет доступа</td>";
            echo "</tr>";
        } 
    }

    echo "<tr><td colspan = '3'>Итого, общая сумма успешних сделок: " . $allBudget . "</td></tr>";
    echo "</tbody></table>";
}

getClientsBudget($date_from, $date_to);

?>

</body>
</html>