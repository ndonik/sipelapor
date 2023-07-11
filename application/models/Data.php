<?php

class Data extends CI_Model
{

    public function get($select, $tabel, $query = null)
    {
        $query;
        $this->db->select($select);
        return $this->db->get($tabel);
    }

    public function add($tabel, $data)
    {
        return $this->db->insert($tabel, $data);
    }

    public function edit($id, $kolom, $tabel)
    {
        $this->db->where($kolom, $id);
        return $this->db->get($tabel);
    }

    public function update($id, $kolom, $tabel, $data)
    {
        $this->db->where($kolom, $id);
        return $this->db->update($tabel, $data);
    }

    public function delete($id, $kolom, $tabel)
    {
        $this->db->where($kolom, $id);
        return $this->db->delete($tabel);
    }
}
