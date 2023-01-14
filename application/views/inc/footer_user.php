<div id="background" class="">
  <div id="loading" class="text-center"></div>
</div>

<!-- <div class="fixed-action-btn" style="bottom: 0px; right: 0px;">
  <div class="text-center">
    <a target="_blank" href="https://api.whatsapp.com/send?phone=6281905855754&text=Pertanyaan..." class="btn-rounded waves-effect border green darken-1 white-text btn-block p-3"><i class="fab fa-lg fa-whatsapp"></i>&nbsp;&nbsp; Hubungi Kami</a>
  </div>
</div>
<div class="fixed-action-btn" style="bottom:65px; right: 0px;">
  <div class="text-center" style="width: 165px;">
    <a target="_blank" href="https://api.whatsapp.com/send?phone=6281905855754&text=...سؤال" class="btn-rounded waves-effect border green lighten-1 white-text btn-block  p-3"><i class="fab fa-lg fa-whatsapp"></i>&nbsp;&nbsp; اتصل بنا</a>
  </div>
</div> -->
<div class="fixed-action-btn d-flex" style="bottom: 0px; right: 0px;">
  <a class="btn-floating btn-lg green">
    <i class="fab fa-whatsapp"></i>
  </a>

  <ul class="list-unstyled">
    <li>
      <a style="opacity:0;" class="btn-floating"></a>
    </li>
    <li>
      <a style="opacity:0;" class="btn-floating"></a>
    <li>
      <div class="t">
        <a target="_blank" href="https://api.whatsapp.com/send?phone=6282123107344&text=•	Terima kasih telah menghubungi AZKA MANDIRI UMRAH, Silahkan beri tahu apa yang dapat kami bantu?" class="btn-rounded waves-effect border green darken-1 white-text btn-block p-3"> Indonesia </a>
      </div>
    </li>
    <li>
      <div class="t">
        <a target="_blank" href="https://api.whatsapp.com/send?phone=6282123107342&text=•	شكرآ لإتصالكم لمكتبنا أزكا منديري للعمرة,للإستفسار او المساعدة الرجاء الإتصال عن طريق الواتس " class="btn-rounded waves-effect border green lighten-1 white-text btn-block p-3 font-weight-bolder h5-responsive"><strong>&nbsp;&nbsp; عربى &nbsp;&nbsp;</strong></a>
        <!-- <a target="_blank" href="https://api.whatsapp.com/send?phone=6281905855754&text=...سؤال" class="btn-rounded waves-effect border green lighten-1 white-text btn-block  p-3"> اتصل بنا</a> -->
      </div>
    </li>
  </ul>
</div>
<?php
if ($this->uri->segment(1) == NULL) { ?>

  <style>
    footer.page-footer .footer-copyright {
      background-color: rgba(0, 0, 0, 0);
    }

    #id_footer {
      background-color: rgba(0, 0, 0, 0);
    }
  </style>


<?php } ?>
<!-- Footer -->
<footer class="page-footer font-small elegant-color pt-4">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 mt-md-0 mt-3">

        <!-- Links -->
        <h5 class="text-uppercase">Menu Utama</h5>
        <hr class="border-bottom border-danger my-2">
        <ul class="list-unstyled">
          <li>
            <a href="<?= base_url('') ?>">Beranda</a>
          </li>
          <li>
            <a class="white-text dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tentang Perusahaan</a>
            <div class="dropdown-menu dropdown-danger" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item red-text" href="<?= base_url('tentang_perusahaan/ringkasan') ?>">Ringkasan</a>
              <a class="dropdown-item red-text" href="<?= base_url('tentang_perusahaan/visi_misi') ?>">Visi dan Misi</a>
              <a class="dropdown-item red-text d-none" href="<?= base_url('tentang_perusahaan/kata_ketua') ?>">Kata Ketua</a>
            </div>
          </li>
          <li>
            <a href="<?= base_url('penawaran/') ?>">Penawaran</a>
          </li>
          <li>
            <a href="<?= base_url('tentang_perusahaan/kontak_kami') ?>">Kontak Kami</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Kontak Kami</h5>
        <hr class="border-bottom border-danger my-2">
        <ul class="list-unstyled">
          <li>
            <a href="#!">admin@azkaumroh.com</a>
          </li>
          <li>
            <a href="#!">+6282123107344</a>
          </li>
          <li>
            <a href="#!">Rasuna Office Park NO-05</a>
          </li>
          <li>
            <a href="#!">DKI Jakarta</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Sosial Media</h5>
        <hr class=" border-bottom border-danger my-2">
        <div class="row text-center">
          <div class="col">
            <a href="https://api.whatsapp.com/send?phone=6282123107344" target="_blank">
              <i class="fa-brands fa-whatsapp fa-3x"></i>
            </a>
          </div>
          <div class="col">
            <a href="https://www.instagram.com/azkamandiriumroh/" target="_blank">
              <i class="fa-brands fa-instagram fa-3x"></i>
            </a>
          </div>
          <div class="col">
            <a href="https://twitter.com/mandiri_Azka" target="_blank">
              <i class="fa-brands fa-twitter fa-3x"></i>
            </a>
          </div>
          <div class="col">
            <a href="https://www.snapchat.com/add/azkaumroh?share_id=b_9Cx5qS1PI&locale=id-ID" target="_blank">
              <i class="fa-brands fa-snapchat fa-3x"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    All Rights Reserved Azka Umroh & Tourism 2022
    <br>
    didukung oleh © <a href="https://linktr.ee/hisyambsa" target="_blank" rel="noopener noreferrer"> hisyambsa</a>
    <br>
    <div class="text-center">
      <?= $data_commit ?>
    </div>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->


