<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Auth extends MY_Controller{

  function __construct(){
    parent::__construct();
  }


  function login(){

    $returnURL = $this->input->GET("returnURL");
    if(!$returnURL){
      $returnURL = $_SERVER["HTTP_REFERER"];
    }

    $this->_head();
    $this->load->view('login',array("returnURL"=>$returnURL));
    $this->_footer();
  }


  function authentication(){

    $returnURL = $this->input->POST('returnURL');
    $email = $this->input->POST('email');
    $password = $this->input->POST('password');

    if(!$returnURL){
      $returnURL = "/ci1/topic";
    }

//    $authentication = $this->config->item("authentication");
    $this->load->model('User_model');
    $usr = $this->User_model->getByEmail(array(
              'email'=>$email
            ));

    if(!function_exists('password_hash')){
        $this->load->helper('password');
    }

    if(
      $email == $usr->email &&
      password_verify($password, $usr->password)
    ){

      $this->session->set_userdata('is_login',true);
      redirect($returnURL);
    }else{
      $this->session->set_flashdata('message','fail to sign in');
      redirect('/ci1/auth/login?returnURL='.$returnURL);
    }
  }


  function logout(){
//    $this->session->set_userdata('is_login',false);
    $this->session->sess_destroy();
//    session_destroy();
    $this->session->set_flashdata('message','complete sign out');
    $this->load->helper('url');
    redirect('/ci1/topic');
  }


  function register(){

    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('nickname', 'nickname', 'required|min_length[5]|max_length[20]');
    $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[30]|matches[re_password]');
    $this->form_validation->set_rules('re_password', 'check password', 'required');

    if ($this->form_validation->run() == FALSE){
      $this->_head();
      $this->load->view('register');
      $this->_footer();
    }else{

      if(!function_exists('password_hash')){
          $this->load->helper('password');
      }
      $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

      $this->load->model('User_model');

      $this->User_model->add(array(
        'email'=>$this->input->post('email'),
        'password'=>$hash,
        'nickname'=>$this->input->post('nickname')
      ));

      $this->session->set_flashdata('message','success to sign up');
      $this->load->helper('url');
      redirect('/ci1/topic');
    }



  }

}
