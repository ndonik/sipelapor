<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$data['header'] = 'master/table/header';
		$data['footer'] = 'master/table/footer';

		$select = array('id');
		$tabel = 'data_padi';
		$query = $this->db->where('status_verifikasi', 'Pending');
		$query = $this->db->order_by('nomor', 'ASC');
		$data['data_padi_tunggu'] = $this->data->get($select, $tabel, $query)->num_rows();

		$select = array('id');
		$tabel = 'data_padi';
		$query = $this->db->where('status_verifikasi', 'Cancel');
		$query = $this->db->order_by('nomor', 'ASC');
		$data['data_padi_tolak'] = $this->data->get($select, $tabel, $query)->num_rows();

		$select = array('id');
		$tabel = 'data_padi';
		$query = $this->db->where('status_verifikasi', 'Complete');
		$query = $this->db->order_by('nomor', 'ASC');
		$data['data_padi_selesai'] = $this->data->get($select, $tabel, $query)->num_rows();

		$select = array('id');
		$tabel = 'data_palawija';
		$query = $this->db->where('status_verifikasi', 'Pending');
		$query = $this->db->order_by('nomor', 'ASC');
		$data['data_palawija_tunggu'] = $this->data->get($select, $tabel, $query)->num_rows();

		$select = array('id');
		$tabel = 'data_palawija';
		$query = $this->db->where('status_verifikasi', 'Cancel');
		$query = $this->db->order_by('nomor', 'ASC');
		$data['data_palawija_tolak'] = $this->data->get($select, $tabel, $query)->num_rows();

		$select = array('id');
		$tabel = 'data_palawija';
		$query = $this->db->where('status_verifikasi', 'Complete');
		$query = $this->db->order_by('nomor', 'ASC');
		$data['data_palawija_selesai'] = $this->data->get($select, $tabel, $query)->num_rows();

		$this->template->load('index', 'dashboard/index', $data);
	}
}
