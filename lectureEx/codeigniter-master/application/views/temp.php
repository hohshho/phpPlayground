<?php
function register(){
    $this->_head();

    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', '이메일 주소', 'required|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('nickname', '닉네임', 'required|min_length[5]|max_length[20]');
    $this->form_validation->set_rules('password', '비밀번호', 'required|min_length[6]|max_length[30]|matches[re_password]');
    $this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');

    if($this->form_validation->run() === false){
        $this->load->view('register');
    } else {
        if(!function_exists('password_hash')){
            $this->load->helper('password');
        }
        $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

        $this->load->model('user_model');
        $this->user_model->add(array(
            'email'=>$this->input->post('email'),
            'password'=>$hash,
            'nickname'=>$this->input->post('nickname')
        ));

        $this->session->set_flashdata('message', '회원가입에 성공했습니다.');
        $this->load->helper('url');
        redirect('/ci1');
    }


    $this->_footer();
}
?>
