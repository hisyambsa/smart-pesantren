<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<div class="container my-5">
    <h4 class="h4-responsive red-text">Klien Kami</h4>
    <hr class="border-bottom border-danger my-2">
    <div class="owl-carousel owl-theme py-5">
        <?php $i = 0 ?>
        <?php foreach (explode(',', $this->session->userdata('settings')->list_klien) as $key) : ?>
            <div class="item py-3">
                <img loading="lazy" src="<?= base_url("uploads/settings/$key") ?>" alt="klien_<?= $i ?>">
            </div>
            <?php $i++; ?>
        <?php endforeach ?>
    </div>
    <div class="text-center"><small><b>PT AZKA MANDIRI INTERNASIONAL</b> <br> Member of Al Riyadh Travel Group Saudi</small></div>
</div>