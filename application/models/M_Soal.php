<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal_model extends CI_Model
{


    public function getSoalById($id)
    {
        return $this->db->get_where('soal', ['id_soal' => $id])->row();
    }
}
