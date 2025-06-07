<?php

class Ucapan extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	public function get_all()
	{
		$projects = $this->db->get("ucapan")->result();
		return $projects;
	}

	function insert($data){
		$this->db->insert('ucapan', $data);
	}

}
