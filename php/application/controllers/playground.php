<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Playground extends CI_Controller {
        function __construct()
        {       
            parent::__construct();
        }
        function index(){        
            $title = 'subject';
            $$title = 'PHP tutorial';
            echo $subject;
            $this->load->view("ground");
        }
        function idpw($id , $pw){
            $idPattern = '/^[a-z0-9]{3,20}$/';
            $pwPattern = '/^[a-z0-9A-Z!@#$]{8,20}$/';

            return preg_match_all($idPattern, $id, $matches1) && preg_match_all($pwPattern, $pw, $matches2);
        }

        function go(){
            print_r($_POST);
            echo "<br />";
            $obj = new Playground();
            $form1Check = $obj->idpw($_POST['id1'], $_POST['password1']);
            $form2Check = $obj->idpw($_POST['id2'], $_POST['password2']);

            if($form1Check){
                echo "ID : ".$_POST['id1']." PASSWORD : ".$_POST['password1'];
            }else{
                echo "틀린 패턴입니다. 다시 입력하세요<br />";
            }
            
            if($form2Check){
                echo "ID : ".$_POST['id2']." PASSWORD : ".$_POST['password2'];
            }else{
                echo "틀린 패턴입니다. 다시 입력하세요";
            }
        }
    }