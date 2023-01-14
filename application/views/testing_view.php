<script>
    $(document).ready(function() {
        toastr['warning']('<?= $this->config->item('testing_message_sub') ?>', '<?= $this->config->item('testing_message_main') ?>', {
            closeButton: true, // true/false
            debug: false, // true/false
            newestOnTop: false, // true/false
            progressBar: false, // true/false
            positionClass: "md-toast-bottom-right", // md-toast-top-right / md-toast-top-left / md-toast-bottom-right / md-toast-bottom-left
            preventDuplicates: false,
            onclick: null,
            showDuration: "300", // in milliseconds
            hideDuration: "1000", // in milliseconds
            timeOut: null, // in milliseconds
            extendedTimeOut: "1000", // in milliseconds
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        })
    });
</script>