<style>
  .containers {
    /* max-width: 500px; */
    margin: 0 auto;
    /* padding: 50px; */
    /* background-color: #fff; */
    box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.06), 0 1px 0 0 rgba(0, 0, 0, 0.02);
  }

  .backgrounds {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1;
  }

  input,
  label {
    position: relative;
    z-index: 10;
  }
</style>

<style>
  body {
    /* background-color: #212529 !important; */
    background-color: #1e1e1e !important;
  }

  /* body {
    background: rgba(145, 201, 214, 1);
    background: -moz-linear-gradient(top, rgba(145, 201, 214, 1) 0%, rgba(83, 144, 184, 1) 55%, rgba(0, 93, 162, 1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(145, 201, 214, 1)), color-stop(55%, rgba(83, 144, 184, 1)), color-stop(100%, rgba(0, 93, 162, 1)));
    background: -webkit-linear-gradient(top, rgba(145, 201, 214, 1) 0%, rgba(83, 144, 184, 1) 55%, rgba(0, 93, 162, 1) 100%);
    background: -o-linear-gradient(top, rgba(145, 201, 214, 1) 0%, rgba(83, 144, 184, 1) 55%, rgba(0, 93, 162, 1) 100%);
    background: -ms-linear-gradient(top, rgba(145, 201, 214, 1) 0%, rgba(83, 144, 184, 1) 55%, rgba(0, 93, 162, 1) 100%);
    background: linear-gradient(to bottom, rgba(145, 201, 214, 1) 0%, rgba(83, 144, 184, 1) 55%, rgba(0, 93, 162, 1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#91c9d6', endColorstr='#005da2', GradientType=0);
  } */

  .login {

    /* width: 100%; */
    width: 100vw;
    max-width: 560px;
    /* height: 100%; */
    overflow: hidden;
    background: #1e1e1e;
    opacity: 1;
    border-radius: 6px;
    margin: auto;
    margin-bottom: 0px auto;
    box-shadow: 0px 0px 0px rgba(0, 0, 0, .8);
  }

  .login .titulo {
    /* width: 298px; */
    padding-top: 13px;
    padding-bottom: 13px;
    font-size: 1rem;
    text-align: center;
    color: #bfbfbf;
    font-weight: bold;
    background: #1e1e1e;
    border: #1e1e1e solid 1px;
    margin-bottom: 30px;
    border-top-right-radius: 6px;
    border-top-left-radius: 6px;
    font-family: Arial;
  }

  .login form {
    /* width: 240px; */
    height: auto;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
  }

  .login form input[type=text],
  .login form input[type=password] {
    /* width: 200px; */
    font-size: 20px;
    /* padding-top: 14px; */
    /* padding-bottom: 14px; */
    /* padding-left: 40px; */
    border: none;
    color: #bfbfbf;
    background: #1e1e1e;
    outline: none;
    margin: 0;
  }

  .login form input[type=text] {
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    border-top: #0b0b0b solid 1px;
    border-bottom: #0b0b0b solid 1px;
    /* background: #141414 url(http://dev.dhenriquez.com/test-img/icons/111-user.png) 10px center no-repeat; */
  }

  .login form input[type=password] {
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    border-top: #0b0b0b 1px solid;
    border-bottom: #353535 1px solid;
    /* background: #141414 url(http://dev.dhenriquez.com/test-img/icons/54-lock.png) 10px center no-repeat; */
  }


  input {
    text-align: center;
  }

  .login form .enviar {
    /* width: 240px; */
    display: block;
    padding-top: 14px;
    padding-bottom: 14px;
    border-radius: 6px;
    border: none;
    border-top: #4eb2a8 1px solid;
    border-bottom: #161616 1px solid;
    background: #349e92;
    text-align: center;
    text-decoration: none;
    font-size: 12px;
    font-weight: bold;
    color: #FFF;
    text-shadow: 0 -1px #1d7464, 0 1px #7bb8b3;
    font-family: Arial;
  }

  .login .olvido {
    /* width: 240px; */
    height: auto;
    overflow: hidden;
    padding-top: 25px;
    padding-bottom: 25px;
    font-size: 10px;
    text-align: center;
  }

  .login .olvido .col {
    width: 100%;
    height: auto;
    float: left;
  }

  .login .olvido .col a {
    color: #fff;
    text-decoration: none;
    font: 12px Arial;
  }
