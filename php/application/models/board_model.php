<?php
class Board_model extends CI_Model {
 
    function __construct()
    {       
        parent::__construct();
    }
 
    function gets_user(){
        return $this->db->query("SELECT * FROM USER")->result();
    }

    function getUserId($id){
        return $this->db->query("SELECT * FROM USER WHERE id = '".$id."'")->row();
    }

    function getUserKey($key){
        return $this->db->query("SELECT * FROM USER WHERE userkey = ".$key)->result();
    }

    function insert_user($data){
        $str = $this->db->insert_string('user', $data);
        return $this->db->query($str);
    }
    
    function insert_article($data){
        $str = $this->db->insert_string('article', $data);
        return $this->db->query($str);
    }

    function getArticleKey($key){
        return $this->db->query("SELECT * FROM ARTICLE WHERE articlekey = ".$key)->result();
    }

    function getBoardList10Items(){
        return $this->db->query("");
    }
}