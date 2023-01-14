<style>
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
<div class="grey lighten-3">
    <div class="container" style="height: 100vh;">
        <br><br><br><br><br>
        <div class="text-center row justify-content-center align-middle" style="z-index: 2;">
            <div class="col-md-8">

                <?php echo form_open("auth/login", 'autocomplete="off;"'); ?>
                <!-- <img loading="lazy" height="120" class="" src="<?= base_url('uploads/settings/' . $this->session->userdata('settings')->logo_square) ?>" alt="logo"> -->
                <div class="py-3">
                    <label class="" for="identity">Username</label>
                    <?php echo form_input($identity, '', 'class="form-control"  required autofocus'); ?>
                </div>
                <div class="py-3">
                    <label class="" for="password">Password</label>
                    <?php echo form_input($password, '', 'class="form-control" required'); ?>
                </div>
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="form-check-input"'); ?>
                <?php echo lang('login_remember_label', 'remember', 'class="form-check-label mb-2"'); ?>
                <p><?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-lg btn-danger btn-block my-3"'); ?></p>

                <?php echo form_close(); ?>
                <!-- <p><a target="_blank" href="https://api.whatsapp.com/send?phone=6281905855754"><?php echo lang('login_forgot_password'); ?></a></p> -->
                <p class="mt-3 text-muted">All Rights Reserved Azka Umroh & Tourism 2022
                    <br>
                    didukung oleh © <a href="https://linktr.ee/hisyambsa" target="_blank" rel="noopener noreferrer"> hisyambsa</a>
                </p>

                <!-- <p class="mt-3 text-muted">&copy; 2019 - <?php echo date('Y') ?> </p> -->
            </div>
        </div>
    </div>
</div>

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
                    color: 'red',
                    sizeVariations: 2,
                    maxParticles: 200,
                    connectParticles: false,
                    // options for breakpoints
                    responsive: [{
                        breakpoint: 1024,
                        options: {
                            maxParticles: 200,
                            color: 'red',
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