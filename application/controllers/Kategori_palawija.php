<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_palawija extends CI_Controller
{

    public function index()
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $select = array('id', 'uraian');
        $tabel = 'kategori_palawija';
        $query = $this->db->order_by('id', 'ASC');
        $data['kategori_palawija'] = $this->data->get($select, $tabel, $query)->result_array();

        $this->template->load('index', 'kategori_palawija/index', $data);
    }

    public function add()
    {
        $data['uraian'] = $this->input->post('uraian');

        $tabel = 'kategori_palawija';

        $result = $this->data->add($tabel, $data);
        if ($result) {
            $this->session->set_flashdata('alert', 'Ditambah');
            redirect('kategori_palawija');
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('kategori_palawija');
        }
    }

    public function edit($id)
    {
        $id = decrypt_url($id);

        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $kolom = 'id';
        $tabel = 'kategori_palawija';
        $data['kategori_palawija'] = $this->data->edit($id, $kolom, $tabel)->row();

        if ($data['kategori_palawija']) {
            $this->template->load('index', 'kategori_palawija/edit', $data);
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('kategori_palawija');
        }
    }

    public function update()
    {
        $id = $this->input->post('id');

        $data['uraian'] = $this->input->post('uraian');

        $kolom = 'id';
        $tabel = 'kategori_palawija';

        $result = $this->data->update($id, $kolom, $tabel, $data);
        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('kategori_palawija');
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('kategori_palawija');
        }
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $kolom = 'id';
        $tabel = 'kategori_palawija';

        $result = $this->data->delete($id, $kolom, $tabel);
        if ($result) {
            $this->session->set_flashdata('alert', 'Dihapus');
            redirect('kategori_palawija');
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('kategori_palawija');
        }
    }
}
