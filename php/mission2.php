<?php
$read_file = explode("\n", file_get_contents("./hoseo_group_tree_list.txt"));

foreach($read_file as $line){
	echo $line;
}

class node {

}