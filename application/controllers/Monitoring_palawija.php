<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Monitoring_palawija extends CI_Controller
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
        $tabel1 = 'data_palawija';
        $query1 = $this->db->order_by('tahun', 'ASC');
        $query1 = $this->db->limit(1);
        $data['tahun_awal'] = $this->data->get($select1, $tabel1, $query1)->row();

        $select2 = array('DISTINCT(tahun)');
        $tabel2 = 'data_palawija';
        $query2 = $this->db->order_by('tahun', 'DESC');
        $query2 = $this->db->limit(1);
        $data['tahun_akhir'] = $this->data->get($select2, $tabel2, $query2)->row();

        $this->template->load('index', 'monitoring_palawija/index', $data);
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
        $tabel1 = 'data_palawija';
        $query1 = $this->db->order_by('tahun', 'ASC');
        $query1 = $this->db->limit(1);
        $data['tahun_awal'] = $this->data->get($select1, $tabel1, $query1)->row();

        $select2 = array('DISTINCT(tahun)');
        $tabel2 = 'data_palawija';
        $query2 = $this->db->order_by('tahun', 'DESC');
        $query2 = $this->db->limit(1);
        $data['tahun_akhir'] = $this->data->get($select2, $tabel2, $query2)->row();

        $select3 = array('d.id', 'd.nomor', 'd.status', 'd.status_verifikasi', 'd.id_kecamatan', 'd.id_kabupaten', 'u.nama_lengkap');
        $tabel3 = 'data_palawija d';
        $query3 = $this->db->join('bulan b', 'd.id_bulan=b.id');
        $query3 = $this->db->join('user u', 'd.id_user=u.id');
        $query3 = $this->db->where('d.id_bulan', $data['id_bulan']);
        $query3 = $this->db->where('d.id_provinsi', $data['id_provinsi']);
        $query3 = $this->db->where('d.tahun', $data['tahun']);
        $query3 = $this->db->order_by('d.nomor', 'ASC');
        $data['data_palawija'] = $this->data->get($select3, $tabel3, $query3)->result_array();

        $this->template->load('index', 'monitoring_palawija/index', $data);
    }

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

        $this->template->load('index', 'monitoring_palawija/detail', $data);
    }

    public function export($id, $id_bulan, $id_provinsi, $tahun)
    {
        $id = decrypt_url($id);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $kolom = 'id';
        $tabel = 'data_palawija';
        $data_palawija = $this->data->edit($id, $kolom, $tabel)->row();

        $select1 = array('d.id', 'd.*', 'k.uraian', 's.uraian suburaian', 's.id id_suburaian');
        $tabel1 = 'detail_palawija d';
        $query1 = $this->db->join('kategori_palawija k', 'd.id_kategori_palawija=k.id');
        $query1 = $this->db->join('subkategori_palawija s', 'd.id_subkategori_palawija=s.id');
        $query1 = $this->db->where('d.id_data_palawija', $id);
        $query1 = $this->db->order_by('k.id,s.id', 'ASC');
        $detail_palawija = $this->data->get($select1, $tabel1, $query1)->result_array();

        $select2 = array('u.id', 'u.catatan', 'u.status', 's.nama_lengkap', 's.nip', 'u.update_at');
        $tabel2 = 'user_palawija u';
        $query2 = $this->db->join('user s', 'u.id_user=s.id');
        $query2 = $this->db->where('u.id_data_palawija', $id);
        $query2 = $this->db->order_by('s.nama_lengkap', 'ASC');
        $user_palawija = $this->data->get($select2, $tabel2, $query2)->result_array();

        $tabel3 = 'bulan';
        $bulan = $this->data->edit($data_palawija->id_bulan, $kolom, $tabel3)->row();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomor')
            ->setCellValue('B1', 'Provinsi')
            ->setCellValue('C1', 'Kabupaten')
            ->setCellValue('D1', 'Kecamatan')
            ->setCellValue('E1', 'Bulan')
            ->setCellValue('F1', 'Tahun')
            ->setCellValue('G1', 'Status Verifikasi');

        $kolom_data = 2;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom_data, $data_palawija->nomor)
            ->setCellValue('B' . $kolom_data, wilayah('provinsi', $data_palawija->id_provinsi))
            ->setCellValue('C' . $kolom_data, wilayah('kabupaten', $data_palawija->id_kabupaten))
            ->setCellValue('D' . $kolom_data, wilayah('kecamatan', $data_palawija->id_kecamatan))
            ->setCellValue('E' . $kolom_data, $bulan->bulan)
            ->setCellValue('F' . $kolom_data, $data_palawija->tahun)
            ->setCellValue('G' . $kolom_data, $data_palawija->status_verifikasi);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A5', 'No')
            ->mergeCells('A5:A6')
            ->setCellValue('B5', 'Uraian')
            ->mergeCells('B5:B6')
            ->setCellValue('C5', 'Lahan Sawah')
            ->mergeCells('C5:D5:E5:F5:G5:H5:I5:J5')
            ->setCellValue('C6', 'Tanaman Akhir Bulan Yang Lalu')
            ->setCellValue('D6', 'Panen')
            ->setCellValue('E6', 'Panen Muda')
            ->setCellValue('F6', 'Panen Untuk Hijauan Pakan Ternak')
            ->setCellValue('G6', 'Tanam')
            ->setCellValue('H6', 'Puso/rusak')
            ->setCellValue('I6', 'Tanaman Akhir Bulan Laporan')
            ->setCellValue('J5', 'Lahan Bukan Sawah')
            ->mergeCells('J5:K5:L5:M5:N5:O5:P5')
            ->setCellValue('J6', 'Tanaman Akhir Bulan Yang Lalu')
            ->setCellValue('K6', 'Panen')
            ->setCellValue('L6', 'Panen Muda')
            ->setCellValue('M6', 'Panen Untuk Hijauan Pakan Ternak')
            ->setCellValue('N6', 'Tanam')
            ->setCellValue('O6', 'Puso/rusak')
            ->setCellValue('P6', 'Tanaman Akhir Bulan Laporan');

        $kolom_uraian = 7;
        $no_uraian = 1;
        foreach ($detail_palawija as $dt) {

            $id_suburaian = $dt['id_suburaian'];

            $id_bulan = $bulan->id - 1;

            $this->db->where('id', $id_bulan);
            $bulan_sebelumnyaa = $this->db->get('bulan')->row();

            $tahun = $tahun;
            $id_kecamatan = $data_palawija->id_kecamatan;

            $this->load->model('error/data');

            $select = array('sawah_panen', 'sawah_tanam', 'sawah_rusak');
            $tabel = 'detail_palawija dt';
            $query = $this->db->join('data_palawija d', 'dt.id_data_palawija=d.id');
            $query = $this->db->where('d.id_bulan', @$bulan_sebelumnyaa->id);
            $query = $this->db->where('d.tahun', $tahun);
            $query = $this->db->where('d.id_kecamatan', $id_kecamatan);
            $query = $this->db->where('dt.id_subkategori_palawija', $id_suburaian);
            $data_sawah_lalu = $this->data->get($select, $tabel, $query)->result_array();

            $jumlah_sawah_lalu = 0;
            foreach ($data_sawah_lalu as $ds) {
                $jumlah_sawah_lalu = $jumlah_sawah_lalu + (($ds['sawah_panen'] - $ds['sawah_panen_muda'] - $ds['sawah_panen_ternak']) + ($ds['sawah_tanam'] - $ds['sawah_rusak']));
            }

            $total_sawah = ($dt['sawah_panen'] - $dt['sawah_panen_muda'] - $dt['sawah_panen_ternak']) +  ($dt['sawah_tanam'] -  $dt['sawah_rusak']);

            if ($jumlah_sawah_lalu > 0) {
                $total_sawah_sekarang = $jumlah_sawah_lalu - $total_sawah;
            } else {
                $total_sawah_sekarang = $total_sawah;
            }

            $select1 = array('bukan_panen', 'bukan_tanam', 'bukan_rusak');
            $tabel1 = 'detail_palawija dt';
            $query1 = $this->db->join('data_palawija d', 'dt.id_data_palawija=d.id');
            $query1 = $this->db->where('d.id_bulan', @$bulan_sebelumnyaa->id);
            $query1 = $this->db->where('d.tahun', $tahun);
            $query1 = $this->db->where('d.id_kecamatan', $id_kecamatan);
            $query1 = $this->db->where('dt.id_subkategori_palawija', $id_suburaian);
            $data_bukan_sawah_lalu = $this->data->get($select1, $tabel1, $query1)->result_array();

            $jumlah_bukan_sawah_lalu = 0;
            foreach ($data_bukan_sawah_lalu as $ds) {
                $jumlah_bukan_sawah_lalu = $jumlah_bukan_sawah_lalu + (($ds['bukan_panen'] - $ds['bukan_panen_muda'] - $ds['bukan_panen_ternak']) + ($ds['bukan_tanam'] - $ds['bukan_rusak']));
            }

            $total_bukan_sawah = ($dt['bukan_panen'] - $dt['bukan_panen_muda'] - $dt['bukan_panen_ternak']) +  ($dt['bukan_tanam'] -  $dt['bukan_rusak']);

            if ($jumlah_bukan_sawah_lalu > 0) {
                $total_bukan_sawah_sekarang = $jumlah_bukan_sawah_lalu - $total_bukan_sawah;
            } else {
                $total_bukan_sawah_sekarang = $total_bukan_sawah;
            }


            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom_uraian, $no_uraian++)
                ->setCellValue('B' . $kolom_uraian, $dt['suburaian'] . ',' . $dt['uraian'])
                ->setCellValue('C' . $kolom_uraian, $jumlah_sawah_lalu)
                ->setCellValue('D' . $kolom_uraian, $dt['sawah_panen'])
                ->setCellValue('E' . $kolom_uraian, $dt['sawah_panen_muda'])
                ->setCellValue('F' . $kolom_uraian, $dt['sawah_panen_ternak'])
                ->setCellValue('G' . $kolom_uraian, $dt['sawah_tanam'])
                ->setCellValue('H' . $kolom_uraian, $dt['sawah_rusak'])
                ->setCellValue('I' . $kolom_uraian, $total_sawah_sekarang)
                ->setCellValue('J' . $kolom_uraian, $jumlah_bukan_sawah_lalu)
                ->setCellValue('K' . $kolom_uraian, $dt['bukan_panen'])
                ->setCellValue('L' . $kolom_uraian, $dt['bukan_panen_muda'])
                ->setCellValue('M' . $kolom_uraian, $dt['bukan_panen_ternak'])
                ->setCellValue('N' . $kolom_uraian, $dt['bukan_tanam'])
                ->setCellValue('O' . $kolom_uraian, $dt['bukan_rusak'])
                ->setCellValue('P' . $kolom_uraian, $total_bukan_sawah_sekarang);

            $kolom_uraian++;
        }

        $kolom_uraian = $kolom_uraian + 2;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom_uraian, 'No')
            ->setCellValue('B' . $kolom_uraian, 'NIP')
            ->setCellValue('C' . $kolom_uraian, 'Nama Lengkap')
            ->setCellValue('D' . $kolom_uraian, 'Catatan')
            ->setCellValue('E' . $kolom_uraian, 'Status');

        $kolom_user = $kolom_uraian + 1;
        $no_user = 1;
        foreach ($user_palawija as $u) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom_user, $no_user++)
                ->setCellValue('B' . $kolom_user, $u['nip'])
                ->setCellValue('C' . $kolom_user, $u['nama_lengkap'])
                ->setCellValue('D' . $kolom_user, $u['catatan'])
                ->setCellValue('E' . $kolom_user, $u['status']);

            $kolom_user++;
        }

        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Export Data pelaporan_palawija.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function cetak($id, $id_bulan, $id_provinsi, $tahun)
    {
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

        $this->load->view('monitoring_palawija/cetak', $data);

        // $this->template->load('index', 'monitoring/detail', $data);
    }
}
