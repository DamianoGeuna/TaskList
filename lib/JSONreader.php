<?php

//si dovrebbe fare un documento con diverse regole, chi l'ha scritto, etc...
//@var    string $filepath --> percorso del file da leggere. @var: indica documentazione.
//@ return array $res array associativo
/** */ //commento con due asterischi= documentazione di php, funzione di php.
//apre un file formato JSON e lo converte in array associativo.

// NOTA: test si lancia da cartella lib


function JSONreader(string $filepath) //punto interrogativo indica nullo o array
//visto che php non è tipizzato, meglio dichiarare il tipo, così in caso di problemi si attiva
{   
    if(file_exists($filepath))
    {
        $fileString = file_get_contents($filepath);
        $res = json_decode($fileString, true);
    }
    else
    {
        throw new Exception('not-exists',404); //exception, è un oggetto. nella parentesi si mette messaggio più codice errore.
    }

    return $res;
}
//metalinguaggi per php, 

?>