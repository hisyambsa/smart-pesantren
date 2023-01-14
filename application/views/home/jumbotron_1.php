<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <?php $i = 0; ?>
        <?php foreach (explode(',', $this->session->userdata('settings')->carousel_banner) as $key) : ?>
            <div class="carousel-item <?= $active = ($i == 0) ? 'active' : ''; ?>">
                <a data-lightbox="list_banner" href="<?= base_url("uploads/settings/$key") ?>">
                    <img class="d-block w-100" src="<?= base_url("uploads/settings/$key") ?>" alt="<?= $i ?>_slide">
                </a>
            </div>
            <?php
            $i++;
            ?>
        <?php endforeach ?>
    </div>
</div>
<?php
$this->load->view('home/search');
?>
<!-- Jumbotron -->
<div class="card card-image d-none" style="background-size: cover; background-image: url(<?= base_url('images/carousel/header_1.png') ?>);">
    <!-- <div class="card card-image" style="background-image: url(https://cdn-2.tstatic.net/ternate/foto/bank/images/kabah-123.jpg);"> -->
    <div class="text-white text-center py-5 px-4">
        <div class="py-5">
            <br><br><br><br>
            <br><br>
            <!-- Content -->
            <!-- <h5 class="h5 white-text"><i class="fas fa-camera-retro"></i> Explore Umroh</h5> -->
            <!-- <h2 class="card-title h2 my-4 py-2">Jumbotron with image overlay</h2> -->
            <!-- <p class="mb-4 pb-2 px-md-5 mx-md-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur obcaecati vero aliquid libero doloribus ad, unde tempora maiores, ullam, modi qui quidem minima debitis perferendis vitae cumque et quo impedit.</p> -->
            <!-- <a href="<?= base_url('penawaran') ?>" class="btn btn-danger my-5"> Booking Now</a> -->
        </div>
    </div>
    <?php
    $this->load->view('home/search');
    ?>
</div>
<!-- Jumbotron -->

<script>
    $(function() {
        $('.carousel').carousel({
            interval: 5000,
            pause: '',
            ride: true,
        })
    });
</script>