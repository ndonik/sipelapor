<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bulan extends CI_Controller
{
	public function index()
	{
		$data['header'] = 'master/table/header';
		$data['footer'] = 'master/table/footer';

		$select = array('id', 'bulan');
		$tabel = 'bulan';
		$query = $this->db->order_by('id', 'ASC');
		$data['bulan'] = $this->data->get($select, $tabel, $query)->result_array();

		$this->template->load('index', 'bulan/index', $data);
	}

	public function add()
	{
		$bulan = $this->input->post('bulan');

		$tabel = 'bulan';

		if (!$this->cek('', $bulan, $tabel)) {

			$data['bulan'] = $bulan;

			$result = $this->data->add($tabel, $data);
			if ($result) {
				$this->session->set_flashdata('alert', 'Ditambah');
				redirect('bulan');
			} else {
				$this->session->set_flashdata('alert', 'Gagal');
				redirect('bulan');
			}
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('bulan');
		}
	}

	public function edit($id)
	{
		$id = decrypt_url($id);

		$data['header'] = 'master/table/header';
		$data['footer'] = 'master/table/footer';

		$kolom = 'id';
		$tabel = 'bulan';
		$data['bulan'] = $this->data->edit($id, $kolom, $tabel)->row();

		if ($data['bulan']) {
			$this->template->load('index', 'bulan/edit', $data);
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('bulan');
		}
	}

	public function update()
	{
		$id = $this->input->post('id');

		$bulan = $this->input->post('bulan');

		$kolom = 'id';
		$tabel = 'bulan';

		if (!$this->cek($id, $bulan, $tabel)) {

			$data['bulan'] = $bulan;

			$result = $this->data->update($id, $kolom, $tabel, $data);
			if ($result) {
				$this->session->set_flashdata('alert', 'Diubah');
				redirect('bulan');
			} else {
				$this->session->set_flashdata('alert', 'Gagal');
				redirect('bulan');
			}
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('bulan');
		}
	}

	public function delete($id)
	{
		$id = decrypt_url($id);

		$kolom = 'id';
		$tabel = 'bulan';

		$result = $this->data->delete($id, $kolom, $tabel);
		if ($result) {
			$this->session->set_flashdata('alert', 'Dihapus');
			redirect('bulan');
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('bulan');
		}
	}

	public function cek($id, $bulan, $tabel)
	{
		$select = array('id');
		$query = $this->db->where('bulan', $bulan);
		if ($id) {
			$query = $this->db->where('id!=', $id);
		}
		$data = $this->data->get($select, $tabel, $query)->num_rows();

		return $data;
	}
}
