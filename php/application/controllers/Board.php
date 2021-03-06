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
        /*
        1. 동일한 아이디가 있나 검색 and ID가 email 형식인지
         1.1) 있으면 false 반환
        2. 없으면 랜덤 key 값 생성
         2.1) 동일한 key값 있는지 확인 있으면 2번 다시
        3. client측으로 부터 전송된 password 값을 통해 1. hash password 생성, 2. random salt 값 생성
        4. db에 저장
        5. 결과값 반환
        */
        function sign_up_user() {
            $data = json_decode(file_get_contents("php://input"), true);
            if(!$data){
                echo "하....post 값이 없다.";
            }
            // echo implode( '/', $data );
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

        /*        
        1. DB에 ID 값을 통한 조회
         1.1) ID 없으면 FALSE 반환
        2. password + db상 salt 값 -> hash password 맞는지 확인
         2.1) 다르면 FALSE 반환
         2.2) 같으면 TRUE 반환 // 여기까지 finish
        3. refreshToken 생성 -> accessToken 생성 -> refreshToken db에 저장 
        4. refresh token 해야함
        */
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
            if($passVerifyIndex){
                // access token 생성
                $Token = $this->hashing($id);
                $this->output->set_content_type('text/html;charset=utf-8');
                $this->output->set_output($Token);
            }else{
                echo " 실패지롱";
            }
        }

        function article_write(){
            $data = json_decode(file_get_contents("php://input"), true);
            $accessToken = $data['accessToken'];
            $title = $data['title'];
            $content = $data['content'];
            $time = date('Y-m-d H:i:s');
            $userid = $this->getUserId($accessToken);

            $articlekey = $this->makeArticleKey();

            // 검증 로직
            $isPossibleUser = $this->dehashing($accessToken);
            if(!$isPossibleUser){
                $this->output->set_content_type('text/html;charset=utf-8');
                $this->output->set_output("false");
                return;
            }
            // 저장로직
            $isSuccessSave = $this->board_model->insert_article(array(
                'articleKey' => $articlekey,
                'title' => $title,
                'contents' => $content,
                'time' => $time,
                'user_id' => $userid
            ));

            if($isSuccessSave){
                $this->output->set_content_type('text/html;charset=utf-8');
                $this->output->set_output("true");
            }else{
                $this->output->set_content_type('text/html;charset=utf-8');
                $this->output->set_output("false");
            }
            // 저장 결과 반환 true or false
        }

        function board_list(){
            // 1. db에서 값 꺼내오기
            $listIndex = (int) $_GET['listIndex'] -1; // 0번째 부터 시작해서
            $listData = $this->board_model->getBoardList10Items($listIndex*10);
            // 2. serverdata형식에 맞춰서 배열 안에 json형태로 만들기
            
            $this->output->set_content_type('application/json;charset=utf-8');
            $this->output->set_output(json_encode($listData, JSON_UNESCAPED_UNICODE));
            // 3. json type으로 return
        }

        // --------------------함수--------------------
        function makeArticleKey(){
            $key = $this->makeRand();
            if($this->board_model->getArticleKey($key)) {
                $key = makeUserKey();
            }
            return $key;
        }

        function validation(){
            $data = json_decode(file_get_contents("php://input"), true);
            $jwt = $data['jwt'];

            $result = $this->dehashing($jwt);
            $this->output->set_content_type('text/html;charset=utf-8');
            // TODO : accessToken에 시간 값 추가
            // TODO : refreshToken 만들고 db에 저장
            $this->output->set_output($result);
        }

        function hashing($id) {
            $header = json_encode(array(
                'alg'=>'sha256',
                'typ'=>'JWT'
            ));
            // TODO : time에 현재값 넣어놨는데 +30분 한 값 넣어야함
            $payload = json_encode(array(
                'id'=>$id,
                'time'=> date('Y-m-d H:i:s')
            ));
            $signature = hash("sha256", $header.$payload);
            return base64_encode($header).'.'.base64_encode($payload).'.'.base64_encode($signature);
        }

        // access token 검증
        function dehashing($token)
        {
            // 토큰 만들때의 구분자 . 으로 나누기
            $parted = explode('.', $token);
            $signature = base64_decode($parted[2]);
            // 위에서 토큰 만들때와 같은 방식으로 시그니처 만들고 비교
            if(hash("sha256", base64_decode($parted[0]).base64_decode($parted[1]))!= $signature){
                return;
            }
            return true;
        }

        function getUserId($accessToken){
            $parted = explode('.', $accessToken);
            $payload = base64_decode($parted[1]);
            $payload = substr($payload, 0, -31);
            return substr($payload, 7);
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