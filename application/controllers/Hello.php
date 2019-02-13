<?php

Class Hello extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model("friend_model");
    }

    public function index()
    {
        $data = array(
            "all_friends" => $this->friend_model->get_friends()
        );
        $this->load->view("hello_world", $data);
    }

    public function welcome($friend_id)
    {
        $my_friend = $this->friend_model->get_single_friend($friend_id);

        if($my_friend->num_rows() > 0)
        {
            $row = $my_friend->row();
            $friend = $row->friend_name;
            $age = $row->friend_age;
            $gender = $row->friend_gender;
            $hobby = $row->friend_hobby;

            $data = array(
                "friend_name" => $friend,
                "friend_age" => $age,
                "friend_gender" => $gender,
                "friend_hobby" => $hobby
            );
            $this->load->view("welcome_here", $data);
        }

        else
        {
            $this->session->set_flashdata("error_message", "Could not find your friend");

            redirect("hello");
        }
    }

    public function new_friend()
    {
        //Form validation
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("age", "Age", "required|numeric");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("hobby", "Hobby", "required");
        
        if($this->form_validation->run())
        {
            $friend_id = $this->friend_model->add_friend();
            if($friend_id > 0)
            {
                $this->session->set_flashdata("success_message", "New friend ID ".$friend_id." has been added");

                redirect("hello");
            }

            else
            {
                $this->session->set_flashdata("error_message", "Unable to add friend");
            }
        }

        $data["form_error"] = validation_errors();
        $this->load->view("add_friend", $data);
    }
}
?>