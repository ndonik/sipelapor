<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $select = array('id', 'nip', 'nama_lengkap', 'jabatan', 'no_hp', 'username', 'email', 'status');
        $tabel = 'user';
        $query = $this->db->where('id!=', '1');
        $query = $this->db->order_by('level', 'ASC');

        if ($_SESSION['level'] != 'Admin') {
            $query = $this->db->where('level!=', 'Admin');
        }

        $data['user'] = $this->data->get($select, $tabel, $query)->result_array();

        $this->template->load('index', 'user/index', $data);
    }

    public function add()
    {
        $username = $this->input->post('username');
        $memail = strtolower($this->input->post('email'));
        $tabel = 'user';

        if ($this->cek_username($username, $tabel) == 0 && $this->cek_email($memail, $tabel) == 0) {

            $data['nip'] = $this->input->post('nip');
            $data['nama_lengkap'] = $this->input->post('nama_lengkap');
            $data['jabatan'] = $this->input->post('jabatan');
            $data['username'] = $username;
            $data['password'] = encrypt_pass($this->input->post('password'));
            $data['email'] = $memail;
            $data['no_hp'] = $this->input->post('no_hp');
            $data['level'] = $this->input->post('level');
            $data['status'] = 'Y';

            $result = $this->data->add($tabel, $data);
            if ($result) {
                $this->session->set_flashdata('alert', 'Ditambah');
                redirect('user');
            } else {
                $this->session->set_flashdata('alert', 'Gagal');
                redirect('user');
            }
        } else if ($this->cek_username($username, $tabel) != 0 && $this->cek_email($memail, $tabel) != 0) {
            $this->session->set_flashdata('alert', 'useremail');
            redirect('user');
        } else if ($this->cek_username($username, $tabel) != 0) {
            $this->session->set_flashdata('alert', 'username');
            redirect('user');
        } else {
            $this->session->set_flashdata('alert', 'email');
            redirect('user');
        }
    }

    public function cek_username($username, $tabel)
    {
        $select = array('id');
        $query = $this->db->where('username', $username);

        $hasil = $this->data->get($select, $tabel, $query)->num_rows();
        return $hasil;
    }

    public function cek_email($memail, $tabel)
    {
        $select = array('id');
        $query = $this->db->where('email', $memail);

        $hasil = $this->data->get($select, $tabel, $query)->num_rows();
        return $hasil;
    }

    public function cek_username_update($id, $username, $tabel)
    {
        $select = array('id');
        $query = $this->db->where('username', $username);
        $query = $this->db->where('id!=', $id);

        $hasil = $this->data->get($select, $tabel, $query)->num_rows();
        return $hasil;
    }

    public function cek_email_update($id, $memail, $tabel)
    {
        $select = array('id');
        $query = $this->db->where('email', $memail);
        $query = $this->db->where('id!=', $id);

        $hasil = $this->data->get($select, $tabel, $query)->num_rows();
        return $hasil;
    }

    public function delete($id)
    {
        $id = decrypt_url($id);

        $kolom = 'id';
        $tabel = 'user';

        $result = $this->data->delete($id, $kolom, $tabel);
        if ($result) {
            $this->session->set_flashdata('alert', 'Dihapus');
            redirect('user');
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('user');
        }
    }

    public function edit($id)
    {
        $id = decrypt_url($id);

        $data['header'] = 'master/table/header';
        $data['footer'] = 'master/table/footer';

        $kolom = 'id';
        $tabel = 'user';

        $data['user'] = $this->data->edit($id, $kolom, $tabel)->row();

        $this->template->load('index', 'user/edit', $data);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $memail = strtolower($this->input->post('email'));
        $tabel = 'user';

        if ($this->cek_username_update($id, $username, $tabel) == 0 && $this->cek_email_update($id, $memail, $tabel) == 0) {

            $data['nip'] = $this->input->post('nip');
            $data['nama_lengkap'] = $this->input->post('nama_lengkap');
            $data['jabatan'] = $this->input->post('jabatan');
            $data['username'] = $username;
            $data['email'] = $memail;
            $data['no_hp'] = $this->input->post('no_hp');
            $data['level'] = $this->input->post('level');
            $status = $this->input->post('status');

            if ($status) {
                $data['status'] = 'Y';
            } else {
                $data['status'] = 'N';
            }

            $kolom = 'id';

            $result = $this->data->update($id, $kolom, $tabel, $data);
            if ($result) {
                $this->session->set_flashdata('alert', 'Diubah');
                redirect('user');
            } else {
                $this->session->set_flashdata('alert', 'Gagal');
                redirect('user');
            }
        } else if ($this->cek_username_update($id, $username, $tabel) != 0 && $this->cek_email_update($id, $memail, $tabel) != 0) {
            $this->session->set_flashdata('alert', 'useremail');
            redirect('user');
        } else if ($this->cek_username_update($id, $username, $tabel) != 0) {
            $this->session->set_flashdata('alert', 'username');
            redirect('user');
        } else {
            $this->session->set_flashdata('alert', 'email');
            redirect('user');
        }
    }

    public function resetpassword($id)
    {
        $id = decrypt_url($id);

        $kolom1 = 'id';
        $tabel1 = 'user';

        $user = $this->data->edit($id, $kolom1, $tabel1)->row();

        $data['password'] = encrypt_pass($user->username);

        $kolom = 'id';
        $tabel = 'user';

        $result = $this->data->update($id, $kolom, $tabel, $data);

        if ($result) {
            $this->session->set_flashdata('alert', 'Reset Password');
            redirect('user');
        } else {
            $this->session->set_flashdata('alert', 'Gagal');
            redirect('user');
        }
    }
}
