<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $description ?>">
    <meta name="author" content="@hisyambsa">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title ?></title>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@1.2.4/pace.min.js" integrity="sha256-gqd7YTjg/BtfqWSwsJOvndl0Bxc8gFImLEkXQT8+qj0=" crossorigin="anonymous"></script>
    <link id="pace-theme" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@1.2.4/themes/white/pace-theme-flash.css" integrity="sha256-1jWg8pbEcHYSWCbSkQlPtKAmAJdlCkrsyt/zjGD/tHY=" crossorigin="anonymous">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/hisyambsa/public@v.1.1/mdb/js/jquery.min.js"></script>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/hisyamasr/assets_cdn@v.2.4/mdb/js/jquery-3.4.1.min.js"></script> -->


    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon" />
    <!-- dunplab -->
    <!-- <link rel="manifest" href="<?= base_url('manifest.json') ?>"> -->

    <meta name="theme-color" content="#002744" />

    <!-- IOS SUPPORT -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">

    <!-- https://manytools.org/ -->

    <!-- https://appsco.pe/developer/splash-screens -->


    <meta name="apple-mobile-web-app-title" content="PWA APPS">
    <!-- <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <?php if ($this->ion_auth->is_admin()) : ?>
        <script src="https://use.fontawesome.com/9a026ddb40.js"></script>
    <?php endif ?>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/hisyambsa/assets_cdn@v.2.4/node_modules/animate.css/animate.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/gh/hisyambsa/public@v.1.1/mdb/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdn.jsdelivr.net/gh/hisyambsa/public@v.1.1/mdb/css/mdb.min.css" rel="stylesheet">

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js" integrity="sha256-t2UzhRr4kaJ0M9btOrWK1Uua9mDTZVrXyuC9lRtqAwk=" crossorigin="anonymous"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/hisyambsa/public@v.1.1/mdb/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/hisyambsa/public@v.1.1/mdb/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/hisyambsa/public@v.1.1/mdb/js/mdb.min.js"></script>

    <!-- lightbox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!--  moment.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/moment@2.27.0/locale/id.js" integrity="sha256-A2FUZBqky6lKyKZbmK910voOwpFWZ0lH0RSPoUZoncM=" crossorigin="anonymous"></script>
    <!-- ./ moment.js -->

    <!-- your style css  & js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- ./  your style css & js -->

    <!-- select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/id.min.js" integrity="sha512-d//BiQ6luOj+Yd4cE3o5eFzxtMpFqKOctlayhOtAEbKTcyw/tgVHoMgzXE1Yhp0h7nru/TrTp6flcMv+PJqtEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // $.fn.select2.defaults.set("theme", "bootstrap");
            // $.fn.select2.defaults.set("language", "id");
            // $.fn.select2.defaults.set("width", "100%");
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ./ select2 -->

    <!-- jstree -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <!-- ./jstree -->

    <div id="domMessage" style="display:none;">
        <h6 class="h6-responsive my-4">Sistem sedang memproses...</h6>
    </div>
    <script async>
        $(document).ajaxStop($.unblockUI);
        $.blockUI({
            message: $('#domMessage')
        });
        let base_url = '<?= base_url(); ?>';
        $(document).ready(function() {
            $.unblockUI();
        });
        $(document).ajaxStop($.unblockUI);
    </script>
    <style>
        .is-hide {
            display: none;
        }

        .content {
            min-height: 100vh;
            height: auto;
            transition: all 0.2s ease-in-out;
        }

        .button-collapse {
            position: fixed;
            left: 10px;
            top: 10px;
            z-index: 10;
        }

        @media(min-width: 1440px) {
            .content {
                padding-left: 250px;
            }
        }

        .cyan-skin .side-nav {
            background-color: #007170;
        }

        .cyan-skin .navbar {
            color: #fff;
            background-color: #007170;
        }
    </style>

</head>

<body class="cyan-skin">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NG632SG" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script defer>
        $(document).ready(function() {
            // harus di header karena extend before firing
            // Indonesian datepicker
            jQuery.extend(jQuery.fn.pickadate.defaults, {
                monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                weekdaysFull: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                firstDay: 1,
                format: 'd mmmm yyyy',
                formatSubmit: 'yyyy-mm-dd',
                hiddenName: true
            });
        });
    </script>