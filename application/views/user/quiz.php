<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <!-- Title -->
    <title>Quiz</title>
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
    <!-- <div class="container">
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
    </div> -->
    <!-- End Greetings Card -->


    <br>
    
    <div class="container-fluid">
            <!-- begin:: Content -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid my-5" id="kt_content">
                <div class="row card-body">
                    <div class="col-12">
                        <h2 class="card-title" style="color: black;"><?=$quiz->nama_quiz?></h2>
                        <p><?=$quiz->deskripsi_quiz?></p>
                    </div>
                    <div class="col-md-12">
                        <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                            <form method="post" enctype="multipart/form-data" action="<?= base_url('user/submit_quiz') ?>">
                                <input type="hidden" name="quiz_id" value="<?=$quiz->id?>">
                                <?php
                                $i = 0;
                                foreach ($questions as $q) {
                                $i++;
                                ?>

                                <input type="hidden" name="ids[]" value="<?=$q->id?>">
                                <input type="hidden" name="answer_key_<?=$q->id?>" value="<?=$q->answer_key?>">
                                <h5 style="color:black">
                                    <?=$i?>. <?=$q->question?>
                                </h5>
                                <?php if($q->question_file) : ?>
                                    <div>
                                        <img id="question_img" class="img-fluid border" style="max-width:600px;max-height:400px" src="<?= base_url('assets/') ?>upload/soal/<?=$q->question_file?>" alt="" />
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <?php
                                    $abjad = ['a', 'b', 'c', 'd', 'e'];
                                    foreach ($abjad as $abj) :
                                        $ABJ = strtoupper($abj); // Abjad Kapital
                                        $answer_text = 'answer_'.$abj;
                                        $answer = $q->{$answer_text};
                                    ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input required type="radio" class="form-check-input" value="<?= $ABJ; ?>" name="response_<?=$q->id?>"><?= $ABJ; ?>.&nbsp;<?=$answer?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <?php
                                }
                                ?>

                                <a href="<?php echo site_url('user'); ?>" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Start Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    </script>
    <!-- End Animate On Scroll -->