<script defer>
  window.fire_notif = function(pesan, type = 'info') {

    toastr[type](pesan);

    // Swal.fire({
    //   icon: type,
    //   position: 'top',
    //   toast: true,
    //   html: pesan,
    //   timerProgressBar: true,
    //   timer: 1500,
    //   showConfirmButton: false,
    // });
  };

  function redirectPesan(type = 'error', pesan, confirm = false, timer = '5000', toast = true) {
    if (toast) {
      toastr[type](pesan, '', {
        closeButton: true, // true/false
        debug: false, // true/false
        newestOnTop: true, // true/false
        progressBar: true, // true/false
        positionClass: "md-toast-top-right", // md-toast-top-right / md-toast-top-left / md-toast-bottom-right / md-toast-bottom-left
        preventDuplicates: false,
        onclick: null,
        showDuration: "300", // in milliseconds
        hideDuration: "1000", // in milliseconds
        timeOut: timer, // in milliseconds
        extendedTimeOut: "1000", // in milliseconds
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
      })
    } else {
      Swal.fire({
        icon: type,
        html: pesan,
        showConfirmButton: confirm,
        timer: timer,
        toast: toast,
        timerProgressBar: true,
        position: 'top',
      })

    }
  }


  function fire_toast(pesan) {
    Swal.fire({
      position: 'center-start',
      toast: true,
      html: pesan,
      timer: 1500,

      onBeforeOpen: () => {
        Swal.showLoading()

      },
    }).then((result) => {
      <?php
      if ($this->session->tempdata('pesan') <> '' and  $this->session->tempdata('toast_trigger') != 'forced') {
        $pesan = $this->session->tempdata('pesan');
        $type = ($this->session->tempdata('type')) ? $this->session->tempdata('type') : 'warning';
        // $this->session->unset_tempdata('toast_trigger');
        $confirm = ($this->session->tempdata('confirm')) ? 'true' : 'false';
        $timer = ($this->session->tempdata('timer')) ? $this->session->tempdata('timer') : '2000';
        if ($this->session->tempdata('toast') == 'toast') {
          $toast = true;
        } else {
          $toast = false;
        }
      ?>
        redirectPesan('<?= $type ?>', '<?= $pesan ?>', <?= $confirm ?>, '<?= $timer ?>', <?= $toast ?>);
      <?php } ?>
    })
  }

  var datetime = null,
    date = null;

  var update = function() {
    date = moment(new Date())
    datetime.html(date.format('dddd, Do MMMM YYYY H:mm:ss'));
  };
</script>

<!-- ion-auth -->
<script defer>
  $(document).ready(function() {

    datetime = $('#setDateList')
    update();
    setInterval(update, 1000);
    // Indonesian datepicker


    $('.timepicker').pickatime({
      // Light or Dark theme
      darktheme: true,
      // am and pm
      // twelvehour: true,
      // autoclose: true
    });


    $('.maintenance').block({
      message: '<i class="fas fa-wrench"></i>',
      css: {
        // border: '3px solid #a00'
      }
    });

    // setInterval(function() {
    //   window.location.reload()
    // }, 1800000);
    <?php
    if ($this->session->tempdata('pesan') <> '' and empty($this->session->tempdata('toast_trigger'))) {
      $pesan = $this->session->tempdata('pesan');
      $type = ($this->session->tempdata('type')) ? $this->session->tempdata('type') : 'warning';
      $confirm = ($this->session->tempdata('confirm') == 'true') ? true : false;
      $timer = ($this->session->tempdata('timer')) ? $this->session->tempdata('timer') : '2000';
      if ($this->session->tempdata('toast') == 'toast') {
        $toast = false;
      } else {
        $toast = true;
      }
    ?>
      redirectPesan('<?= $type ?>', '<?= $pesan ?>', '<?= $confirm ?>', '<?= $timer ?>', '<?= $toast ?>');

    <?php } ?>

    // cara ion-auth
    <?php
    if (!empty($message)) {
      $pesan = $message;
      $type = ($this->session->tempdata('type')) ? $this->session->tempdata('type') : 'warning';
      $confirm = ($this->session->tempdata('confirm') == 'true') ? true : false;
      $timer = ($this->session->tempdata('timer')) ? $this->session->tempdata('timer') : '2000';
      if ($this->session->tempdata('toast') == 'toast') {
        $toast = false;
      } else {
        $toast = true;
      }
    ?>
      redirectPesan('<?= $type ?>', '<?= $pesan ?>', '<?= $confirm ?>', '<?= $timer ?>', '<?= $toast ?>');
    <?php } ?>
  });
</script>
</section>
</body>

</html>
<?php if (ENVIRONMENT == 'development') : ?>
  <div class="fixed-action-btn" style="bottom: 0px; right: 0px;">
    <button class="">
      <strong>
        <?php
        echo $this->benchmark->elapsed_time();
        echo ' || ';
        echo $this->benchmark->memory_usage();
        ?>
      </strong>
    </button>
  </div>
<?php endif ?>