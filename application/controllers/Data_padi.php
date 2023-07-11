<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_padi extends CI_Controller
{
	public function index()
	{
		$data['header'] = 'master/table/header';
		$data['footer'] = 'master/table/footer';

		$data['status'] = '';

		$select = array('id', 'bulan');
		$tabel = 'bulan';
		$query = $this->db->order_by('id', 'ASC');
		$data['bulan'] = $this->data->get($select, $tabel, $query)->result_array();

		$select1 = array('DISTINCT(tahun)');
		$tabel1 = 'data_padi';
		$query1 = $this->db->order_by('tahun', 'ASC');
		$query1 = $this->db->limit(1);
		$data['tahun_awal'] = $this->data->get($select1, $tabel1, $query1)->row();

		$select2 = array('DISTINCT(tahun)');
		$tabel2 = 'data_padi';
		$query2 = $this->db->order_by('tahun', 'DESC');
		$query2 = $this->db->limit(1);
		$data['tahun_akhir'] = $this->data->get($select2, $tabel2, $query2)->row();

		$this->template->load('index', 'data_padi/index', $data);
	}

	public function filter($id_bulan = null, $id_provinsi = null, $tahun = null)
	{
		$data['header'] = 'master/table/header';
		$data['footer'] = 'master/table/footer';

		$data['status'] = 'result';

		if ($id_bulan) {
			$data['id_bulan'] = decrypt_url($id_bulan);
			$data['id_provinsi'] = decrypt_url($id_provinsi);
			$data['tahun'] = decrypt_url($tahun);
		} else {
			$data['id_bulan'] = $this->input->post('id_bulan');
			$data['id_provinsi'] = $this->input->post('id_provinsi');
			$data['tahun'] = $this->input->post('tahun');
		}

		$select = array('id', 'bulan');
		$tabel = 'bulan';
		$query = $this->db->order_by('id', 'ASC');
		$data['bulan'] = $this->data->get($select, $tabel, $query)->result_array();

		$select1 = array('DISTINCT(tahun)');
		$tabel1 = 'data_padi';
		$query1 = $this->db->order_by('tahun', 'ASC');
		$query1 = $this->db->limit(1);
		$data['tahun_awal'] = $this->data->get($select1, $tabel1, $query1)->row();

		$select2 = array('DISTINCT(tahun)');
		$tabel2 = 'data_padi';
		$query2 = $this->db->order_by('tahun', 'DESC');
		$query2 = $this->db->limit(1);
		$data['tahun_akhir'] = $this->data->get($select2, $tabel2, $query2)->row();

		$select3 = array('d.id', 'd.nomor', 'd.status', 'd.status_verifikasi', 'd.id_kecamatan', 'd.id_kabupaten', 'u.nama_lengkap');
		$tabel3 = 'data_padi d';
		$query3 = $this->db->join('bulan b', 'd.id_bulan=b.id');
		$query3 = $this->db->join('user u', 'd.id_user=u.id');
		$query3 = $this->db->where('d.id_bulan', $data['id_bulan']);
		$query3 = $this->db->where('d.id_provinsi', $data['id_provinsi']);
		$query3 = $this->db->where('d.tahun', $data['tahun']);
		$query3 = $this->db->order_by('d.nomor', 'ASC');
		$data['data_padi'] = $this->data->get($select3, $tabel3, $query3)->result_array();

		$this->template->load('index', 'data_padi/index', $data);
	}

	public function add()
	{
		$id_bulan = $this->input->post('id_bulan');
		$id_provinsi = $this->input->post('id_provinsi');
		$tahun = $this->input->post('tahun');

		$data['nomor'] = $this->input->post('nomor');
		$data['id_bulan'] = $id_bulan;
		$data['tahun'] = $tahun;
		$data['id_provinsi'] = $id_provinsi;
		$data['id_kecamatan'] = $this->input->post('id_kecamatan');
		$data['id_kabupaten'] = $this->input->post('id_kabupaten');
		$data['status'] = 'Pending';
		$data['id_user'] = $_SESSION['id'];

		$tabel = 'data_padi';

		$result = $this->data->add($tabel, $data);

		if ($result) {
			$this->session->set_flashdata('alert', 'Ditambah');
			redirect('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
		}
	}

	public function edit($id, $id_bulan, $id_provinsi, $tahun)
	{
		$id = decrypt_url($id);
		$id_bulan = decrypt_url($id_bulan);
		$id_provinsi = decrypt_url($id_provinsi);
		$tahun = decrypt_url($tahun);

		$data['id_bulan'] = $id_bulan;
		$data['id_provinsi'] = $id_provinsi;
		$data['tahun'] = $tahun;

		$data['header'] = 'master/table/header';
		$data['footer'] = 'master/table/footer';

		$kolom = 'id';
		$tabel = 'data_padi';
		$data['data_padi'] = $this->data->edit($id, $kolom, $tabel)->row();

		if ($data['data_padi']) {
			$this->template->load('index', 'data_padi/edit', $data);
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
		}
	}

	public function update()
	{
		$id = $this->input->post('id');
		$id_bulan = $this->input->post('id_bulan');
		$id_provinsi = $this->input->post('id_provinsi');
		$tahun = $this->input->post('tahun');

		$data['nomor'] = $this->input->post('nomor');
		$data['id_kecamatan'] = $this->input->post('id_kecamatan');
		$data['id_kabupaten'] = $this->input->post('id_kabupaten');

		$kolom = 'id';
		$tabel = 'data_padi';

		$result = $this->data->update($id, $kolom, $tabel, $data);
		if ($result) {
			$this->session->set_flashdata('alert', 'Diubah');
			redirect('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
		}
	}

	public function delete($id, $id_bulan, $id_provinsi, $tahun)
	{
		$id = decrypt_url($id);
		$id_bulan = decrypt_url($id_bulan);
		$id_provinsi = decrypt_url($id_provinsi);
		$tahun = decrypt_url($tahun);

		$kolom = 'id';
		$tabel = 'data_padi';

		$result = $this->data->delete($id, $kolom, $tabel);
		if ($result) {
			$this->session->set_flashdata('alert', 'Dihapus');
			redirect('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
		} else {
			$this->session->set_flashdata('alert', 'Gagal');
			redirect('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
		}
	}
}
