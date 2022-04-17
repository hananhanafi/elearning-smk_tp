<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function belajar($id)
    {
        $this->load->library('disqus');

        $this->load->model('m_materi');
        $where = array('id' => $id);
        $detail = $this->m_materi->belajar($id);
        $data['detail'] = $detail;
        $data['disqus'] = $this->disqus->get_html();
        $this->load->view('materi/belajar', $data);
    }

    public function fotografi()
    {
        $this->load->model('m_materi');
        $data['materi'] = $this->m_materi->fotografi()->result();
        $data['user'] = $this->db->get_where('siswa', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('materi/fotografi', $data);
        $this->load->view('template/footer');
    }
}
