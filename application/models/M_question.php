<?php

class M_question extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('questions');
    }
    public function get_question_by_quiz_id($quiz_id=null)
    {
        $query = $this->db->get_where('questions', array('quiz_id' => $quiz_id));
        return $query;
    }
    
    public function detail_question($id = null)
    {
        $query = $this->db->get_where('questions', array('id' => $id));
        return $query;
    }

    public function delete_question($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_question($where, $table)
    {
        return $this->db->get_where($table, $where)->row();
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
