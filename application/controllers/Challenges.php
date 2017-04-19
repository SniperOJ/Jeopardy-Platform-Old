<?php
class Challenges extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('challenges_model');
        $this->load->helper('url_helper');
        $this->load->model('user_model');
        $this->config->load('navigation_bar');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function is_overdue($token_alive_time)
    {
        $now_time = time();
        return ($now_time > $token_alive_time);
    }

    // is logined
    public function is_logined()
    {
        // is set in session
        if ($this->session->userID == NULL){
            return false;
        }else{
            // is overdue
            $userID = $this->session->userID;
            $token_alive_time = $this->user_model->get_token_alive_time($userID);
            if ($this->is_overdue($token_alive_time)){
                return false;
            }else{
                return true;
            }
        }
    }

    public function view()
    {
        // $active_code = $this->uri->segment(3);
        // die($active_code);
        if($this->is_logined()){
            $data['challenges'] = $this->challenges_model->get_all_challenges($this->session->userID);
            $data['web_challenges_number'] = $this->challenges_model->get_challenges_number('web');
            $data['pwn_challenges_number'] = $this->challenges_model->get_challenges_number('pwn');
            $data['misc_challenges_number'] = $this->challenges_model->get_challenges_number('misc');
            $data['forensics_challenges_number'] = $this->challenges_model->get_challenges_number('forensics');
            $data['crypto_challenges_number'] = $this->challenges_model->get_challenges_number('crypto');
            $data['stego_challenges_number'] = $this->challenges_model->get_challenges_number('stego');
            $data['other_challenges_number'] = $this->challenges_model->get_challenges_number('other');
            $this->load->view('templates/header');
            $this->load->view('navigation_bar/navigation_bar_user');
            $this->load->view('challenges/view', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }

    public function view_web()
    {
        if($this->is_logined()){
            $data['challenges'] = $this->challenges_model->get_type_challenges($this->session->userID, "web");
            $data['web_challenges_number'] = $this->challenges_model->get_challenges_number('web');
            $data['pwn_challenges_number'] = $this->challenges_model->get_challenges_number('pwn');
            $data['misc_challenges_number'] = $this->challenges_model->get_challenges_number('misc');
            $data['forensics_challenges_number'] = $this->challenges_model->get_challenges_number('forensics');
            $data['crypto_challenges_number'] = $this->challenges_model->get_challenges_number('crypto');
            $data['stego_challenges_number'] = $this->challenges_model->get_challenges_number('stego');
            $data['other_challenges_number'] = $this->challenges_model->get_challenges_number('other');
            $this->load->view('templates/header');
            $this->load->view('navigation_bar/navigation_bar_user');
            $this->load->view('challenges/view', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }


    public function view_pwn()
    {
        if($this->is_logined()){
            $data['challenges'] = $this->challenges_model->get_type_challenges($this->session->userID, "pwn");
            $data['web_challenges_number'] = $this->challenges_model->get_challenges_number('web');
            $data['pwn_challenges_number'] = $this->challenges_model->get_challenges_number('pwn');
            $data['misc_challenges_number'] = $this->challenges_model->get_challenges_number('misc');
            $data['forensics_challenges_number'] = $this->challenges_model->get_challenges_number('forensics');
            $data['crypto_challenges_number'] = $this->challenges_model->get_challenges_number('crypto');
            $data['stego_challenges_number'] = $this->challenges_model->get_challenges_number('stego');
            $data['other_challenges_number'] = $this->challenges_model->get_challenges_number('other');
            $this->load->view('templates/header');
            $this->load->view('navigation_bar/navigation_bar_user');
            $this->load->view('challenges/view', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }



    public function view_misc()
    {
        if($this->is_logined()){
            $data['challenges'] = $this->challenges_model->get_type_challenges($this->session->userID, "misc");
            $data['web_challenges_number'] = $this->challenges_model->get_challenges_number('web');
            $data['pwn_challenges_number'] = $this->challenges_model->get_challenges_number('pwn');
            $data['misc_challenges_number'] = $this->challenges_model->get_challenges_number('misc');
            $data['forensics_challenges_number'] = $this->challenges_model->get_challenges_number('forensics');
            $data['crypto_challenges_number'] = $this->challenges_model->get_challenges_number('crypto');
            $data['stego_challenges_number'] = $this->challenges_model->get_challenges_number('stego');
            $data['other_challenges_number'] = $this->challenges_model->get_challenges_number('other');
            $this->load->view('templates/header');
            $this->load->view('navigation_bar/navigation_bar_user');
            $this->load->view('challenges/view', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }



    public function view_forensics()
    {
        if($this->is_logined()){
            $data['challenges'] = $this->challenges_model->get_type_challenges($this->session->userID, "forensics");
            $data['web_challenges_number'] = $this->challenges_model->get_challenges_number('web');
            $data['pwn_challenges_number'] = $this->challenges_model->get_challenges_number('pwn');
            $data['misc_challenges_number'] = $this->challenges_model->get_challenges_number('misc');
            $data['forensics_challenges_number'] = $this->challenges_model->get_challenges_number('forensics');
            $data['crypto_challenges_number'] = $this->challenges_model->get_challenges_number('crypto');
            $data['stego_challenges_number'] = $this->challenges_model->get_challenges_number('stego');
            $data['other_challenges_number'] = $this->challenges_model->get_challenges_number('other');
            $this->load->view('templates/header');
            $this->load->view('navigation_bar/navigation_bar_user');
            $this->load->view('challenges/view', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }



    public function view_crypto()
    {
        if($this->is_logined()){
            $data['challenges'] = $this->challenges_model->get_type_challenges($this->session->userID, "crypto");
            $data['web_challenges_number'] = $this->challenges_model->get_challenges_number('web');
            $data['pwn_challenges_number'] = $this->challenges_model->get_challenges_number('pwn');
            $data['misc_challenges_number'] = $this->challenges_model->get_challenges_number('misc');
            $data['forensics_challenges_number'] = $this->challenges_model->get_challenges_number('forensics');
            $data['crypto_challenges_number'] = $this->challenges_model->get_challenges_number('crypto');
            $data['stego_challenges_number'] = $this->challenges_model->get_challenges_number('stego');
            $data['other_challenges_number'] = $this->challenges_model->get_challenges_number('other');
            $this->load->view('templates/header');
            $this->load->view('navigation_bar/navigation_bar_user');
            $this->load->view('challenges/view', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }


    public function view_stego()
    {
        if($this->is_logined()){
            $data['challenges'] = $this->challenges_model->get_type_challenges($this->session->userID, "stego");
            $data['web_challenges_number'] = $this->challenges_model->get_challenges_number('web');
            $data['pwn_challenges_number'] = $this->challenges_model->get_challenges_number('pwn');
            $data['misc_challenges_number'] = $this->challenges_model->get_challenges_number('misc');
            $data['forensics_challenges_number'] = $this->challenges_model->get_challenges_number('forensics');
            $data['crypto_challenges_number'] = $this->challenges_model->get_challenges_number('crypto');
            $data['stego_challenges_number'] = $this->challenges_model->get_challenges_number('stego');
            $data['other_challenges_number'] = $this->challenges_model->get_challenges_number('other');
            $this->load->view('templates/header');
            $this->load->view('navigation_bar/navigation_bar_user');
            $this->load->view('challenges/view', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }

    public function view_other()
    {
        if($this->is_logined()){
            $data['challenges'] = $this->challenges_model->get_type_challenges($this->session->userID, 'other');
            $data['web_challenges_number'] = $this->challenges_model->get_challenges_number('web');
            $data['pwn_challenges_number'] = $this->challenges_model->get_challenges_number('pwn');
            $data['misc_challenges_number'] = $this->challenges_model->get_challenges_number('misc');
            $data['forensics_challenges_number'] = $this->challenges_model->get_challenges_number('forensics');
            $data['crypto_challenges_number'] = $this->challenges_model->get_challenges_number('crypto');
            $data['stego_challenges_number'] = $this->challenges_model->get_challenges_number('stego');
            $data['other_challenges_number'] = $this->challenges_model->get_challenges_number('other');
            $this->load->view('templates/header');
            $this->load->view('navigation_bar/navigation_bar_user');
            $this->load->view('challenges/view', $data);
            $this->load->view('templates/footer');
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }


    public function get_encrypted_flag($flag)
    {
        return md5($flag);
    }


    public function is_current($user_flag, $current_flag)
    {
        return ($this->get_encrypted_flag($user_flag) === $current_flag);
    }


    public function is_solved($userID, $challengeID)
    {
        $data = array(
            'userID' => $userID, 
            'challengeID' => $challengeID,
            'is_current' => '1',
        );
        $query = $this->db->get_where('submit_log', $data);
        $result = $query->row_array();
        if (count($result) === 0){
            return false;
        }else{
            return true;
        }
    }

    public function submit()
    {
        if($this->is_logined()){
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['challenges'] = $this->challenges_model->get_all_challenges($this->session->userID);

            $this->form_validation->set_rules('challengeID', 'challengeID', 'required');
            $this->form_validation->set_rules('flag', 'Flag', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header');
                $this->load->view('navigation_bar/navigation_bar_user');
                $this->load->view('notice/view', array('type' => 'error', 'message' => 'Please input flag!'));
                $this->load->view('challenges/view', $data);
                $this->load->view('templates/footer');
            }
            else
            {
                $userID = $this->session->userID;
                $challengeID = $this->input->post('challengeID');
                $user_flag = $this->input->post('flag');
                $last_submit_time = $this->user_model->get_last_submit_time($userID);
                $time = time();
                $intervals = 10;
                // 每 $intervals 秒只允许提交一次
                if(($time - $last_submit_time) > $intervals){
                    if ($this->is_solved($userID, $challengeID)){
                        $this->load->view('templates/header');
                        $this->load->view('navigation_bar/navigation_bar_user');
                        $this->load->view('notice/view', array('type' => 'warning', 'message' => 'You have solved this challenge!'));
                        $this->load->view('challenges/view', $data);
                        $this->load->view('templates/footer');
                    }else{
                        $challenge_score = $this->challenges_model->get_score($challengeID);
                        $current_flag = $this->challenges_model->get_flag($challengeID);
                        $is_current = 0;

                        if($this->is_current($user_flag, $current_flag)){
                            // set current flag bit
                            $is_current = 1;
                            // update user score
                            $user_score = $this->user_model->get_score($userID);
                            $this->user_model->set_score($userID, $user_score + $challenge_score);
                        }else{
                            $is_current = 0;
                        }

                        // insert into submit_log
                        // TODO : use model to do it
                        $submit_data = array(
                            'challengeID' => $challengeID,
                            'userID' => $userID,
                            'flag' => $user_flag,
                            'submit_time' => time(),
                            'is_current' => $is_current,
                        );
                        $this->db->insert('submit_log', $submit_data);

                        // flush data
                        $data['challenges'] = $this->challenges_model->get_all_challenges($this->session->userID);

                        // load seccess view
                        if ($is_current === 1){
                            $this->load->view('templates/header');
                            $this->load->view('navigation_bar/navigation_bar_user');
                            $this->load->view('notice/view', array('type' => 'success', 'message' => 'Congratulations'));
                            $this->load->view('challenges/view', $data);
                            $this->load->view('templates/footer');
                        }else{
                            $this->load->view('templates/header');
                            $this->load->view('navigation_bar/navigation_bar_user');
                            $this->load->view('notice/view', array('type' => 'error', 'message' => 'Wrong answer!'));
                            $this->load->view('challenges/view', $data);
                            $this->load->view('templates/footer');
                        }
                    }
                }else{
                    $this->load->view('templates/header');
                    $this->load->view('navigation_bar/navigation_bar_user');
                    $this->load->view('notice/view', array('type' => 'error', 'message' => 'You can only submit once every '.$intervals.' seconds!'));
                    $this->load->view('challenges/view', $data);
                    $this->load->view('templates/footer');
                }
            }
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }

    public function is_admin($userID)
    {
        $usertype = $this->user_model->get_usertype($userID);
        if ($usertype === 1){
            return true;
        }else{
            return false;
        }
    }


    public function do_create($new_challenge)
    {
        if($this->db->insert('challenges', $new_challenge)){
            return true;
        }else{
            return false;
        }
    }


    public function create()
    {
        $userID = $this->session->userID;
        if($this->is_logined()){
            if ($this->is_admin($userID)){

                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                $this->form_validation->set_rules('flag', 'Flag', 'required');
                $this->form_validation->set_rules('score', 'Score', 'required');
                $this->form_validation->set_rules('type', 'Type', 'required');
                // $this->form_validation->set_rules('resource', 'Resource', 'required');
                // $this->form_validation->set_rules('document', 'Document', 'required');

                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header');
$this->load->view('navigation_bar/navigation_bar_user');
                        $this->load->view('notice/view', array('type' => 'error', 'message' => 'Please check your input! You have forgot something!'));
                        $this->load->view('challenges/create');
                        $this->load->view('templates/footer');
                }
                else
                {
                    $type = $this->input->post('type');
                    $new_challenge = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                        'score' => $this->input->post('score'),
                        'type' => $type,
                        'flag' => $this->get_encrypted_flag($this->input->post('flag')),
                        'resource' => $this->input->post('resource'),
                        'document' => $this->input->post('document'),
                        'online_time' => time(),
                        'fixing' => 0,
                        'visit_times' => 0,
                    );

                    if ($this->do_create($new_challenge)) {
                        $data['challenges'] = $this->challenges_model->get_all_challenges($this->session->userID);
                        $this->load->view('templates/header');
$this->load->view('navigation_bar/navigation_bar_user');
                        $this->load->view('notice/view', array('type' => 'success', 'message' => 'Create challenge success!'));
                        $this->load->view('challenges/view', $data);
                        $this->load->view('templates/footer');
                    }else{
                        $data['challenges'] = $this->challenges_model->get_all_challenges($this->session->userID);
                        $this->load->view('templates/header');
$this->load->view('navigation_bar/navigation_bar_user');
                        $this->load->view('notice/view', array('type' => 'error', 'message' => 'Create challenge error! Please contact admin@sniperoj.cn'));
                        $this->load->view('challenges/create', $data);
                        $this->load->view('templates/footer');
                    }
                }
            }else{
                // spiteful visitor , clear it's session
                $this->session->sess_destroy();
                redirect("/");
            }
        }else{
            $this->session->sess_destroy();
            redirect("/");
        }
    }
}
