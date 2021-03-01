<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Mailtest extends MY_Controller{

  function __construct(){
    parent::__construct();
  }

  function index(){

    $this->load->library('email');


    $config['protocol'] = 'sendmail';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;

    $this->email->initialize($config);


    $this->email->from('gon@gon.com', 'gogogo2');
    $this->email->to('deutschgon@gmail.com');
    $this->email->subject('Email');
    $this->email->message('good good the email class.');

//    $this->email->send();

    echo $this->email->print_debugger();

  }

}
?>
