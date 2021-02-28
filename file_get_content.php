<?php

$jsonString = file_get_contents('./dataset/TaskList.json');
$jsonArray = json_decode($jsonString, true); //seconda opzione, decide come devo convertirla

// var_dump($jsonString);

//echo gettype($jsonString);

print_r($jsonArray[17]['expirationDate']); //diciottesimo elemento e scelgo chiave che voglio. Ossia data scadenza
