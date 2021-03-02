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
        function sign_up_user() {
            $grades = array('egoing'=>10, 'k8805'=>6, 'sorialgi'=>80);
            $this->output->set_output(json_encode($grades, JSON_UNESCAPED_UNICODE));
        }
    }