<?php

class M_Auth extends CI_Model
{

	public function cek($data)
	{
		$this->db->where('username', $data['username']);
		$this->db->where('password', $data['password']);
		$this->db->where('status', $data['status']);
		return $this->db->get('user');
	}
}
