<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_padi extends CI_Controller
{
    public function detail($id, $id_bulan, $id_provinsi, $tahun)
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $id = decrypt_url($id);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $data['id_data_padi'] = $id;
        $data['id_bulan'] = $id_bulan;
        $data['id_provinsi'] = $id_provinsi;
        $data['tahun'] = $tahun;

        $kolom = 'id';
        $tabel = 'data_padi';
        $data['data_padi'] = $this->data->edit($id, $kolom, $tabel)->row();

        $select1 = array('d.id', 'd.*', 'k.uraian', 's.uraian suburaian', 's.id id_suburaian');
        $tabel1 = 'detail_padi d';
        $query1 = $this->db->join('kategori_padi k', 'd.id_kategori_padi=k.id');
        $query1 = $this->db->join('subkategori_padi s', 'd.id_subkategori_padi=s.id');
        $query1 = $this->db->where('d.id_data_padi', $data['id_data_padi']);
        $query1 = $this->db->order_by('k.id,s.id', 'ASC');
        $data['detail_padi'] = $this->data->get($select1, $tabel1, $query1)->result_array();

        $select2 = array('u.id', 'u.catatan', 'u.status', 's.nama_lengkap', 's.nip', 'u.update_at');
        $tabel2 = 'user_padi u';
        $query2 = $this->db->join('user s', 'u.id_user=s.id');
        $query2 = $this->db->where('u.id_data_padi', $data['id_data_padi']);
        $query2 = $this->db->order_by('s.nama_lengkap', 'ASC');
        $data['user_padi'] = $this->data->get($select2, $tabel2, $query2)->result_array();

        $select3 = array('id', 'uraian');
        $tabel3 = 'kategori_padi';
        $query3 = $this->db->order_by('id', 'ASC');
        $data['kategori_padi'] = $this->data->get($select3, $tabel3, $query3)->result_array();

        $select4 = array('id', 'nip', 'nama_lengkap');
        $tabel4 = 'user';
        $query4 = $this->db->order_by('nama_lengkap', 'ASC');
        $data['user'] = $this->data->get($select4, $tabel4, $query4)->result_array();

        $this->template->load('index', 'detail_padi/index', $data);
    }

    public function subkategori_padi($id_kategori_padi)
    {
        $select = array('id', 'uraian');
        $tabel = 'subkategori_padi';
        $query = $this->db->where('id_kategori_padi', $id_kategori_padi);
        $query = $this->db->order_by('id', 'ASC');
        $data = $this->data->get($select, $tabel, $query)->result_array();

        foreach ($data as $value) {
            $data .= '<option value="' . $value['id'] . '">' . $value['uraian'] . '</option>';
        }

        echo $data;
    }

    public function add()
    {
        $id_data_padi = $this->input->post('id_data_padi');
        $id_bulan = $this->input->post('id_bulan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tahun = $this->input->post('tahun');

        $data['id_data_padi'] = $this->input->post('id_data_padi');
        $data['id_kategori_padi'] = $this->input->post('id_kategori_padi');
        $data['id_subkategori_padi'] = $this->input->post('id_subkategori_padi');
        $data['jenis_sawah'] = $this->input->post('jenis_sawah');
        $data['sawah_panen'] = $this->input->post('sawah_panen');
        $data['sawah_tanam'] = $this->input->post('sawah_tanam');
        $data['sawah_rusak'] = $this->input->post('sawah_rusak');
        $data['bukan_panen'] = $this->input->post('bukan_panen');
        $data['bukan_tanam'] = $this->input->post('bukan_tanam');
        $data['bukan_rusak'] = $this->input->post('bukan_rusak');

        $tabel = 'detail_padi';

        $result = $this->data->add($tabel, $data);

        if ($result) {
            $this->session->set_flashdata('alert', 'Ditambah');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function edit($id, $id_data_padi, $id_bulan, $id_provinsi, $tahun)
    {
        $id = decrypt_url($id);
        $id_data_padi = decrypt_url($id_data_padi);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $data['id_data_padi'] = $id_data_padi;
        $data['id_bulan'] = $id_bulan;
        $data['id_provinsi'] = $id_provinsi;
        $data['tahun'] = $tahun;

        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $kolom = 'id';
        $tabel = 'detail_padi';
        $data['detail_padi'] = $this->data->edit($id, $kolom, $tabel)->row();

        if ($data['detail_padi']) {
            $this->template->load('index', 'detail_padi/edit', $data);
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $id_data_padi = $this->input->post('id_data_padi');
        $id_bulan = $this->input->post('id_bulan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tahun = $this->input->post('tahun');

        $data['sawah_panen'] = $this->input->post('sawah_panen');
        $data['sawah_tanam'] = $this->input->post('sawah_tanam');
        $data['sawah_rusak'] = $this->input->post('sawah_rusak');
        $data['bukan_panen'] = $this->input->post('bukan_panen');
        $data['bukan_tanam'] = $this->input->post('bukan_tanam');
        $data['bukan_rusak'] = $this->input->post('bukan_rusak');

        $kolom = 'id';
        $tabel = 'detail_padi';

        $result = $this->data->update($id, $kolom, $tabel, $data);
        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function delete($id, $id_data_padi, $id_bulan, $id_provinsi, $tahun)
    {
        $id = decrypt_url($id);
        $id_data_padi = decrypt_url($id_data_padi);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $kolom = 'id';
        $tabel = 'detail_padi';

        $result = $this->data->delete($id, $kolom, $tabel);
        if ($result) {
            $this->session->set_flashdata('alert', 'Dihapus');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function add_user()
    {
        $id_data_padi = $this->input->post('id_data_padi');
        $id_bulan = $this->input->post('id_bulan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tahun = $this->input->post('tahun');

        $data['id_data_padi'] = $this->input->post('id_data_padi');
        $data['id_user'] = $this->input->post('id_user');

        $tabel = 'user_padi';

        $result = $this->data->add($tabel, $data);

        if ($result) {
            $this->session->set_flashdata('alert', 'Ditambah');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function delete_user($id, $id_data_padi, $id_bulan, $id_provinsi, $tahun)
    {
        $id = decrypt_url($id);
        $id_data_padi = decrypt_url($id_data_padi);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $kolom = 'id';
        $tabel = 'user_padi';

        $result = $this->data->delete($id, $kolom, $tabel);
        if ($result) {
            $this->session->set_flashdata('alert', 'Dihapus');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function complete()
    {
        $id_data_padi = $this->input->post('id_data_padi');
        $id_bulan = $this->input->post('id_bulan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tahun = $this->input->post('tahun');

        $data['status'] = 'Complete';

        $kolom = 'id';
        $tabel = 'data_padi';

        $result = $this->data->update($id_data_padi, $kolom, $tabel, $data);

        $kolom1 = 'id';
        $tabel1 = 'data_padi';
        $data_padi = $this->data->edit($id_data_padi, $kolom1, $tabel1)->row();

        $nomor = $data_padi->nomor;
        $provinsi = wilayah('provinsi', $data_padi->id_provinsi);
        $kabupaten = wilayah('kabupaten', $data_padi->id_kabupaten);
        $kecamatan = wilayah('kecamatan', $data_padi->id_kecamatan);

        $text = 'Pelaporan Padi dengan nomor : ' . $nomor . ' telah selesai diinput oleh : ' . $_SESSION['nama_lengkap'] . '.  Detail Pelaporan -- Alamat : ' . $provinsi . ', ' . $kabupaten . ', ' . $kecamatan;

        send_telegram($text);

        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_padi/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }
}
