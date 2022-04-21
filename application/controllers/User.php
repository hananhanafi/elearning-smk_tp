<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->session->set_flashdata('not-login', 'Gagal!');
        // if (!$this->session->userdata('email')) {
        //     redirect('welcome');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('user/index');
        $this->load->view('template/footer');
    }

    public function quiz()
    {

        $data['user'] = $this->db->get_where('siswa', ['email' =>
        $this->session->userdata('email')])->row_array();
        
        $token = $this->input->post('token');
        $this->load->model('m_quiz');
        $quiz = $this->m_quiz->detail_quiz_by_token($token);

        if($quiz==NULL){
            $this->session->set_flashdata('quiz-notfound', 'gagal');
            $this->load->view('user/index');
            $this->load->view('template/footer');
            return;
        }

        $data['quiz'] = $quiz;
        
        $this->load->model('m_question');
        $questions = $this->m_question->get_question_by_quiz_id($quiz->id)->result();
        $data['questions'] = $questions;
        $countQuestions = count($questions);

        if($countQuestions>0){
            $this->load->view('user/quiz', $data);
            $this->load->view('template/footer');
        }else{
            $this->load->view('user/index');
            $this->load->view('template/footer');
        }
    }
    
    public function submit_quiz()
    {
        $this->load->model('m_question');
        $user_id = $this->session->userdata('id');
        $quiz_id = $this->input->post('quiz_id');
        $ids = $this->input->post('ids');

        $totalQuestion = count($ids);
        $totalRightAnswer = 0;

        foreach($ids as $id){
            $answer_key = $this->input->post('answer_key_'.$id);
            $response = $this->input->post('response_'.$id);

            $isResponseRight = false;
            if($response == $answer_key){
                $isResponseRight = true;
                $totalRightAnswer++;
            }
                
            $data = array(
                'siswa_id' => $user_id,
                'quiz_id' => $quiz_id,
                'question_id' => $id,
                'response' => $response,
                'point' => $isResponseRight
            );
            
            $this->db->insert('siswa_quiz_responses', $data);
        }

        $result = ($totalRightAnswer/$totalQuestion)*100;

        // input quiz result
        $data = array(
            'siswa_id' => $user_id,
            'quiz_id' => $quiz_id,
            'jumlah_soal' => $totalQuestion,
            'jumlah_benar' => $totalRightAnswer,
            'result' => $result
        );
        $this->db->insert('siswa_quiz', $data);

        $this->session->set_flashdata('success-submit_quiz', 'berhasil');
        $this->load->view('user/index');
        $this->load->view('template/footer');
    }

    public function kelasfotografi()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('user/kelasfotografi');
        $this->load->view('template/footer');
    }

    public function registration()
    {
        $this->load->view('user/registration');
        $this->load->view('template/footer');
    }

    public function registration_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom username.',
            'min_length' => 'Nama terlalu pendek.',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[siswa.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[retype_password]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('retype_password', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/nav');
            $this->load->view('user/registration');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'date_created' => time(),
            ];

            //siapkan token

            // $token = base64_encode(random_bytes(32));
            // $user_token = [
            //     'email' => $email,
            //     'token' => $token,
            //     'date_created' => time(),
            // ];

            $this->db->insert('siswa', $data);
            // $this->db->insert('token', $user_token);

            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('welcome'));
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'ini email disini',
            'smtp_pass' => 'Isi Password gmail disini',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);

        $data = array(
            'name' => 'syauqi',
            'link' => ' ' . base_url() . 'welcome/verify?email=' . $this->input->post('email') . '& token' . urlencode($token) . '"',
        );

        $this->email->from('LearnifyEducations@gmail.com', 'Learnify');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $link =
                $this->email->subject('Verifikasi Akun');
            $body = $this->load->view('template/email-template.php', $data, true);
            $this->email->message($body);
        } else {
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die();
        }
    }
}
