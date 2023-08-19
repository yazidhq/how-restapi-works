<?php

class Mahasiswa_model extends CI_Model
{
    public $table = 'mahasiswa';

    public function getMahasiswa($id = null)
    {
        if ($id === NULL) {
            return $this->db->get($this->table)->result_array();
        } else {
            return $this->db->get_where($this->table, ['id' => $id])->result_array();
        }
    }

    public function deleteMahasiswa($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createMahasiswa($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function updateMahasiswa($data, $id)
    {
        $this->db->update($this->table, $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
