<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{

		$this->load->view('auth/login');
	}

	public function login()
	{
		$data['username'] = $this->input->post('username', TRUE);
		$data['password'] = encrypt_pass($this->input->post('password', TRUE));
		$data['status'] = 'Y';
		$hasil = $this->M_auth->cek($data);
		if (count($hasil->result()) == 1) {
			foreach ($hasil->result() as $h) {
				$h_data['email'] = $h->email;
				$h_data['username'] = $h->username;
				$h_data['nama_lengkap'] = $h->nama_lengkap;
				$h_data['id'] = $h->id;
				$h_data['status'] = $h->status;
				$h_data['level'] = $h->level;

				$this->session->set_userdata($h_data);
			}
			$this->session->set_flashdata('alert', 'Success_login');
			redirect('home');
		} else {
			$this->session->set_flashdata('alert', 'Unsuccess_login');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->userdata('username');
		$this->session->userdata('status');
		session_destroy();
		redirect();
	}

	public function chpassword()
	{
		$id = $_SESSION['id'];
		$data['password'] = encrypt_pass($this->input->post('pass_baru'));

		$kolom = 'id';
		$tabel = 'user';

		$result = $this->data->update($id, $kolom, $tabel, $data);
		if ($result) {
			$this->session->set_flashdata('alert', 'Ganti Password');
			redirect('auth/logout');
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('user');
		}
	}
}
