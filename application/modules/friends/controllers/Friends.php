<?php

class Friends extends MX_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model("site/site_model");
        $this->load->model("friends_model");
    }

    public function index()
    {
        $v_data["all_friends"] = $this->friends_model->get_friends();

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("friends/all_friends", $v_data, TRUE)
        );
        $this->load->view("site/layouts/layout", $data);
    }
}

?>