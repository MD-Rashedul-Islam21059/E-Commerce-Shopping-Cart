<?php

 include 'db.php';

try{

    $setupFile = file_get_contents('setup.txt');
    $contentArr = array();

    $count = strlen($setupFile);
    $text = '';

    for($i = 0; $i < $count; $i++){
        if($setupFile[$i] == ' '){
            array_push($contentArr, $text);
            $text = '';
            continue;
        }else{
            $text .= $setupFile[$i];
        }

    }

    $host = $contentArr[0];
    $user = $contentArr[1];
    $p = $contentArr[2];

    if($contentArr[2] == 'null'){
        $password = "";
    }else{
        $password = $contentArr[2];
    }

    echo $host." ".$user." ".$p;
    

    $connection = new PDO("mysql:host=$host", $user, $password);

    myDb::db($connection);
    myDb::table();

    header("location: index.php");
    

}catch(PDOEXCEPTION $e){
    echo $e->getMessage();
}

?>