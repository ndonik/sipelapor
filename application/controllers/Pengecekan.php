<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengecekan extends CI_Controller
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

        $this->template->load('index', 'pengecekan/index', $data);
    }

    public function filter($id_bulan = null, $tahun = null)
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $data['status'] = 'result';

        if ($id_bulan) {
            $data['id_bulan'] = decrypt_url($id_bulan);
            $data['tahun'] = decrypt_url($tahun);
        } else {
            $data['id_bulan'] = $this->input->post('id_bulan');
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

        $select3 = array('d.id', 'd.nomor', 'd.status', 'd.status_verifikasi', 'd.id_kecamatan', 'd.id_kabupaten', 'd.id_provinsi', 'u.nama_lengkap', 'd.update_at');
        $tabel3 = 'data_padi d';
        $query3 = $this->db->join('bulan b', 'd.id_bulan=b.id');
        $query3 = $this->db->join('user u', 'd.id_user=u.id');
        $query3 = $this->db->where('d.id_bulan', $data['id_bulan']);
        $query3 = $this->db->where('d.tahun', $data['tahun']);
        $query3 = $this->db->where('d.status', 'Complete');
        $query3 = $this->db->order_by('d.nomor', 'ASC');
        $data['data_padi'] = $this->data->get($select3, $tabel3, $query3)->result_array();

        $this->template->load('index', 'pengecekan/index', $data);
    }

    public function detail($id, $id_bulan, $tahun)
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $id = decrypt_url($id);
        $id_bulan = decrypt_url($id_bulan);
        $tahun = decrypt_url($tahun);

        $data['id_data_padi'] = $id;
        $data['id_bulan'] = $id_bulan;
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

        $select3 = array('id', 'status');
        $tabel3 = 'user_padi';
        $query3 = $this->db->where('id_data_padi', $data['id_data_padi']);
        $query3 = $this->db->where('id_user', $_SESSION['id']);
        $query3 = $this->db->order_by('id', 'DESC');
        $query3 = $this->db->limit(1);
        $data['user'] = $this->data->get($select3, $tabel3, $query3)->row();

        $this->template->load('index', 'pengecekan/detail', $data);
    }

    public function ditolak($id, $id_bulan, $tahun)
    {
        $id = decrypt_url($id);
        $id_bulan = decrypt_url($id_bulan);
        $tahun = decrypt_url($tahun);

        $data['status_verifikasi'] = 'Cancel';

        $kolom = 'id';
        $tabel = 'data_padi';

        $result = $this->data->update($id, $kolom, $tabel, $data);

        $kolom2 = 'id';
        $tabel2 = 'data_padi';
        $data_padi = $this->data->edit($id, $kolom2, $tabel2)->row();

        $nomor = $data_padi->nomor;
        $provinsi = wilayah('provinsi', $data_padi->id_provinsi);
        $kabupaten = wilayah('kabupaten', $data_padi->id_kabupaten);
        $kecamatan = wilayah('kecamatan', $data_padi->id_kecamatan);

        $text = 'Pelaporan Padi dengan nomor : ' . $nomor . ' telah DITOLAK oleh : ' . $_SESSION['nama_lengkap'] . '. Detail Pelaporan -- Alamat : ' . $provinsi . ', ' . $kabupaten . ', ' . $kecamatan;

        send_telegram($text);

        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('pengecekan/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('pengecekan/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($tahun));
        }
    }

    public function verifikasi()
    {
        $id = $this->input->post('id_user_padi');

        $id_data_padi = $this->input->post('id_data_padi');
        $id_bulan = $this->input->post('id_bulan');
        $tahun = $this->input->post('tahun');

        $kolom2 = 'id';
        $tabel2 = 'data_padi';
        $data_padi = $this->data->edit($id_data_padi, $kolom2, $tabel2)->row();

        $nomor = $data_padi->nomor;
        $provinsi = wilayah('provinsi', $data_padi->id_provinsi);
        $kabupaten = wilayah('kabupaten', $data_padi->id_kabupaten);
        $kecamatan = wilayah('kecamatan', $data_padi->id_kecamatan);

        $text = 'Pelaporan Padi dengan nomor : ' . $nomor . ' telah DIVERIFIKASI oleh : ' . $_SESSION['nama_lengkap'] . '. Detail Pelaporan -- Alamat : ' . $provinsi . ', ' . $kabupaten . ', ' . $kecamatan;

        $data['catatan'] = $this->input->post('catatan');
        $data['status'] = 'Complete';

        $kolom = 'id';
        $tabel = 'user_padi';

        $this->data->update($id, $kolom, $tabel, $data);

        $data1['status_verifikasi'] = 'Complete';
        $tabel1 = 'data_padi';

        $result = $this->data->update($id_data_padi, $kolom, $tabel1, $data1);

        send_telegram($text);

        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('pengecekan/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('pengecekan/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($tahun));
        }
    }

    public function cancel()
    {
        $id = $this->input->post('id_user_padi');

        $id_data_padi = $this->input->post('id_data_padi');
        $id_bulan = $this->input->post('id_bulan');
        $tahun = $this->input->post('tahun');


        $kolom2 = 'id';
        $tabel2 = 'data_padi';
        $data_padi = $this->data->edit($id_data_padi, $kolom2, $tabel2)->row();

        $nomor = $data_padi->nomor;
        $provinsi = wilayah('provinsi', $data_padi->id_provinsi);
        $kabupaten = wilayah('kabupaten', $data_padi->id_kabupaten);
        $kecamatan = wilayah('kecamatan', $data_padi->id_kecamatan);

        $text = 'Pelaporan Padi dengan nomor : ' . $nomor . ' telah DIKEMBALIKAN oleh : ' . $_SESSION['nama_lengkap'] . '. Detail Pelaporan -- Alamat : ' . $provinsi . ', ' . $kabupaten . ', ' . $kecamatan;


        $data['catatan'] = $this->input->post('catatan');
        $data['status'] = 'Correction';

        $kolom = 'id';
        $tabel = 'user_padi';

        $this->data->update($id, $kolom, $tabel, $data);

        $data1['status_verifikasi'] = 'Pending';
        $data1['status'] = 'Pending';
        $tabel1 = 'data_padi';

        $result = $this->data->update($id_data_padi, $kolom, $tabel1, $data1);

        send_telegram($text);

        if ($result) {
            $this->session->set_flashdata('alert', 'Diubah');
            redirect('pengecekan/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($tahun));
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('pengecekan/detail/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($tahun));
        }
    }
}
