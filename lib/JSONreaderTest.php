<?php
declare(strict_types=1);

system("clear");

require "./JSONreader.php";

$dataset = [//diversi casi  casi: file letto e tutto ok,file letto ma non va bene, file non esiste, file vuoto
    [
        'filepath'=>'./ciccio.json',
        'error'=>'fil-does-not-exists', //questo e 404 sotto ce lo siamo inventati noi.
        'errorCode'=> 404
    ],
    [
        'filepath'=>'../dataset/TaskList.json',
        'type'=>'array',
        'count'=> 20
    ],
    [
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

        if(isset($row['type'])) //isset controlla se valore/variabile etc è impostato... Is set.
        {
            $type = $row['type'];
            var_dump(gettype($actual) === $type);
            var_dump(count($actual) === $row['count']);
        } 
    }
    catch (Exception $e)  //$e indica dove finisce errore
    { 
        var_dump ($e->getMessage() === $row['error']);
        var_dump($e->getCode() === $row['errorCode']);
        echo $e->getLine();
    } 


}

?>