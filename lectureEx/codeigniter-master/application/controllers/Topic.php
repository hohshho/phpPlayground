<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Topic extends MY_Controller{

  function __construct(){
    parent::__construct();

//    $this->load->database();
    $this->load->model('Topic_model');
    log_message('debug', 'topic 초기화');
  }

  function index(){
    $this->_head();
    $this->_sidebar();
    $this->load->view('main');
    $this->_footer();
  }


  function get($id){
    log_message('debug', 'get 호출');
    $this->_head();
    $this->_sidebar();

    $topic = $this->Topic_model->get($id);

    if(empty($topic)){
      log_message('error', 'topic의 값이 없습니다');
      show_error('topic의 값이 없습니다');
    }

    $this->load->helper(array('url','html','korean'));
    log_message('debug', 'get view 로딩');
    $this->load->view('get',array('topic'=>$topic));
    log_message('debug', 'footer view 로딩');

    $this->_footer();
  }


  function add(){

      // 로그인 필요
      if(!$this->session->userdata('is_login')){
        redirect('/auth/login?returnURL='.$this->_getReturnUrl());
      }

      $this->_head();
      $this->_sidebar();

      $this->load->library('form_validation');
      $this->form_validation->set_rules('title', '제목', 'required');
      $this->form_validation->set_rules('description', '본문', 'required');

      if ($this->form_validation->run() == FALSE){
           $this->load->view('add');
      }else{
          $topic_id = $this->Topic_model->add($this->input->post('title'), $this->input->post('description'));

/*
// old source

          $this->load->model('User_model');
          $users = $this->User_model->gets();
          $this->load->library('email');
          $this->email->initialize(array('mailtype'=>'html'));

          foreach($users as $user){

            $mail_content = '<a href="'.site_url().'index.php/topic/get/'.$topic_id.'">'.$this->input->post('title').'</a>';

            $this->email->from('gon@gon.com','gon');
            $this->email->subject('sended email');
            $this->email->message($mail_content);
            $this->email->to($user->email);
            $this->email->send();
          }
*/


// to change to use batch
          $this->load->model('Batch_model');
          $this->Batch_model->add(array('job_name'=>'notify_email_add_topic','context'=>json_encode(array('topic_id'=>$topic_id))));

          $this->cache->delete('topics');

          redirect('/topic/get/'.$topic_id,'location');
      }

      $this->_footer();
  }

  function upload_receive(){
    // 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
    $config['upload_path'] = './static/user';
    // git,jpg,png 파일만 업로드를 허용한다.
    $config['allowed_types'] = 'gif|jpg|png';
    // 허용되는 파일의 최대 사이즈
    $config['max_size'] = '100';
    // 이미지인 경우 허용되는 최대 폭
    $config['max_width']  = '1024';
    // 이미지인 경우 허용되는 최대 높이
    $config['max_height']  = '768';
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload("user_upload_file")){
			echo $this->upload->display_errors();
		}else{
			$data = array('upload_data' => $this->upload->data());
      echo "성공";
//			$this->load->view('upload_success', $data);
		  var_dump($data);
		}
	}


  function upload_receive_from_ck(){
    // 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
    $config['upload_path'] = './static/user';
    // git,jpg,png 파일만 업로드를 허용한다.
    $config['allowed_types'] = 'gif|jpg|png';
    // 허용되는 파일의 최대 사이즈
    $config['max_size'] = '100';
    // 이미지인 경우 허용되는 최대 폭
    $config['max_width']  = '1024';
    // 이미지인 경우 허용되는 최대 높이
    $config['max_height']  = '768';
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload("upload")){
			echo $this->upload->display_errors();
//echo ' {"error":{"number":116,"message":"Folder not found. Please refresh and try again."}}';
		}else{
			$data = array('upload_data' => $this->upload->data());

        echo '
          {
               "fileName": "'.$data['upload_data']["file_name"].'",
               "uploaded": 1,
               "url": "\/ci1\/static\/user\/'.$data['upload_data']["file_name"].'"
           }

         ';
/*
// samples data form
      {"fileName":"bird(1).jpg","uploaded":1,"url":"\/userfiles\/images\/bird(1).jpg"}

      echo "성공";
			$this->load->view('upload_success', $data);

*/

		}
	}


  function upload_form(){
    $this->_head();
    $this->_sidebar();
    $this->load->view('upload_form');
    $this->_footer();
  }


  function delete(){
    $topic_id = $this->input->post('topic_id');
    $this->_require_login();
    $this->load->model('Topic_model');
    $this->Topic_model->delete($topic_id);
    $this->cache->delete('topics');
    redirect('/topic');
  }

}
?>
