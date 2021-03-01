<?php
  if(!defined('BASEPATH')) exit('No direct script access allowed');

  class MY_Controller extends CI_Controller{
    function __construct(){
      parent::__construct();

      if($peak = $this->config->item('peak_page_cache')){
        if($peak==current_url()){
          $this->output->cache(5);
        }
      }

      $this->load->driver('cache',array('adapter'=>'file'));
    }

    function _footer(){
      $this->load->view('footer');
    }


    function _head(){
        $this->load->view('head',array(''));
    }

    function _sidebar(){
      if(!$topics = $this->cache->get('topics')){
        $topics = $this->Topic_model->gets();
        $this->cache->save('topics',$topics,60*5);
      }
      $this->load->view('topic_list', array('topics'=>$topics));
    }

// to make return url
    function _getReturnUrl($inputUrl = false){
      if($inputUrl){
        $result = rawurlencode($inputUrl);
      }else{
        $result = rawurlencode(uri_string());
      }
      return $result;
    }

    function _require_login(){
      if(!$this->session->userdata('is_login')){
        redirect('/auth/login');
      }
    }


  }
?>
