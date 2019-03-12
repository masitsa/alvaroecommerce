<?php
Class Friends_model extends CI_Model
{
    public function add_friend($file_name, $thumb_name)
    {
        $data = array(
            "friend_name" => $this->input->post("first_name"),
            "friend_age" => $this->input->post("age"),
            "friend_gender" => $this->input->post("gender"),
            "friend_hobby" => $this->input->post("hobby"),
            "friend_image" => $file_name,
            "friend_thumb" => $thumb_name
        );

        if($this->db->insert("friend", $data))
        {
            return $this->db->insert_id();
        }

        else
        {
            return FALSE;
        }
    }

    public function get_all_friends($table, $where, $per_page, $page, $order = 'category_name', $order_method = 'ASC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}

    public function get_single_friend($friend_id)
    {
        $this->db->where("friend_id", $friend_id);
        return $this->db->get("friend");
    }
}
?>