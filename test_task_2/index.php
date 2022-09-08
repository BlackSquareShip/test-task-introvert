<?php
require_once(__DIR__ . '/intr-sdk-test/vendor/autoload.php');

// Configure API key authorization: api_key
Introvert\Configuration::getDefaultConfiguration()->setApiKey('key', '23bc075b710da43f0ffb50ff9e889aed');

$arrStatusId = array(41477665, 48030112,41477662);
$fieldDateId = 1521743;
function getDatesOnMonth()
{
    $datesOnMonth = array();
    $currentDate = date_create(date('Y-m-d'));
    for($i = 0; $i <=30; $i++) {
        $datesOnMonth += [date_format($currentDate, 'Y-m-d H:i:s') => 0];
        date_modify($currentDate, '1 day');
    }
    return $datesOnMonth;
}

function getLeadsByDate($fieldDateId=null, ...$arrStatusId ) {
    $pipelineId = 4484737;
    $arrayFromDate = [];
    $offset = 0;
    $count = 50;
    $api = new Introvert\ApiClient();
    try {
        foreach ($arrStatusId as $statusId) {
            $result = $api->lead->getAll(null, $statusId, null, null, $count, $offset);
            while ($result['count'] == $count) {
                for ($i = 0; $i < $result['count']; $i++) {
                    for ($j = 0; $j < count($result['result'][$i]['custom_fields']); $j++) {
                        if ($result['result'][$i]['custom_fields'][$j]['id'] == $fieldDateId) {
                            $arrayFromDate[] = $result['result'][$i]['custom_fields'][$j]['values'][0]['value'];
                        }
                    }
                }
                $offset += $count;
                $result = $api->lead->getAll(null, $statusId, null, null, $count, $offset);
            }
            for ($i = 0; $i < $result['count']; $i++) {
                for ($j = 0; $j < count($result['result'][$i]['custom_fields']); $j++) {
                    if ($result['result'][$i]['custom_fields'][$j]['id'] == $fieldDateId) {
                        $arrayFromDate[] = $result['result'][$i]['custom_fields'][$j]['values'][0]['value'];
                    }
                }
            }
        }
        $dateOnMonth = getDatesOnMonth();
        foreach ($dateOnMonth as $key => $value){
            foreach ($arrayFromDate as $key_2 => $value_2){
                if($key == $value_2){
                    $dateOnMonth[$key] += 1;
                }
            }
        }
        return $dateOnMonth;
    } catch (Exception $e) {
        echo($e);
        return false;
    }
}

$arrayFromDate = getLeadsByDate($fieldDateId, $arrStatusId);
echo json_encode($arrayFromDate);


