<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
<!-- .................................. -->
<!-- ...........COPYRIGHT ............. -->
<!-- Authors : Hisyam Husein .......... -->
<!-- Email : hisyam.husein@gmail.com .. -->
<!-- About : hisyambsa.github.io ...... -->
<!-- Instagram : @hisyambsa............ -->
<!-- .................................. -->
*/

?>

<style>
    #content {
        min-height: calc(100vh - 5rem);
        height: auto;
        transition: all 0.5s ease-in-out;
    }

    .button-collapse {
        position: fixed;
        /* left: 10px; */
        top: 0px;
        z-index: 10;
    }

    .treeview-animated .treeview-animated-items .jstree-ocl {
        font-size: 5px;
    }

    #navbarNotificationContent {
        max-height: 400px;
        overflow-y: auto;
    }

    #navbarNotificationContent {
        width: 400px;
        font-size: small;
    }

    /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) {
        #navbarNotificationContent {
            width: 500px;
            font-size: small;
        }
    }

    @media (min-width: 992px) {
        #navbarNotificationContent {
            width: 500px;
            font-size: small;
        }
    }

    @media(min-width: 1440px) {
        .content {
            padding-left: 290px;
        }
    }

    .jstree-default .jstree-icon:empty {
        width: 24px;
        line-height: 0px;
    }

    .jstree-default .jstree-anchor {
        line-height: 0px;
        height: 24px;
        padding: 20px 3px;
        padding-left: 12px;
    }

    .jstree-default .jstree-clicked {
        background: #2b7ea3;
        border-radius: 2px;
        box-shadow: inset 0 0 1px #999;
    }

    .jstree-default .jstree-hovered {
        background: #29555c;
        border-radius: 2px;
        box-shadow: inset 0 0 1px #ccc;
    }

    .jstree-icon:empty {
        display: inline;
    }

    .jstree-default .jstree-node {
        margin-left: 0px;
    }

    .side-nav a {
        display: block;
        height: 56px;
        padding-left: 20px;
        font-size: 12px;
        line-height: 56px;
    }
</style>


