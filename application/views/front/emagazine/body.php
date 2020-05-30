<?php $this->load->view('front/emagazine/header'); ?>

<?php $this->load->view('front/navbar'); ?>

<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="<?php echo base_url('emagazine/arsip') ?>">Emagazine</a></li>
        <li class="active"><?php echo $emagazine->judul_emag ?></li>
    </ol>

    <p><?php echo validation_errors(); ?></p>

    <div class="row">
        <div class="col-md-8">
            <div class="bs-callout bs-callout-primary">
                <h4><i class="fa fa-pencil"></i> <?php echo $emagazine->judul_emag ?></h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="thumbnail">
                        <?php
                        if (empty($emagazine->userfile)) {
                            echo "<img src='" . base_url() . "assets/images/no_image_thumb.png' width='400' height='200'>";
                        } else {
                            echo " <img src='" . base_url() . "assets/images/emag/" . $emagazine->userfile . $emagazine->userfile_type . "' alt='$emagazine->userfile' title='$emagazine->userfile'> ";
                        }
                        ?>
                        <div align="right">
                            <span class="label label-success"><i class="fa fa-tag"></i> <?php echo $emagazine->kategori ?></span>
                            <span class="label label-warning"><i class="fa fa-user"></i> <?php echo $emagazine->author ?></span>
                            <span class="label label-info"><i class="fa fa-clock-o"></i> <?php echo $emagazine->time_upload ?></span>
                        </div>
                        <div style="text-align: justify;">
                            <p><?php echo $emagazine->isi_link ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bs-callout bs-callout-danger">
                <h4><i class="fa fa-comments"></i> Komentar</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if ($get_komentar == NULL) {
                        echo "Belum ada komentar";
                    } else {
                        foreach ($get_komentar as $komen) {
                    ?>
                            <b><?php echo $komen->nama ?></b>, berkata:
                            <p>" <?php echo $komen->isi_komentar ?> "</p>
                            <p align="right">pada <?php echo $komen->time_upload ?></p>
                    <?php }
                    } ?>32
                </div>
            </div>

            <hr>

            <div class="bs-callout bs-callout-success">
                <h4><i class="fa fa-pencil"></i> Tulis Komentar Anda</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "Silahkan login terlebih dahulu";
                    } else {
                    ?>
                        <?php echo form_open("emagazine/komen/" . $emagazine->judul_seo . "", array('class' => 'form-horizontal')); ?>
                        <input type="hidden" class="form-control" name="id_emag" value="<?php echo $emagazine->id_emag ?>">
                        <div class="box-body">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Komentar Anda</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="isi_komentar"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Captcha</label>
                                    <div class="col-lg-10">
                                        <div><?php echo $cap_img; ?></div>
                                        <input type="text" class="form-control" name="kode_captcha" placeholder="isikan captcha diatas">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="reset" class="btn btn-default">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <?php echo form_close(); ?>
                    <?php } ?>
                </div>
            </div>

            <hr>

            <div class="bs-callout bs-callout-warning">
                <h4><i class="fa fa-fire"></i> Emagazine Lainnya</h4>
            </div>
            <?php
            foreach ($get_all_random as $post_random) {
                $caption = character_limiter($post_random->isi_link, 175);
            ?>
                <div class="col-sm-6 col-md-6">
                    <div class="thumbnail" style="height:465px;">
                        <?php
                        if (empty($post_random->userfile)) {
                            echo "<img src='" . base_url() . "assets/images/no_image_thumb.png' width='400' height='200'>";
                        } else {
                            echo " <img src='" . base_url() . "assets/images/emag/" . $post_random->userfile . '_thumb' . $post_random->userfile_type . "'> ";
                        }
                        ?>
                        <div align="right">
                            <span class="label label-success"><i class="fa fa-tag"></i> <?php echo $post_random->kategori ?></span>
                            <span class="label label-warning"><i class="fa fa-user"></i> <?php echo $post_random->author ?></span>
                            <span class="label label-info"><i class="fa fa-clock-o"></i> <?php echo $post_random->time_upload ?></span>
                        </div>
                        <div class="caption">
                            <h4><a href="<?php echo base_url("emagazine/read/$post_random->judul_seo ") ?>"><?php echo $post_random->judul_emag ?></a></h4>
                            <div style="text-align: justify;"><?php echo $caption ?></div>
                        </div>
                        <div style="position: absolute;bottom: 30px;right: 20px;">
                            <a href="<?php echo base_url("emagazine/read/$post_random->judul_seo ") ?>">
                                <button type="button" class="btn-sm btn-primary">
                                    Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <hr>

        </div>

        <?php $this->load->view('front/sidebar'); ?>

        <?php $this->load->view('front/footer'); ?>