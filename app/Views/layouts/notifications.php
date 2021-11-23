<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    <?php if (session()->hasFlash(\FLASH::SUCCESS)) : ?>
        <?php foreach (session()->getFlash(\FLASH::SUCCESS, []) as $messages) : ?>
            toastr.success("<?= $messages ?>", "Success");
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (session()->hasFlash(\FLASH::WARNING)) : ?>
        <?php foreach (session()->getFlash(\FLASH::WARNING, []) as $messages) : ?>
            toastr.warning("<?= $messages ?>", "Varning");
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (session()->hasFlash(\FLASH::ERROR)) : ?>
        <?php foreach (session()->getFlash(\FLASH::ERROR, []) as $messages) : ?>
            toastr.error("<?= $messages ?>", "Error");
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (session()->hasFlash(\FLASH::INFO)) : ?>
        <?php foreach (session()->getFlash(\FLASH::INFO, []) as $messages) : ?>
            toastr.info("<?= $messages ?>", "Info");
        <?php endforeach; ?>
    <?php endif; ?>
</script>