<?php if ($this->ion_auth->logged_in()) { ?>
    <header>
        <div id="slide-out" class="side-nav fixed">
            <ul class="custom-scrollbar">
                <li class="">
                    <div class="waves-light white">
                        <div class="row m-2">
                            <div class="col-7 green-text">
                                <small style="font-size: xx-small;">MA’HAD
                                    DAAR AL IMAM ANNAWAWI R.A
                                </small>
                            </div>
                            <div class="col-5 text-right">
                                <a href="<?= base_url('') ?>">
                                    <img height="60" width="60" alt="logo_full" src="https://pesantrensmartdigital.com/assets/images/logo.png" class="img-fluid flex-center">
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <ul class="social">
                        <li class="mx-3">
                            <?php if ($img_user) : ?>
                                <div class="row">
                                    <div class="col-4">
                                        <p><img alt="logo_square" width="70" height="70" src="<?= $img_user ?>" class="img-fluid white rounded-circle"></p>
                                    </div>
                                    <div class="col-8 text-left">
                                        <h6 class="h6-responesive text-capitalize"><?= $this->ion_auth->user()->row()->username ?></h6>
                                        <h6 class="h6-responesive text-capitalize">Admin</h6>
                                    </div>
                                </div>
                            <?php endif ?>
                        </li>
                    </ul>
                </li>
                <div sty id="html" class="treeview-animated w-30 mx-1 my-1">
                    <ul class="">
                        <li data-jstree='{"type":"file", "class":""}'>
                            <a href="<?= base_url('ppdb/modul') ?>" class="">
                                PPDB
                            </a>
                        </li>
                        <li data-jstree='{"type":"file", "class":""}'>
                            <a href="<?= base_url('santri/modul') ?>" class="">
                                Santri
                            </a>
                        </li>
                        <li data-jstree='{"type":"file", "class":""}'>
                            <a href="<?= base_url('pengajar/modul') ?>" class="">
                                Pengajar
                            </a>
                        </li>
                        <li data-jstree='{"type":"file", "class":""}'>
                            <a href="<?= base_url('pegawai/modul') ?>" class="">
                                Pegawai
                            </a>
                        </li>
                        <li data-jstree='{"type":"file", "class":""}'>
                            <a href="<?= base_url('kurikulum/modul') ?>" class="">
                                Kurikulum
                            </a>
                        </li>
                        <li data-jstree='{"type":"file", "class":""}'>
                            <a href="<?= base_url('nilai/modul') ?>" class="">
                                Nilai
                            </a>
                        </li>
                        <li data-jstree='{"type":"file", "class":""}'>
                            <a href="<?= base_url('catatan_akademik/modul') ?>" class="">
                                Catatan Akademik
                            </a>
                        </li>
                        <!-- <li class="jstree-ocl" data-jstree='{"type":"file", "class":""}'>Keuangan
                            <ul class="nested">
                                <li data-jstree='{"type":"file", "class":""}'>
                                    <a href="<?= base_url('approval/waiting') ?>" class="">
                                        Dashboard
                                    </a>
                                </li>
                                <li data-jstree='{"type":"file", "class":""}'>
                                    <a href="<?= base_url('approval/history') ?>" class="">
                                        Kategori
                                    </a>
                                </li>
                                <li data-jstree='{"type":"file", "class":""}'>
                                    <a href="<?= base_url('auth/logout') ?>" class="">
                                        Transaksi
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <li data-jstree='{"type":"file", "class":""}'>
                            <a href="<?= base_url('asrama/modul') ?>" class="">
                                Asrama
                            </a>
                        </li>
                        <li class="jstree-ocl" data-jstree='{"type":"root", "class":""}'>Pengaturan
                            <ul class="nested">
                                <li data-jstree='{"type":"file", "class":""}'>
                                    <a href="<?= base_url('approval/waiting') ?>" class="">
                                        User
                                    </a>
                                </li>
                                <li data-jstree='{"type":"file", "class":""}'>
                                    <a href="<?= base_url('approval/history') ?>" class="">
                                        Role Akses
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
        </div>
        <!--/. Sidebar navigation -->

        <br><br><br>
        <nav class="navbar fixed-tosp navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav fixed-top mb-5">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" id="trigger_nav" data-activates="slide-out" class="white-text button-collapse"><i class="fas fa-bars"></i></a>
            </div>
            <div class="ml-auto d-none d-xl-block">
                <a class="<?= (ENVIRONMENT == 'production') ? 'text-success' : 'text-warning '; ?>" href="#"><?= (ENVIRONMENT == 'production') ? ucwords('live') : ucwords(ENVIRONMENT); ?> | &nbsp;</a><a id="setDateList" href="#"></a>
            </div>
            <!-- /.Navbar -->
        </nav>
    </header>
    <!--/.Double navigation-->
<?php } ?>
<?php if (isset($this->ion_auth->user()->row()->username)) : ?>
    <script defer>
        $(document).ready(function() {
            OneSignal.getUserId(function(userId) {
                if (userId) {
                    $.ajax({
                        type: "get",
                        url: "https://onesignal.com/api/v1/players/" + userId,
                        data: {
                            data: {
                                appId: "<?= $this->config->item('app_id') ?>", // config
                                safari_web_id: "<?= $this->config->item('safari_web_id') ?>",
                            },
                        },
                        dataType: "json",
                        success: function(response) {
                            $.ajax({
                                type: "post",
                                url: "<?= base_url('ajax/create_update_users_notifications') ?>",
                                data: {
                                    nama_users_notifications: '<?= $this->ion_auth->user()->row()->username ?>',
                                    user_id_users_notifications: response.id,
                                    device_os_users_notifications: response.device_os,
                                    device_type_users_notifications: response.device_type,
                                    device_model_users_notifications: response.device_model,
                                    tags_users_notifications: response.tags,
                                    create_at_users_notifications: response.created_at,
                                    last_active_users_notifications: response.last_active,
                                    badge_count_users_notifications: response.badge_count,
                                    session_count_users_notifications: response.session_count,
                                    identifier_users_notifications: response.session_count,
                                },
                                dataType: "json",
                                success: function(response) {
                                    console.log(response)
                                }
                            });
                        }
                    });
                } else {

                }
                console.log("Notif User ID:", userId);
            });
        });
    </script>
