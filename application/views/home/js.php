<script>
    $(function() {
        $('.mdb-select').materialSelect();

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            // nav: true,
            animateOut: 'fadeOut',
            autoHeight: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            },
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
        })
    });
</script>