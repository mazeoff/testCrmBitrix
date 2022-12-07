<?php
require_once ('crest.php');

function outputResult($result){
  echo '<pre>';
  	print_r($result);
  echo '</pre>';
}

echo '<b>Задача 1: Получить число всех сделок</b>';
$deals = CRest::call('crm.deal.list');

outputResult("Всего сделок: ".$deals['total']);

echo '<b>Задача 2: Получить все поля по контакту с номером телефона 55-58-88</b>';

$contact = CRest::call('crm.contact.list',
                [
                  'filter' => ['PHONE' => '555888']
                ]);
outputResult($contact['result']);

echo '<b>Задача 3 : Получить число лидов, у которых ответственный = Администратор Мозготека</b>';

$lead = CRest::call('crm.lead.fields');

$user = CRest::call('batch',[
  'halt' => 0,
  'cmd' =>[
     'user_by_name'=> 'user.search?NAME=Администратор Мозготека',
     'user_lead'=> 'crm.lead.list?fields[ASSIGNED_BY_ID]=$result[user_by_name][0][ID]',
  ]
]);

outputResult('Число лидов: '.$user['result']['result_total']['user_lead']);

?>
