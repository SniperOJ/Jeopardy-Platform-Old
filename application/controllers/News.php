<?php
class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->model('user_model');
        $this->config->load('navigation_bar');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('url_helper');
    }


    public function is_overdue($token_alive_time)
    {
        $now_time = time();

        if ($now_time > $token_alive_time) {
            return false;
        }else{
            return true;
        }
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
                return true;
            }else{
                return false;
            }
        }
    }

    public function view()
    {
        if($this->is_logined()){
            $data['news'] = $this->news_model->get_all_news();
            $this->load->view('templates/header', array('navigation_bar' => $this->config->item('navigation_bar_user')));
            $this->load->view('news/view', $data);
            $this->load->view('templates/footer');
        }else{
            $data['news'] = $this->news_model->get_all_news();
            $this->load->view('templates/header', array('navigation_bar' => $this->config->item('navigation_bar_visitor')));
            $this->load->view('news/view', $data);
            $this->load->view('templates/footer');
        }
    }

    // /**
    //  *
    //  */
    // public function index()
    // {
    //     $data['news'] = $this->news_model->get_news();
    //     $data['title'] = 'News archive';

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('news/index', $data);
    //     $this->load->view('templates/footer');
    // }

    // /**
    //  * 显示 News
    //  */
    // public function view($newsID = NULL)
    // {
    //     $data['news_item'] = $this->news_model->get_news($newsID);

    //     if (empty($data['news_item']))
    //     {
    //         show_404();
    //     }

    //     $data['title'] = $data['news_item']['title'];

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('news/view', $data);
    //     $this->load->view('templates/footer');
    // }
    
    // /**
    //  * 创建 News
    //  */
    // public function create()
    // {
    //     $this->load->helper('form');
    //     $this->load->library('form_validation');

    //     $data['title'] = 'Create a news item';

    //     $this->form_validation->set_rules('title', 'Title', 'required');
    //     $this->form_validation->set_rules('content', 'Content', 'required');

    //     if ($this->form_validation->run() === FALSE)
    //     {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('news/create');
    //         $this->load->view('templates/footer');

    //     }
    //     else
    //     {
    //         $this->news_model->set_news();
    //         $this->load->view('news/success');
    //     }
    // }
}
