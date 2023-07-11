<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Monitoring extends CI_Controller
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

        $this->template->load('index', 'monitoring/index', $data);
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

        $this->template->load('index', 'monitoring/index', $data);
    }

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

        $this->template->load('index', 'monitoring/detail', $data);
    }

    public function export($id, $id_bulan, $id_provinsi, $tahun)
    {
        $id = decrypt_url($id);
        $id_bulan = decrypt_url($id_bulan);
        $id_provinsi = decrypt_url($id_provinsi);
        $tahun = decrypt_url($tahun);

        $kolom = 'id';
        $tabel = 'data_padi';
        $data_padi = $this->data->edit($id, $kolom, $tabel)->row();

        $select1 = array('d.id', 'd.*', 'k.uraian', 's.uraian suburaian', 's.id id_suburaian');
        $tabel1 = 'detail_padi d';
        $query1 = $this->db->join('kategori_padi k', 'd.id_kategori_padi=k.id');
        $query1 = $this->db->join('subkategori_padi s', 'd.id_subkategori_padi=s.id');
        $query1 = $this->db->where('d.id_data_padi', $id);
        $query1 = $this->db->order_by('k.id,s.id', 'ASC');
        $detail_padi = $this->data->get($select1, $tabel1, $query1)->result_array();

        $select2 = array('u.id', 'u.catatan', 'u.status', 's.nama_lengkap', 's.nip', 'u.update_at');
        $tabel2 = 'user_padi u';
        $query2 = $this->db->join('user s', 'u.id_user=s.id');
        $query2 = $this->db->where('u.id_data_padi', $id);
        $query2 = $this->db->order_by('s.nama_lengkap', 'ASC');
        $user_padi = $this->data->get($select2, $tabel2, $query2)->result_array();

        $tabel3 = 'bulan';
        $bulan = $this->data->edit($data_padi->id_bulan, $kolom, $tabel3)->row();

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
            ->setCellValue('A' . $kolom_data, $data_padi->nomor)
            ->setCellValue('B' . $kolom_data, wilayah('provinsi', $data_padi->id_provinsi))
            ->setCellValue('C' . $kolom_data, wilayah('kabupaten', $data_padi->id_kabupaten))
            ->setCellValue('D' . $kolom_data, wilayah('kecamatan', $data_padi->id_kecamatan))
            ->setCellValue('E' . $kolom_data, $bulan->bulan)
            ->setCellValue('F' . $kolom_data, $data_padi->tahun)
            ->setCellValue('G' . $kolom_data, $data_padi->status_verifikasi);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A5', 'No')
            ->mergeCells('A5:A6')
            ->setCellValue('B5', 'Uraian')
            ->mergeCells('B5:B6')
            ->setCellValue('C5', 'Lahan Sawah')
            ->mergeCells('C5:D5:E5:F5:G5')
            ->setCellValue('C6', 'Tanaman Akhir Bulan Yang Lalu')
            ->setCellValue('D6', 'Panen')
            ->setCellValue('E6', 'Tanam')
            ->setCellValue('F6', 'Puso/rusak')
            ->setCellValue('G6', 'Tanaman Akhir Bulan Laporan')
            ->setCellValue('H5', 'Lahan Bukan Sawah')
            ->mergeCells('H5:I5:J5:K5:L5')
            ->setCellValue('H6', 'Tanaman Akhir Bulan Yang Lalu')
            ->setCellValue('I6', 'Panen')
            ->setCellValue('J6', 'Tanam')
            ->setCellValue('K6', 'Puso/rusak')
            ->setCellValue('L6', 'Tanaman Akhir Bulan Laporan');

        $kolom_uraian = 7;
        $no_uraian = 1;
        foreach ($detail_padi as $dt) {

            $id_suburaian = $dt['id_suburaian'];

            $id_bulan = $bulan->id - 1;

            $this->db->where('id', $id_bulan);
            $bulan_sebelumnyaa = $this->db->get('bulan')->row();

            $tahun = $tahun;
            $id_kecamatan = $data_padi->id_kecamatan;

            $this->load->model('error/data');

            $select = array('sawah_panen', 'sawah_tanam', 'sawah_rusak');
            $tabel = 'detail_padi dt';
            $query = $this->db->join('data_padi d', 'dt.id_data_padi=d.id');
            $query = $this->db->where('d.id_bulan', @$bulan_sebelumnyaa->id);
            $query = $this->db->where('d.tahun', $tahun);
            $query = $this->db->where('d.id_kecamatan', $id_kecamatan);
            $query = $this->db->where('dt.id_subkategori_padi', $id_suburaian);
            $data_sawah_lalu = $this->data->get($select, $tabel, $query)->result_array();

            $jumlah_sawah_lalu = 0;
            foreach ($data_sawah_lalu as $ds) {
                $jumlah_sawah_lalu = $jumlah_sawah_lalu + ($ds['sawah_paneh'] + ($ds['sawah_tanam'] - $ds['sawah_rusak']));
            }

            $select1 = array('bukan_panen', 'bukan_tanam', 'bukan_rusak');
            $tabel1 = 'detail_padi dt';
            $query1 = $this->db->join('data_padi d', 'dt.id_data_padi=d.id');
            $query1 = $this->db->where('d.id_bulan', @$bulan_sebelumnyaa->id);
            $query1 = $this->db->where('d.tahun', $tahun);
            $query1 = $this->db->where('d.id_kecamatan', $id_kecamatan);
            $query1 = $this->db->where('dt.id_subkategori_padi', $id_suburaian);
            $data_bukan_sawah_lalu = $this->data->get($select1, $tabel1, $query1)->result_array();

            $jumlah_bukan_sawah_lalu = 0;
            foreach ($data_bukan_sawah_lalu as $ds) {
                $jumlah_bukan_sawah_lalu = $jumlah_bukan_sawah_lalu + ($ds['bukan_panen'] + ($ds['bukan_tanam'] - $ds['bukan_rusak']));
            }

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom_uraian, $no_uraian++)
                ->setCellValue('B' . $kolom_uraian, $dt['suburaian'] . ',' . $dt['uraian'])
                ->setCellValue('C' . $kolom_uraian, $jumlah_sawah_lalu)
                ->setCellValue('D' . $kolom_uraian, $dt['sawah_panen'])
                ->setCellValue('E' . $kolom_uraian, $dt['sawah_tanam'])
                ->setCellValue('F' . $kolom_uraian, $dt['sawah_rusak'])
                ->setCellValue('G' . $kolom_uraian, $dt['sawah_panen'] + $dt['sawah_tanam'] + $dt['sawah_rusak'])
                ->setCellValue('H' . $kolom_uraian, $jumlah_bukan_sawah_lalu)
                ->setCellValue('I' . $kolom_uraian, $dt['bukan_panen'])
                ->setCellValue('J' . $kolom_uraian, $dt['bukan_tanam'])
                ->setCellValue('K' . $kolom_uraian, $dt['bukan_rusak'])
                ->setCellValue('L' . $kolom_uraian, $dt['bukan_panen'] + $dt['bukan_tanam'] + $dt['bukan_rusak']);

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
        foreach ($user_padi as $u) {

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
        header('Content-Disposition: attachment;filename="Export Data Pelaporan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function cetak($id, $id_bulan, $id_provinsi, $tahun)
    {
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

        $this->load->view('monitoring/cetak', $data);
    }
}
