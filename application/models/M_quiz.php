<?php

class M_quiz extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('quiz');
    }
    public function tampil_data_by_guru($nip_guru = null)
    {
        $query = $this->db->get_where('quiz', array('nip_guru' => $nip_guru));
        return $query;
    }
    
    public function tampil_hasil($quiz_id = null)
    {
        $query = $this->db->get_where('siswa_quiz', array('quiz_id' => $quiz_id));
        return $query;
    }


    public function detail_quiz($id = null)
    {
        $query = $this->db->get_where('quiz', array('id' => $id))->row();
        return $query;
    }
    public function detail_quiz_by_token($token = null)
    {
        $query = $this->db->get_where('quiz', array('token' => $token))->row();
        return $query;
    }

    public function delete_quiz($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_quiz($where, $table)
    {
        return $this->db->get_where($table, $where)->row();
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
