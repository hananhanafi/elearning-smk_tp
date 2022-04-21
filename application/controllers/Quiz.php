<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quiz extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('welcome/guru');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('quiz/index');
    }

    // manajemen quiz

    public function data_quiz()
    {
        $this->load->model('m_quiz');
        $data['user'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['quiz'] = $this->m_quiz->tampil_data_by_guru($data['user']['nip'])->result();
        $this->load->view('guru/quiz/data_quiz', $data);
    }
    
    public function add()
    {
        $this->form_validation->set_rules('nama_quiz', 'Nama Quiz', 'required', [
            'required' => 'Harap isi kolom Nama Quiz.',
        ]);
        $this->form_validation->set_rules('deskripsi_quiz', 'Deskripsi Quiz', 'required', [
            'required' => 'Harap isi kolom Deskripsi Quiz.',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('guru/quiz/add_quiz');
        } else {
            $token = $this->getRandomString(6);
            $data = [
                'nip_guru' => htmlspecialchars($this->session->userdata('nip')),
                'jumlah_soal' => htmlspecialchars($this->input->post('jumlah_soal', true)),
                'nama_quiz' => htmlspecialchars($this->input->post('nama_quiz', true)),
                'deskripsi_quiz' => htmlspecialchars($this->input->post('deskripsi_quiz', true)),
                'token' => $token,
            ];

            $this->db->insert('quiz', $data);

            $this->session->set_flashdata('success-add', 'berhasil');
            redirect('quiz/data_quiz');
        }
    }

    function getRandomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
      
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
      
        return $randomString;
    }

    public function detail_quiz($id)
    {
        $this->load->model('m_quiz');
        $detail = $this->m_quiz->detail_quiz($id);
        $data['detail'] = $detail;
        $this->load->view('guru/quiz/detail_quiz', $data);
    }

    public function update_quiz($id)
    {
        $this->load->model('m_quiz');
        $where = array('id' => $id);
        $data['quiz'] = $this->m_quiz->update_quiz($where, 'quiz');
        $this->load->view('guru/quiz/update_quiz', $data);
    }

    public function quiz_edit()
    {
        $this->load->model('m_quiz');
        $id = $this->input->post('id');
        $nama_quiz = $this->input->post('nama_quiz');
        $jumlah_soal = $this->input->post('jumlah_soal');
        $deskripsi_quiz = $this->input->post('deskripsi_quiz');

        $data = array(
            'nama_quiz' => $nama_quiz,
            'jumlah_soal' => $jumlah_soal,
            'deskripsi_quiz' => $deskripsi_quiz,
        );

        $where = array(
            'id' => $id,
        );

        $this->m_quiz->update_data($where, $data, 'quiz');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('quiz/data_quiz');
    }
    
    public function delete_quiz($id)
    {
        $this->load->model('m_quiz');
        $where = array('id' => $id);
        $this->m_quiz->delete_quiz($where, 'quiz');
        $this->session->set_flashdata('success-delete', 'berhasil');
        redirect('quiz/data_quiz');
    }

    
    public function daftar_soal($id)
    {
        $this->load->model('m_quiz');
        $quiz = $this->m_quiz->detail_quiz($id);
        $data['quiz'] = $quiz;
        
        $this->load->model('m_question');

        $data['user'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['questions'] = $this->m_question->get_question_by_quiz_id($id)->result();

        $this->load->view('guru/quiz/data_soal', $data);
    }

    
    public function add_soal($quiz_id)
    {
        $this->form_validation->set_rules('question', 'Soal', 'required', [
            'required' => 'Harap isi kolom Soal.',
        ]);

        $this->load->model('m_quiz');
        $quiz = $this->m_quiz->detail_quiz($quiz_id);
        $data['quiz'] = $quiz;

        if ($this->form_validation->run() == false) {
            $this->load->view('guru/quiz/add_soal', $data);
        } else {
            $quiz_id = $this->input->post('quiz_id', true);
            $dataQuestion = [
                'quiz_id' => htmlspecialchars($this->input->post('quiz_id', true)),
                'question' => htmlspecialchars($this->input->post('question', true)),
                'point' => 1,
                'answer_a' => htmlspecialchars($this->input->post('answer_a', true)),
                'answer_b' => htmlspecialchars($this->input->post('answer_b', true)),
                'answer_c' => htmlspecialchars($this->input->post('answer_c', true)),
                'answer_d' => htmlspecialchars($this->input->post('answer_d', true)),
                'answer_e' => htmlspecialchars($this->input->post('answer_e', true)),
                'answer_key' => htmlspecialchars($this->input->post('answer_key', true)),
            ];
            
            
            // $gambarSoal = $_FILES['question_img']['name'];
            $file_name = 'soal_'.$quiz_id;
            $config['file_name'] = $file_name;
            $config['allowed_types'] = 'jpg|png|gif|jfif';
            // $config['max_size'] = '4096';
            $config['upload_path'] = './assets/upload/soal';
            $config['overwrite'] = true;
            // $config['upload_path']          = FCPATH.'/upload/soal/';
            // $config['allowed_types']        = 'gif|jpg|jpeg|png';
            // $config['max_size']             = 1024; // 1MB
            // $config['max_width']            = 1080;
            // $config['max_height']           = 1080;

            $this->load->library('upload', $config);  
            if ($this->upload->do_upload('question_img')) {
                $gambarBaru = $this->upload->data('file_name');
                $dataQuestion['question_file'] = $gambarBaru;
            } else {
                echo $this->upload->display_errors();
                // $this->session->set_flashdata('failed-add', 'gagal');
                // redirect('quiz/daftar_soal/'.$quiz_id);
            }
    
            $this->db->insert('questions', $dataQuestion);

            // update jumlah soal quiz
            $this->load->model('m_quiz');
            $detail = $this->m_quiz->detail_quiz($quiz_id);
            $newCount = $detail->jumlah_soal + 1;
            $data = array(
                'jumlah_soal' => $newCount,
            );
            $where = array(
                'id' => $quiz_id,
            );
            $this->m_quiz->update_data($where, $data, 'quiz');

            $this->session->set_flashdata('success-add', 'berhasil');
            redirect('quiz/daftar_soal/'.$quiz_id);
        }
    }

    public function update_soal($quiz_id,$id)
    {
        
        $this->load->model('m_quiz');
        $quiz = $this->m_quiz->detail_quiz($quiz_id);
        $data['quiz'] = $quiz;

        $this->load->model('m_question');
        $where = array('id' => $id);
        $data['question'] = $this->m_question->update_question($where, 'questions');

        $this->load->view('guru/quiz/update_soal', $data);
    }

    public function soal_edit()
    {
        $this->load->model('m_question');
        $id = $this->input->post('id');
        $quiz_id = $this->input->post('quiz_id');
        // $nama_quiz = $this->input->post('nama_quiz');
        // $jumlah_soal = $this->input->post('jumlah_soal');
        // $deskripsi_quiz = $this->input->post('deskripsi_quiz');

        // $data = array(
        //     'nama_quiz' => $nama_quiz,
        //     'jumlah_soal' => $jumlah_soal,
        //     'deskripsi_quiz' => $deskripsi_quiz,
        // );

        $dataQuestion = [
            'question' => htmlspecialchars($this->input->post('question', true)),
            'point' => 1,
            'answer_a' => htmlspecialchars($this->input->post('answer_a', true)),
            'answer_b' => htmlspecialchars($this->input->post('answer_b', true)),
            'answer_c' => htmlspecialchars($this->input->post('answer_c', true)),
            'answer_d' => htmlspecialchars($this->input->post('answer_d', true)),
            'answer_e' => htmlspecialchars($this->input->post('answer_e', true)),
            'answer_key' => htmlspecialchars($this->input->post('answer_key', true)),
        ];
        $where = array(
            'id' => $id,
        );
        $file_name = 'soal_'.$quiz_id;
        $config['file_name'] = $file_name;
        $config['allowed_types'] = 'jpg|png|gif|jfif';
        $config['upload_path'] = './assets/upload/soal';
        $config['overwrite'] = true;

        $this->load->library('upload', $config);  
        if ($this->upload->do_upload('question_img')) {
            $gambarBaru = $this->upload->data('file_name');
            $dataQuestion['question_file'] = $gambarBaru;
        } else {
            echo $this->upload->display_errors();
        }

        $this->m_question->update_data($where, $dataQuestion, 'questions');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('quiz/daftar_soal/'.$quiz_id);
    }
    
    public function delete_soal($quiz_id, $id)
    {


        $this->load->model('m_question');
        $where = array('id' => $id);
        $this->m_question->delete_question($where, 'questions');
        $this->session->set_flashdata('user-delete', 'berhasil');

        
        // update jumlah soal quiz
        $this->load->model('m_quiz');
        $detail = $this->m_quiz->detail_quiz($quiz_id);
        $newCount = $detail->jumlah_soal - 1;
        $data = array(
            'jumlah_soal' => $newCount,
        );
        $where = array(
            'id' => $quiz_id,
        );
        $this->m_quiz->update_data($where, $data, 'quiz');

        $this->session->set_flashdata('success-delete', 'berhasil');
        redirect('quiz/daftar_soal/'.$quiz_id);
    }

    
    public function hasil_quiz($quiz_id)
    {
        $this->load->model('m_siswa');
        $this->load->model('m_quiz');
        $data['user'] = $this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['quiz'] = $this->m_quiz->detail_quiz($quiz_id);

        $siswa_arr = []; 
        $hasil = $this->m_quiz->tampil_hasil($quiz_id)->result();
        foreach ($hasil as $key => $value) {
            $siswa = $this->m_siswa->detail_siswa($value->siswa_id);
            $siswa_arr[$key] = $siswa;
        
        }
        $data['hasil'] = $hasil;
        $data['siswa'] = $siswa_arr;


        $this->load->view('guru/quiz/hasil_quiz', $data);
    }
    
}
