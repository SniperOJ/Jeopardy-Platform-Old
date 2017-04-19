<?php
class Challenges_api extends CI_Controller {

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

    public function get_all_challenges($value='')
    {
        # code...
    }
}

