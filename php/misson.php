<?php
    $readFile = file_get_contents("./hoseo_group_list.txt");
    $readFile = explode ("|", $readFile);
    foreach($readFile as $line){
        echo $line;
    }
?>