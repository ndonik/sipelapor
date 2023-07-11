<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkategori_palawija extends CI_Controller
{

    public function index()
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $data['status'] = '';

        $select = array('id', 'uraian');
        $tabel = 'kategori_palawija';
        $query = $this->db->order_by('id', 'ASC');
        $data['kategori_palawija'] = $this->data->get($select, $tabel, $query)->result_array();

        $this->template->load('index', 'subkategori_palawija/index', $data);
    }

    public function filter($id_kategori_palawija = null)
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $data['status'] = 'result';

        if ($id_kategori_palawija) {
            $data['id_kategori_palawija'] = decrypt_url($id_kategori_palawija);
        } else {
            $data['id_kategori_palawija'] = $this->input->post('id_kategori_palawija');
        }

        $select = array('id', 'uraian');
        $tabel = 'kategori_palawija';
        $query = $this->db->order_by('id', 'ASC');
        $data['kategori_palawija'] = $this->data->get($select, $tabel, $query)->result_array();

        $select3 = array('sp.*');
        $tabel3 = 'subkategori_palawija sp';
        $query3 = $this->db->join('kategori_palawija kp', 'kp.id=sp.id_kategori_palawija');
        $query3 = $this->db->where('kp.id', $data['id_kategori_palawija']);
        $query3 = $this->db->order_by('sp.id', 'ASC');
        $data['data_palawija'] = $this->data->get($select3, $tabel3, $query3)->result_array();

        $this->template->load('index', 'subkategori_palawija/index', $data);
    }

    public function add()
    {
        $id_kategori_palawija = $this->input->post('id_kategori_palawija');

        $data['id_kategori_palawija'] = $this->input->post('id_kategori_palawija');
        $data['uraian'] = $this->input->post('uraian');

        $tabel = 'subkategori_palawija';

        $result = $this->data->add($tabel, $data);

        if ($result) {
            $this->session->set_flashdata('alert', 'Ditambah');
            redirect('subkategori_palawija/filter/' . encrypt_url($id_kategori_palawija));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('subkategori_palawija/filter/' . encrypt_url($id_kategori_palawija));
        }
    }

    public function edit($id, $id_kategori_palawija)
    {
        $id = decrypt_url($id);
        $id_kategori_palawija = decrypt_url($id_kategori_palawija);

        $data['id_kategori_palawija'] = $id_kategori_palawija;

        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $select2 = array('id', 'uraian');
        $tabel2 = 'subkategori_palawija';
        $query2 = $this->db->where('s.id', $id);
        $query2 = $this->db->order_by('uraian', 'ASC');
        $data['subkategori_palawija'] = $this->data->get($select2, $tabel2, $query2)->row();

        if ($data['subkategori_palawija']) {
            $this->template->load('index', 'subkategori_palawija/edit', $data);
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('subkategori_palawija/filter/' . encrypt_url($id_kategori_palawija));
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $id_kategori_palawija = $this->input->post('id_kategori_palawija');

        $data['uraian'] = $this->input->post('uraian');

        $kolom = 'id';
        $tabel = 'subkategori_palawija';

        $result = $this->data->update($id, $kolom, $tabel, $data);
        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('subkategori_palawija/filter/' . encrypt_url($id_kategori_palawija));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('subkategori_palawija/filter/' . encrypt_url($id_kategori_palawija));
        }
    }

    public function delete($id, $id_kategori_palawija)
    {
        $id = decrypt_url($id);
        $id_kategori_palawija = decrypt_url($id_kategori_palawija);

        $kolom = 'id';
        $tabel = 'subkategori_palawija';

        $result = $this->data->delete($id, $kolom, $tabel);
        if ($result) {
            $this->session->set_flashdata('alert', 'Dihapus');
            redirect('subkategori_palawija/filter/' . encrypt_url($id_kategori_palawija));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('subkategori_palawija/filter/' . encrypt_url($id_kategori_palawija));
        }
    }
}