<?php endif ?>
<section class="">
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span><br>
        </div>
    </div>
</section>
<div id="content" class="">

    <script>
        <?php if ($this->ion_auth->logged_in()) { ?>
            $(document).ready(function() {
                var sideNavScrollbar = document.querySelector('.custom-scrollbar');
                var ps = new PerfectScrollbar(sideNavScrollbar);

                let isOpen = false;
                let $windowWidth = $(window).width();
                const $btnCollapse = $(".button-collapse");
                const $content = $('#content');

                function get_responsive() {
                    $windowWidth = $(window).width();
                    if ($windowWidth > 1440) {
                        $content.css('padding-left', '240px');
                        if (isOpen) {
                            $btnCollapse.css('left', '0');
                            isOpen = false;
                        }
                    } else if ($windowWidth < 530 && isOpen) {
                        $btnCollapse.css('left', '0');
                        $content.css('padding-left', '0');
                        $('#sidenav-overlay').css('display', 'block');
                        $btnCollapse.trigger('click');
                    } else {
                        if (!isOpen) {
                            $content.css('padding-left', '0');
                        }
                    }
                }
                $(window).resize(function() {
                    get_responsive();
                });

                // SideNav Button Initialization
                $btnCollapse.sideNav();

                $btnCollapse.on('click', () => {
                    isOpen = !isOpen;
                    if ($windowWidth > 530) {
                        const elPadding = isOpen ? '250px' : '0';
                        const elPadding_content = isOpen ? '240px' : '0';
                        $btnCollapse.css('left', elPadding);
                        $content.css('padding-left', elPadding_content);
                        $('#sidenav-overlay').css('display', 'none');
                    } else {
                        $('#sidenav-overlay').on('click', () => {
                            isOpen = !isOpen;
                        });
                    }
                });
                $('#sidenav-overlay').on('click', () => {
                    isOpen = !isOpen;
                });
                get_responsive();
                if ($windowWidth > 1440) {
                    $('.button_collapse').click(function(e) {
                        e.preventDefault();

                    });

                }
            });
        <?php } ?>
    </script>
    <script>
        // html demo
        $(function() {
            $("#html").on("click", "li.jstree-node a", function() {
                document.location.href = this;
            });
        });
        $('#html').jstree({
            "types": {
                "root": {
                    "icon": "fa-sharp fa-solid fa-chevron-right"
                },
                "folder": {
                    "icon": "fa-sharp fa-solid fa-chevron-right"
                },
                "file": {
                    "icon": "fa-solid fa-arrow-up-right-from-square"
                },
                'f-open': {
                    'icon': 'fa-sharp fa-solid fa-chevron-down'
                },
                'f-closed': {
                    'icon': 'fa-sharp fa-solid fa-chevron-right'
                }
            },
            'plugins': ["state", "types"]

        });
        /* Toggle between folder open and folder closed */
        $("#html").on('open_node.jstree', function(event, data) {
            data.instance.set_type(data.node, 'f-open');
        });
        $("#html").on('close_node.jstree', function(event, data) {
            data.instance.set_type(data.node, 'f-closed');
        });
    </script>


    <?php
    /* End of file nav.php */
    /* Location: ./application/views/inc/nav.php */
    /* Please DO NOT modify this information : */
    /* http://hisyambsa.github.io */
    ?>