<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batch extends MY_Controller {

    function __construct(){
        parent::__construct();
    }

    function process(){

        $this->load->model('Batch_model');
        $queue = $this->Batch_model->gets();

        foreach($queue as $job){

          switch($job->job_name){

            case 'notify_email_add_topic':
              $context = json_decode($job->context);
              $this->load->model('Topic_model');
              $topic=$this->Topic_model->get($context->topic_id);

              $this->load->model('User_model');
              $users = $this->User_model->gets();
              $this->load->library('email');
              $this->email->initialize(array('mailtype'=>'html'));

              foreach($users as $user){
                $this->email->from('gon@gon.com','Gon');
                $this->email->to($user->email);
                $this->email->subject($topic->title);
                $this->email->message($topic->description);
                $this->email->send();
                echo "Succeeded to send mail to {$user->email}";
              }

              $this->Batch_model->delete(array('id'=>$job->id));
              break;
          }

        }

/*
// old version
        $this->load->model('user_model');
        $users = $this->user_model->gets();
        $this->load->library('email');
        $this->email->initialize(array('mailtype'=>'html'));
        foreach($users as $user){
            $this->email->from('gon@gon.com', 'Gon');
            $this->email->to($user->email);
            $this->email->subject('test');
            $this->email->message('test');
            $this->email->send();
            echo "{$user->email}로 메일 전송을 성공 했습니다.\n";
        }
*/
    }
}

?>
