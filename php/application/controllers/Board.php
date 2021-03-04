<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Board extends CI_Controller {
        function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->model('board_model');
            log_message('debug', 'board 초기화');
        }
        function index(){
            $allUser = $this->board_model->gets_user();
                
            $this->output->set_content_type('text/html;charset=utf-8');
            $this->output->set_output(json_encode($allUser, JSON_UNESCAPED_UNICODE));
        }
        // 1. 동일한 아이디가 있나 검색 and ID가 email 형식인지
        //  1.1) 있으면 false 반환
        // 2. 없으면 랜덤 key 값 생성
        //  2.1) 동일한 key값 있는지 확인 있으면 2번 다시
        // 3. client측으로 부터 전송된 password 값을 통해 1. hash password 생성, 2. random salt 값 생성
        // 4. db에 저장
        // 5. 결과값 반환
        function sign_up_user() {
            $data = json_decode(file_get_contents("php://input"), true);
            if(!$data){
                echo "하....post 값이 없다.";
            }
            echo implode( '/', $data );
            $id = $data['id'];
            $name = $data['name'];
            $password = $data['password'];
            $birth = $data['birth'];
            $address = $data['address'];

            // 1.
            $possibleIdIndex = $this->isPossibleUserId($id);
            // 2.
            if($possibleIdIndex){
                $userKey = $this->makeUserKey();
            }
            // 3.
            $salt = password_hash($this->makeRandByte(), PASSWORD_BCRYPT);
            $passwordHash = password_hash($password.$salt, PASSWORD_BCRYPT);
            // 4.
            
            $insertIndex = $salt && $passwordHash && $possibleIdIndex && $userKey ? true : false;
            if($insertIndex){
                $insertArray = Array(
                    'userkey' => $userKey,
                    'id' => $id,
                    'name' => $name,
                    'password' => $passwordHash,
                    'birth' => $birth,
                    'address' => $address,
                    'salt' => $salt
                );
                $insertResult = $this->board_model->insert_user($insertArray);
                if($insertResult){
                    $signUpResult = "true";
                }else{
                    $signUpResult = "false";
                }
            }else{
                $signUpResult = "false";
            }

            $this->output->set_content_type('text/html;charset=utf-8');
            $this->output->set_output($signUpResult);
        }

        // 1. DB에 ID 값을 통한 조회
        //  1.1) ID 없으면 FALSE 반환
        // 2. password + db상 salt 값 -> hash password 맞는지 확인
        //  2.1) 다르면 FALSE 반환
        //  2.2) 같으면 TRUE 반환
        // 3. session / cookie 처리
        function login_user(){
            $data = json_decode(file_get_contents("php://input"), true);
            $id = $data['id'];
            $password = $data['password'];
            // 1.
            $queryResult = $this->checkUserId($id);
            if(!$queryResult){
                $this->output->set_content_type('text/html;charset=utf-8');
                $this->output->set_output("false");
                return;
            }
            //2.
            $salt = $queryResult -> salt;
            $uPassword = $queryResult -> password;
            $passVerifyIndex = password_verify($password.$salt, $uPassword);
            $session_data = array(  
                'id'=>$id
            );  
            if($passVerifyIndex){
                $this->session->set_userdata($session_data);
                echo $this->session->userdata['userid'];
            }else{
                echo " 실패지롱";
            }
        }

        function isPossibleUserId($id){
            $idPattern = '/^[a-z0-9]{3,20}@[a-z0-9]{3,20}.[a-z0-9]{2,10}$/';
            if(!preg_match_all($idPattern, $id, $matches1)){
                return false;
            }
            $queryResult = $this->board_model->getUserId($id);
            if(!$queryResult){
                return true;
            }
            return false;
        }

        function checkUserId($id){
            $queryResult = $this->board_model->getUserId($id);
            if(!$queryResult){
                return false;
            }
            return $queryResult;
        }

        function makeUserKey(){
            $key = $this->makeRand();
            if($this->board_model->getUserKey($key)) {
                $key = makeUserKey();
            }
            return $key;
        }

        function makeRand(){
            return random_int(1,2100000000);
        }
        function makeRandByte(){
            return openssl_random_pseudo_bytes(4);
        }
    }