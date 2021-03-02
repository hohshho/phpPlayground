<?php
class Board_model extends CI_Model {
 
    function __construct()
    {       
        parent::__construct();
    }
 
    function gets_user(){
        return $this->db->query("SELECT * FROM USER")->result();
    }

    function update_user(){
        // 1. 동일한 아이디가 있나 검색 and ID가 email 형식인지
        //  1.1) 있으면 false 반환
        // 2. 없으면 랜덤 key 값 생성
        //  2.1) 동일한 key값 있는지 확인 -> true : 2 / false : 3
        // 3. client측으로 부터 전송된 password 값을 통해 1. hash password 생성, 2. random salt 값 생성
        // 4. db에 저장
    }

    function login_user() {
        // 1. DB에 ID 값을 통한 조회
        //  1.1) ID 없으면 FALSE 반환
        // 2. password + db상 salt 값 -> hash password 맞는지 확인
        //  2.1) 다르면 FALSE 반환
        //  2.2) 같으면 TRUE 반환
    }
}