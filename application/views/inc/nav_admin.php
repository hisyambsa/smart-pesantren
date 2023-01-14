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
// var_dump($this->ion_auth->user()->row());
// die;

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

    .side-nav a {
        display: block;
        height: 56px;
        padding-left: 20px;
        font-size: 12px;
        line-height: 56px;
    }

    .jstree-default .jstree-node {
        margin-left: 12px;
    }
</style>


<?php if ($this->ion_auth->logged_in()) { ?>
    <header>
        <div id="slide-out" class="side-nav fixed">
            <ul class="custom-scrollbar">
                <li styl>
                    <div class="logo-wrapper waves-light">
                        <a href="<?= base_url('') ?>">
                            <img height="90" width="160px" alt="logo_full" src="<?= 'data:image/png;base64,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' ?>" class="img-fluid flex-center"></a>
                    </div>
                </li>
                <li>
                    <ul class="social">
                        <li class="">
                            <?php if ($img_user) : ?>
                                <p><img alt="logo_square" width="70" height="70" src="<?= $img_user ?>" class="img-fluid white rounded-circle"></p>
                            <?php endif ?>
                            <h6 class="h6-responesive text-capitalize"><?= $this->ion_auth->user()->row()->username ?></h6>
                        </li>
                    </ul>
                </li>
                <div sty id="html" class="treeview-animated w-30 mx-1 my-1">
                    <ul class="">
                        <li class="jstree-ocl" data-jstree='{"type":"root", "class":""}'>Approval
                            <ul class="nested">
                                <li data-jstree='{"type":"file", "class":""}'>
                                    <a href="<?= base_url('approval/waiting') ?>" class="">
                                        Waiting
                                    </a>
                                </li>
                                <li data-jstree='{"type":"file", "class":""}'>
                                    <a href="<?= base_url('approval/history') ?>" class="">
                                        History
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <li>
                    <ul class="social">
                        <li><a href="https://www.facebook.com/len.telko" class="waves-effect icons-sm text-white px-1 mr-1 btn-fb"><i class="fab fa-facebook-f"> </i></a></li>
                        <li><a href="https://www.instagram.com/len.telko/" class="waves-effect icons-sm text-white px-1 mr-1 btn-ins"><i class="fab fa-instagram"> </i></a></li>
                        <li><a href="https://www.linkedin.com/company/len-telko" class="waves-effect icons-sm text-white px-1 mr-1 btn-li"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="https://www.len-telko.co.id/" class="waves-effect icons-sm text-white px-1 mr-1 btn-reddit"><i class="fas fa-globe"> </i></a></li>
                    </ul>
                </li>
                <li>
                    <ul class="collapsible collapsible-accosrdion">
                        <a href="<?= base_url('verifikasi') ?>" class="waves-effect mb-2 btn-comm"><i class="fas fa-search"></i>
                            Verifikasi Dokumen
                        </a>
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=6281905096842&text=<?= '[' . $this->ion_auth->user()->row()->username . '] tulis pesan anda disini, sertakan lampiran untuk membantu troubleshoot aplikasi' ?>" class="collapsible-header waves-effect arrow-r btn-whatsapp"><i class="fab fa-whatsapp"></i>
                            Pusat Bantuan
                        </a>
                    </ul>
                </li>
                <div class="text-center">===========</div>
                <div class="text-center">=======</div>
                <div class="text-center">=</div>
            </ul>
            <div class="sidenav-bg rgba-blue-strong"></div>
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
<?php if ($nama_user) : ?>
    <div id="content" class="mx-4 mt-4 containers container-contents">
    <?php else : ?>
        <div class="">
        <?php endif ?>

        <script>
            $(document).ready(function() {
                // SideNav Button Initialization
                if ($('#trigger_nav').hasClass('button-collapse')) {

                    // $(".button-collapse").sideNav({
                    //     closeOnClick: false, // Closes side-nav on &lt;a&gt; clicks, useful for Angular/Meteor
                    //     showOverlay: true, // Display overflay
                    //     breakpoint: 1440, // Breakpoint for button collapse
                    // });
                    // // SideNav Scrollbar Initialization
                    // var sideNavScrollbar = document.querySelector('.custom-scrollbar');
                    // var ps = new PerfectScrollbar(sideNavScrollbar);


                }

            });
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