<?php

class Friends extends MX_Controller
{
    public $upload_path;
    public $upload_location;

    function __construct()
    {
        parent:: __construct();
        $this->load->model("site/site_model");
        $this->load->model("site/file_model");
        $this->load->model("friends_model");

        $this->upload_path = realpath(APPPATH . "../assets/uploads");
        $this->upload_location = base_url() . "assets/uploads/";

        $this->load->library("image_lib");
    }

    public function index($order = 'created', $order_method = 'ASC') 
    {
        $where = 'friend_id > 0';
        $table = 'friend';
        //pagination
        $segment = 4;
        $this->load->library('pagination');
        $config['base_url'] = site_url().'friends/'.$order.'/'.$order_method;
        $config['total_rows'] = $this->site_model->count_items($table, $where);
        $config['uri_segment'] = $segment;
        $config['per_page'] = 2;
        $config['num_links'] = 5;
        
        $config['full_tag_open'] = '<ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul>';
        
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</span>';
        
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active">';
        $config['cur_tag_close'] = '</li>';
        
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        
        //change of order method 
        if($order_method == 'DESC')
        {
            $order_method = 'ASC';
        }
        
        else
        {
            $order_method = 'DESC';
        }

        $v_data = array(
            'order' => $order,
            'order_method' => $order_method,
            'query' => $this->friends_model->get_all_friends($table, $where, $config["per_page"], $page, $order, $order_method),
            'page' => $page,
            'upload_location' => $this->upload_location,
            "links" => $this->pagination->create_links()
        );
        
        $data = array(
            'title' => $this->site_model->display_page_title(),
            'content' => $this->load->view('all_friends', $v_data, TRUE)
        );
            
        $this->load->view("site/layouts/layout", $data);
    }

    public function add_friend()
    {
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("age", "Age", "required|numeric");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("hobby", "Hobby", "required");

        if($this->form_validation->run())
        {
            $resize = array(
                "width" => 600,
                "height" => 600
            );
            $upload_response = $this->file_model->upload_image($this->upload_path, "friend_image", $resize);

            if($upload_response["check"] == FALSE)
            {
                $this->session->set_flashdata("error", $upload_response["message"]);
            }

            else
            {
                if($this->friends_model->add_friend($upload_response["file_name"], $upload_response["thumb_name"]))
                {
                    $this->session->set_flashdata("success", "Friend added successfully");
                    redirect("friends");
                }
    
                else
                {
                    $this->session->set_flashdata("error", "Unable to add friend. Please try");
                }
            }
        }

        else
        {
            $validation_errors = validation_errors();
            if(!empty($validation_errors))
            {
                $this->session->set_flashdata("error", $validation_errors);   
            }
        }

        $data = array(
            "title" => $this->site_model->display_page_title(),
            "content" => $this->load->view("add_friend", NULL, TRUE)
        );
        $this->load->view("site/layouts/layout", $data);
    }
}

?>