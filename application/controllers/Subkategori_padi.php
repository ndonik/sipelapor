<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkategori_padi extends CI_Controller
{

    public function index()
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $data['status'] = '';

        $select = array('id', 'uraian');
        $tabel = 'kategori_padi';
        $query = $this->db->order_by('id', 'ASC');
        $data['kategori_padi'] = $this->data->get($select, $tabel, $query)->result_array();

        $this->template->load('index', 'subkategori_padi/index', $data);
    }

    public function filter($id_kategori_padi = null)
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $data['status'] = 'result';

        if ($id_kategori_padi) {
            $data['id_kategori_padi'] = decrypt_url($id_kategori_padi);
        } else {
            $data['id_kategori_padi'] = $this->input->post('id_kategori_padi');
        }

        $select = array('id', 'uraian');
        $tabel = 'kategori_padi';
        $query = $this->db->order_by('id', 'ASC');
        $data['kategori_padi'] = $this->data->get($select, $tabel, $query)->result_array();

        $select3 = array('sp.*');
        $tabel3 = 'subkategori_padi sp';
        $query3 = $this->db->join('kategori_padi kp', 'kp.id=sp.id_kategori_padi');
        $query3 = $this->db->where('kp.id', $data['id_kategori_padi']);
        $query3 = $this->db->order_by('sp.id', 'ASC');
        $data['data_padi'] = $this->data->get($select3, $tabel3, $query3)->result_array();

        $this->template->load('index', 'subkategori_padi/index', $data);
    }

    public function add()
    {
        $id_kategori_padi = $this->input->post('id_kategori_padi');

        $data['id_kategori_padi'] = $this->input->post('id_kategori_padi');
        $data['uraian'] = $this->input->post('uraian');

        $tabel = 'subkategori_padi';

        $result = $this->data->add($tabel, $data);

        if ($result) {
            $this->session->set_flashdata('alert', 'Ditambah');
            redirect('subkategori_padi/filter/' . encrypt_url($id_kategori_padi));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('subkategori_padi/filter/' . encrypt_url($id_kategori_padi));
        }
    }

    public function edit($id, $id_kategori_padi)
    {
        $id = decrypt_url($id);
        $id_kategori_padi = decrypt_url($id_kategori_padi);

        $data['id_kategori_padi'] = $id_kategori_padi;

        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $select2 = array('id', 'uraian');
        $tabel2 = 'subkategori_padi';
        $query2 = $this->db->where('s.id', $id);
        $query2 = $this->db->order_by('uraian', 'ASC');
        $data['subkategori_padi'] = $this->data->get($select2, $tabel2, $query2)->row();

        if ($data['subkategori_padi']) {
            $this->template->load('index', 'subkategori_padi/edit', $data);
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('subkategori_padi/filter/' . encrypt_url($id_kategori_padi));
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $id_kategori_padi = $this->input->post('id_kategori_padi');

        $data['uraian'] = $this->input->post('uraian');

        $kolom = 'id';
        $tabel = 'subkategori_padi';

        $result = $this->data->update($id, $kolom, $tabel, $data);
        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('subkategori_padi/filter/' . encrypt_url($id_kategori_padi));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('subkategori_padi/filter/' . encrypt_url($id_kategori_padi));
        }
    }

    public function delete($id, $id_kategori_padi)
    {
        $id = decrypt_url($id);
        $id_kategori_padi = decrypt_url($id_kategori_padi);

        $kolom = 'id';
        $tabel = 'subkategori_padi';

        $result = $this->data->delete($id, $kolom, $tabel);
        if ($result) {
            $this->session->set_flashdata('alert', 'Dihapus');
            redirect('subkategori_padi/filter/' . encrypt_url($id_kategori_padi));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('subkategori_padi/filter/' . encrypt_url($id_kategori_padi));
        }
    }
}
