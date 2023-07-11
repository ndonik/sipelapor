<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_palawija extends CI_Controller
{

    public function detail($id, $id_bulan, $id_provinsi, $tahun)
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $id = decrypt_url($id);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $data['id_data_palawija'] = $id;
        $data['id_bulan'] = $id_bulan;
        $data['id_provinsi'] = $id_provinsi;
        $data['tahun'] = $tahun;

        $kolom = 'id';
        $tabel = 'data_palawija';
        $data['data_palawija'] = $this->data->edit($id, $kolom, $tabel)->row();

        $select1 = array('d.id', 'd.*', 'k.uraian', 's.uraian suburaian', 's.id id_suburaian');
        $tabel1 = 'detail_palawija d';
        $query1 = $this->db->join('kategori_palawija k', 'd.id_kategori_palawija=k.id');
        $query1 = $this->db->join('subkategori_palawija s', 'd.id_subkategori_palawija=s.id');
        $query1 = $this->db->where('d.id_data_palawija', $data['id_data_palawija']);
        $query1 = $this->db->order_by('k.id,s.id', 'ASC');
        $data['detail_palawija'] = $this->data->get($select1, $tabel1, $query1)->result_array();

        $select2 = array('u.id', 'u.catatan', 'u.status', 's.nama_lengkap', 's.nip', 'u.update_at');
        $tabel2 = 'user_palawija u';
        $query2 = $this->db->join('user s', 'u.id_user=s.id');
        $query2 = $this->db->where('u.id_data_palawija', $data['id_data_palawija']);
        $query2 = $this->db->order_by('s.nama_lengkap', 'ASC');
        $data['user_palawija'] = $this->data->get($select2, $tabel2, $query2)->result_array();

        $select3 = array('id', 'uraian');
        $tabel3 = 'kategori_palawija';
        $query3 = $this->db->order_by('id', 'ASC');
        $data['kategori_palawija'] = $this->data->get($select3, $tabel3, $query3)->result_array();

        $select4 = array('id', 'nip', 'nama_lengkap');
        $tabel4 = 'user';
        $query4 = $this->db->order_by('nama_lengkap', 'ASC');
        $data['user'] = $this->data->get($select4, $tabel4, $query4)->result_array();

        $this->template->load('index', 'detail_palawija/index', $data);
    }

    public function subkategori_palawija($id_kategori_palawija)
    {
        $select = array('id', 'uraian');
        $tabel = 'subkategori_palawija';
        $query = $this->db->where('id_kategori_palawija', $id_kategori_palawija);
        $query = $this->db->order_by('id', 'ASC');
        $data = $this->data->get($select, $tabel, $query)->result_array();

        foreach ($data as $value) {
            $data .= '<option value="' . $value['id'] . '">' . $value['uraian'] . '</option>';
        }

        echo $data;
    }

    public function add()
    {
        $id_data_palawija = $this->input->post('id_data_palawija');
        $id_bulan = $this->input->post('id_bulan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tahun = $this->input->post('tahun');

        $data['id_data_palawija'] = $this->input->post('id_data_palawija');
        $data['id_kategori_palawija'] = $this->input->post('id_kategori_palawija');
        $data['id_subkategori_palawija'] = $this->input->post('id_subkategori_palawija');
        $data['jenis_sawah'] = $this->input->post('jenis_sawah');
        $data['sawah_panen'] = $this->input->post('sawah_panen');
        $data['sawah_panen_muda'] = $this->input->post('sawah_panen_muda');
        $data['sawah_panen_ternak'] = $this->input->post('sawah_panen_ternak');
        $data['sawah_tanam'] = $this->input->post('sawah_tanam');
        $data['sawah_rusak'] = $this->input->post('sawah_rusak');
        $data['bukan_panen'] = $this->input->post('bukan_panen');
        $data['bukan_panen_muda'] = $this->input->post('bukan_panen_muda');
        $data['bukan_panen_ternak'] = $this->input->post('bukan_panen_ternak');
        $data['bukan_tanam'] = $this->input->post('bukan_tanam');
        $data['bukan_rusak'] = $this->input->post('bukan_rusak');

        $tabel = 'detail_palawija';

        $result = $this->data->add($tabel, $data);

        if ($result) {
            $this->session->set_flashdata('alert', 'Ditambah');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function edit($id, $id_data_palawija, $id_bulan, $id_provinsi, $tahun)
    {
        $id = decrypt_url($id);
        $id_data_palawija = decrypt_url($id_data_palawija);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $data['id_data_palawija'] = $id_data_palawija;
        $data['id_bulan'] = $id_bulan;
        $data['id_provinsi'] = $id_provinsi;
        $data['tahun'] = $tahun;

        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $kolom = 'id';
        $tabel = 'detail_palawija';
        $data['detail_palawija'] = $this->data->edit($id, $kolom, $tabel)->row();

        if ($data['detail_palawija']) {
            $this->template->load('index', 'detail_palawija/edit', $data);
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $id_data_palawija = $this->input->post('id_data_palawija');
        $id_bulan = $this->input->post('id_bulan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tahun = $this->input->post('tahun');

        $data['sawah_panen'] = $this->input->post('sawah_panen');
        $data['sawah_panen_muda'] = $this->input->post('sawah_panen_muda');
        $data['sawah_panen_ternak'] = $this->input->post('sawah_panen_ternak');
        $data['sawah_tanam'] = $this->input->post('sawah_tanam');
        $data['sawah_rusak'] = $this->input->post('sawah_rusak');
        $data['bukan_panen'] = $this->input->post('bukan_panen');
        $data['bukan_panen_muda'] = $this->input->post('bukan_panen_muda');
        $data['bukan_panen_ternak'] = $this->input->post('bukan_panen_ternak');
        $data['bukan_tanam'] = $this->input->post('bukan_tanam');
        $data['bukan_rusak'] = $this->input->post('bukan_rusak');

        $kolom = 'id';
        $tabel = 'detail_palawija';

        $result = $this->data->update($id, $kolom, $tabel, $data);
        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function delete($id, $id_data_palawija, $id_bulan, $id_provinsi, $tahun)
    {
        $id = decrypt_url($id);
        $id_data_palawija = decrypt_url($id_data_palawija);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $kolom = 'id';
        $tabel = 'detail_palawija';

        $result = $this->data->delete($id, $kolom, $tabel);
        if ($result) {
            $this->session->set_flashdata('alert', 'Dihapus');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function add_user()
    {
        $id_data_palawija = $this->input->post('id_data_palawija');
        $id_bulan = $this->input->post('id_bulan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tahun = $this->input->post('tahun');

        $data['id_data_palawija'] = $this->input->post('id_data_palawija');
        $data['id_user'] = $this->input->post('id_user');

        $tabel = 'user_palawija';

        $result = $this->data->add($tabel, $data);

        if ($result) {
            $this->session->set_flashdata('alert', 'Ditambah');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function delete_user($id, $id_data_palawija, $id_bulan, $id_provinsi, $tahun)
    {
        $id = decrypt_url($id);
        $id_data_palawija = decrypt_url($id_data_palawija);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $kolom = 'id';
        $tabel = 'user_palawija';

        $result = $this->data->delete($id, $kolom, $tabel);
        if ($result) {
            $this->session->set_flashdata('alert', 'Dihapus');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }

    public function complete()
    {
        $id_data_palawija = $this->input->post('id_data_palawija');
        $id_bulan = $this->input->post('id_bulan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tahun = $this->input->post('tahun');

        $data['status'] = 'Complete';

        $kolom = 'id';
        $tabel = 'data_palawija';

        $result = $this->data->update($id_data_palawija, $kolom, $tabel, $data);

        $kolom1 = 'id';
        $tabel1 = 'data_palawija';
        $data_palawija = $this->data->edit($id_data_palawija, $kolom1, $tabel1)->row();

        $nomor = $data_palawija->nomor;
        $provinsi = wilayah('provinsi', $data_palawija->id_provinsi);
        $kabupaten = wilayah('kabupaten', $data_palawija->id_kabupaten);
        $kecamatan = wilayah('kecamatan', $data_palawija->id_kecamatan);

        $text = 'Pelaporan Palawija dengan nomor : ' . $nomor . ' telah selesai diinput. Detail Pelaporan -- Alamat : ' . $provinsi . ', ' . $kabupaten . ', ' . $kecamatan;

        send_telegram($text);

        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun));
        }
    }
}
