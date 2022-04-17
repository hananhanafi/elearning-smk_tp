<?php

class M_test extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('tests');
    }

    public function detail_test($id = null)
    {
        $query = $this->db->get_where('tests', array('id' => $id))->row();
        return $query;
    }

    public function delete_test($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_test($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
