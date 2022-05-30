<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <!-- Title -->
    <title>Selamat datang - <?php
                            $data['user'] = $this->db->get_where('siswa', ['email' =>
                            $this->session->userdata('email')])->row_array();
                            echo $data['user']['nama'];
                            ?> Student Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/popup/magnific-popup.css">
    <!-- Main css -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/user_style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>

</head>

<body style="overflow-x:hidden;background-color:#fbf9fa">


    <!-- Start Navigation Bar -->
    <header class="header_area" style="background-color: white !important;">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a href="<?= base_url('user') ?>" style="font-size: 19px;font-weight:900;font-family: 'Poppins', sans-serif;" class="text-success text-center">SMK TANJUNG PRIOK</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item "><a class="nav-link" href="javascript:void(0)">Hai, <?php
                                                                                                        $data['user'] = $this->db->get_where('siswa', ['email' =>
                                                                                                        $this->session->userdata('email')])->row_array();
                                                                                                        echo $data['user']['nama'];
                                                                                                        ?></a>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="<?= base_url('user') ?>">Beranda</a>
                            </li>
                            <li class=" nav-item "><a class=" nav-link text-danger" href="<?= base_url('welcome/logout') ?>">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Navigation Bar -->


    <!-- Start Greetings Card -->
    <div class="container">
        <div class="bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
            <div class="row" style="color: black; font-family: 'poppins';">
                <div class="col-md-12 mt-1">
                    <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Selamat Datang
                        <span style="font-size: 40px;">👋🏻
                        </span>
                    </h1>
                    <p>Hello Students! , Ini merupakan halaman pembelajaran fotografi SMK TANJUNG PRIOK ! Silahkan pilih kelas yang ingin kamu pelajari. Selamat belajar !!!</p>
                    <hr>
                    <h4 style="line-height: 4px;" data-aos="fade-down" data-aos-duration="1700"><?php
                                                                                                $data['user'] = $this->db->get_where('siswa', ['email' =>
                                                                                                $this->session->userdata('email')])->row_array();
                                                                                                echo $data['user']['nama'];
                                                                                                ?> Students</h3>
                        <p data-aos="fade-down" data-aos-duration="1800">Silahkan pilih kelas yang akan kamu akses
                            dibawah
                            ini!
                        </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Greetings Card -->


    <br>


    <!-- Start Class Card -->
    <div class="container">
        <div class="row mt-4 mb-5 justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-4 mb-2 d-flex justify-content-center" data-aos-duration="1900" data-aos="fade-left">
                        <a href="<?= base_url('user/kelasfotografi') ?>">
                            <div class="card-kelas">
                                <span style="position:absolute;bottom:-24px">Pelajaran</span>
                                <img src="<?= base_url('assets/') ?>img/Fotografi.png" class="card-img-top" alt="...">
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-2 d-flex justify-content-center" data-aos-duration="1900" data-aos="fade-left">
                        <a class="w-100" data-target="#ModalQuiz">
                            <div class="card-kelas card h-100" style="border-radius:2px!important">
                                <h1 class="my-auto text-primary">
                                    Quiz
                                </h1>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Class Card -->


    <br>
    <div class="modal fade" id="ModalQuiz" tabindex="-1" role="dialog" aria-labelledby="ModalQuizTitle" 
    >
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-dark font-weight-bold" style="color:#212529 !important;" id="ModalQuizTitle">
                        Quiz</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <br>
                        <div class="row">
                            <div class=" col-12">
                                <form action="<?= base_url('user/quiz/') ?>" method="post">
                                    <div class="form-group">
                                        <label class="label-font" for="token">Token</label>
                                        <input required type="text" value="" class="form-control" name="token" autocomplete="off" id="token" placeholder="Masukan token disini ..">
                                        <small class="text-danger"></small>
                                    </div>
                                    <button class="btn btn-block font-weight-bold" style="background-color: #4dbf1c;color:white;font-size:18px;">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Sweetalert Flashdata -->

    <?php if ($this->session->flashdata('quiz-notfound')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Token Salah!',
                text: 'Silahkan Cek kembali token',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success-submit_quiz')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Berhasil submit quiz',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    <?php endif; ?>

    <style>
        .show-modal {
            padding-right: 17px; display: block;
            background: rgba(0, 0, 0, .5);
        }
    </style>
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Start Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        $("a[data-target='#ModalQuiz']").click(function(){
            $('#ModalQuiz').addClass('show');
            $('#ModalQuiz').addClass('show-modal');
        })
        $('#ModalQuiz').find('button[data-dismiss="modal"]').click(function() {
            $('#ModalQuiz').removeClass('show');
            $('#ModalQuiz').removeClass('show-modal');
        })
    </script>
    <!-- End Animate On Scroll -->