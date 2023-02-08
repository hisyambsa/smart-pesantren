</main>
<!--Main Layout-->
</body>
<?php if ($this->ion_auth->logged_in()) { ?>
    <script>
        $(function() {
            // SideNav Button Initialization
            $(".button-collapse").sideNav();
            // SideNav Scrollbar Initialization
            var sideNavScrollbar = document.querySelector('.custom-scrollbar');
            var ps = new PerfectScrollbar(sideNavScrollbar);
        })
    </script>
<?php } ?>

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
                    $toast = false;
                } else {
                    $toast = true;
                }
            ?>
                redirectPesan('<?= $type ?>', '<?= $pesan ?>', '<?= $confirm ?>', '<?= $timer ?>', '<?= $toast ?>');
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
<?php
$whitelist = array(
    '127.0.0.1',
    '::1'
);
?>
<?php if (in_array($_SERVER['REMOTE_ADDR'], $whitelist) or PROFILER == TRUE) : ?>
    <div class="fixed-action-btn" style="bottom: 0px; right: 0px;">
        <button class="">
            <strong>
                <?php
                echo $this->benchmark->elapsed_time();
                echo ' || ';
                echo $this->benchmark->memory_usage();
                $this->output->enable_profiler(TRUE);
                ?>
            </strong>
        </button>
    </div>
<?php endif ?>