</style>
<div class="d-flex justify-content-center" style="min-height: calc(100vh - 70px);">


  <!-- <div class="" style="max-width: 1560px;"> -->
  <div class="login align-middle">
    <div class="titulo">SELAMAT DATANG</div>
    <?php echo form_open("auth/login", 'class="form-signin"'); ?>
    <!-- <input type="text" required title="Username required" placeholder="Username" data-icon="U">
  <input type="password" required title="Password required" placeholder="Password" data-icon="x">
  <div class="olvido">
    <div class="col"><a href="#" title="Recuperar Password">Lupa Password?</a></div>
  </div>
  <a href="#" class="enviar">Submit</a> -->

    <div class="text-center">
      <img loading="lazy" class="mb-2" src="<?= base_url('gambar/PWA/icon/apple-icon-180x180-dunplab-manifest-20408.png') ?>" alt="logo" width="72" height="72">
    </div>
    <div class="row text-center" style="z-index: 2;">
      <div class="col-md-10 offset-md-1">
        <div class="mx-5 my-4">
          <!-- <label class="text-white" for="identity">USERNAME</label> -->
          <?php echo form_input($identity, '', 'class="form-control"  required placeholder="USERNAME"'); ?>
        </div>
        <div class="mx-5 my-4">
          <!-- <label class="text-white" for="password">PASSWORD</label> -->
          <?php echo form_input($password, '', 'class="form-control" required placeholder="PASSWORD" autocomplete="on"'); ?>
        </div>
        <div class="olvido">
          <div class="col"><a rel="noopener" rel="noreferrer" target="_blank" href="https://api.whatsapp.com/send?phone=6281905096842&text=<?= 'Masukan [Username/NIP] atau Nama terdaftar untuk melakukan reset password' ?>">RESET PASSWORD <br> VIA Whatsapp &nbsp;&nbsp;<i class="fab fa-whatsapp"></i></a></div>
          <br>
          <br>
          <br>
          <br>
          <?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="form-check-input"'); ?>
          <label class="form-check-label mb-2 text-white" for="remember">AUTO LOGIN</label>
          <div class="mb-3 mx-5 my-2">
            <?php echo form_submit('submit', lang('login_submit_btn'), 'class="enviar btn-block"'); ?>
          </div>
          <div class="text-center text-muted">
            All right reserved!
            <br><br>
            AZKA UMROH
          </div>
        </div>
      </div>
    </div>
    <!-- 
  <img loading="lazy" class="mb-4" src="<?= base_url('gambar/PWA/icon/apple-icon-180x180-dunplab-manifest-20408.png') ?>" alt="logo" width="72" height="72">
  <h1><?php echo lang('login_heading'); ?></h1>
  <p><?php echo lang('login_subheading'); ?></p>
  <div class="md-form">
    <?php echo form_input($identity, '', 'class="form-control"  required autofocus'); ?>
    <label for="identity">username</label>
  </div>
  <div class="md-form">
    <?php echo form_input($password, '', 'class="form-control" required'); ?>
    <label for="password">password</label>
  </div>
  <?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="form-check-input"'); ?>
  <?php echo lang('login_remember_label', 'remember', 'class="form-check-label mb-2"'); ?>
  <p><?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-lg btn-success btn-block"'); ?></p> -->

    <?php echo form_close(); ?>
  </div>
</div>
<!-- </div> -->


<canvas class="backgrounds"></canvas>
<script src="https://cdn.jsdelivr.net/npm/particlesjs@2.2.3/dist/particles.min.js" integrity="sha256-cy35RxCREfCgW7nc5h5HlCw5eEF4JKc9O+mb9BN07kY=" crossorigin="anonymous"></script>
<script>
  window.onload = function() {
    setTimeout(function() {
      document.getElementById("identity").focus();
      var
        particles = Particles.
      init
        ({
          selector: '.backgrounds',
          color: '#349e92',
          sizeVariations: 2,
          maxParticles: 200,
          connectParticles: false,
          // options for breakpoints
          responsive: [{
            breakpoint: 1024,
            options: {
              maxParticles: 200,
              color: '#349e92',
              connectParticles: false,
              sizeVariations: 1,
            }
          }, {
            breakpoint: 600,
            options: {
              maxParticles: 200,
              connectParticles: false,
              sizeVariations: 1,
            }
          }, {
            // breakpoint: 480,
            // options: {
            //   maxParticles: 100,
            //   connectParticles: false,
            //   sizeVariations: 1,
            //   // disables particles.js
            // }
          }]
        });
    }, 500);


  }
</script>