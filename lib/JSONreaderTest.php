<?php
declare(strict_types=1);
//test da lanciare da cartella lib
system("clear");
require "../../Vendor/testTool.php";
require "./JSONreader.php";

$dataset = [//diversi casi  casi: file letto e tutto ok,file letto ma non va bene, file non esiste, file vuoto
    [
        'description'=>'Gestione dell\'errore per file inesistente',
        'filepath'=>'./ciccio.json',
        'error'=>'not-exists', //questo e 404 sotto ce lo siamo inventati noi.
        'errorCode'=> 404
    ],
    [
        'description'=>'Lettura dati in array 20 elementi',
        'filepath'=>'../dataset/TaskList.json',
        'type'=>'array',
        'count'=> 20
    ],
    [
        'description'=>'Gestione file con errori di sintassi',
        'filepath'=>'../dataset/TaskList-error.json',
        'error'=>'syntax-error',
        'errorCode'=> 123
    ],
    [
        'filepath'=>'../dataset/TaskList-zero.json',
        'type'=>'array',
        'count'=> 0
    ]

];

foreach ($dataset as $row)
{

    try
    {
        $filepath = $row["filepath"];
        $actual = JSONreader($filepath);

        if(empty($row['error'])) //isset controlla se valore/variabile etc è impostato... Is set. oppure metto empty, ossia il contrario di isset. !isset=empty
        {
            $type = $row['type'];

            assertEquals($type, gettype($actual), 'tipo di dato'); //$actual, risultato funzione
            assertEquals($row['count'], count($actual), 'numero di elementi');
        }
        else
        {
            assertEquals($row['error'], null, 'era attesa un\' eccezione'); //mi aspetto un errore, ma qui si esegue un controllo
            assertEquals($row['errorCode'],null, 'era attesa un\' eccezione');
        }
    }
    catch (Exception $e)  //$e indica dove finisce errore
    { 
        assertEquals($e->getMessage(), $row['error'], 'messaggio di errore');
        assertEquals($e->getCode(), $row['errorCode'], 'Codice di errore');

        echo $e->getLine();
    } 


}

?>