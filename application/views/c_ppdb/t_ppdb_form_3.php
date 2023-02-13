<script>
    $(function() {
        // pas foto
        var $el1 = $("#input-pas-foto");
        $($el1).on('filebatchuploadsuccess', function(event, data, previewId, index) {
            var form = data.form,
                files = data.files,
                extra = data.extra,
                response = data.response,
                reader = data.reader;
            alert(extra.bdInteli + " " + response.uploaded);
        });
        $el1.fileinput({
            allowedFileExtensions: ['pdf', 'jpg', 'png'],
            uploadUrl: "<?= base_url('ajax_upload/upload/') ?>" + $($el1).attr('file-upload'),
            uploadAsync: true,
            deleteUrl: "/site/file-delete",
            showUpload: true, // hide upload button
            overwriteInitial: true, // append files to initial preview
            minFileCount: 1,
            maxFileCount: 1,
            browseOnZoneClick: true,

            <?php if ($upload_pas_foto) : ?>
                initialPreview: [
                    "<?= base_url('uploads/ppdb/' . $upload_pas_foto) ?>",
                ],
                initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                initialPreviewConfig: [{
                    caption: "<?= $no_pendaftaran ?>",
                    description: '<?= $no_pendaftaran ?>',
                    size: 932882,
                    width: "120px",
                    url: "/site/file-delete",
                    key: 0
                }, ],
            <?php endif ?>


            showBrowse: false,
            showCaption: false,

            previewFileType: 'any',
            theme: "fas",
            language: "id",
            uploadExtraData: {
                upload_path: 'uploads/ppdb', //this is formData
                nama_file: $($el1).attr('data-name') + '_<?= $no_pendaftaran ?>', //this is formData
                csrf_token_name: $("input[name=csrf_token_name]").val(),
            },
            required: true,
            pdfRendererUrl: 'https://plugins.krajee.com/pdfjs/web/viewer.html',

        }).on("filebatchselected", function(event, files) {
            $el1.fileinput("upload");
        }).on('filedeleted', function(event, id, index) {
            '<?= strtotime('now') ?>';
        }).on('filesuccessremove', function(event, id) {
            event.preventDefault();
            dp = $('div.file-preview-thumbnails #' + id).attr('server_id')
            $.post('deletefilesurl', {
                    'server_id': dp
                })
                .done(function(r) {
                    if (r == 'ok') {
                        $('#' + id).fadeOut(300, function() {
                            $(this).remove()
                        })
                    } else {
                        $('#' + id).addClass('btn-danger').find('.file-actions').html(r)
                    }
                })
                .fail(function() {
                    $('#' + id).addClass('btn-danger').find('.file-actions').html('nothing deleted')
                })

            return false
        }).on('fileuploaded', function(event, previewId, index, fileId) {
            $('input[name="upload_pas_foto"]').val(previewId.response.initialPreviewConfig[0].key);
        }).on('fileloaded', function(event, previewId, index, fileId) {

        });

        // kartu_keluarga
        var $el2 = $("#input-kartu-keluarga");
        $($el2).on('filebatchuploadsuccess', function(event, data, previewId, index) {
            var form = data.form,
                files = data.files,
                extra = data.extra,
                response = data.response,
                reader = data.reader;
            alert(extra.bdInteli + " " + response.uploaded);
        });
        $el2.fileinput({
            allowedFileExtensions: ['pdf', 'jpg', 'png'],
            uploadUrl: "<?= base_url('ajax_upload/upload/') ?>" + $($el2).attr('file-upload'),
            uploadAsync: true,
            deleteUrl: "/site/file-delete",
            showUpload: true, // hide upload button
            overwriteInitial: true, // append files to initial preview
            minFileCount: 1,
            maxFileCount: 1,
            browseOnZoneClick: true,

            <?php if ($upload_kartu_keluarga) : ?>
                initialPreview: [
                    "<?= base_url('uploads/ppdb/' . $upload_kartu_keluarga) ?>",
                ],
                initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                initialPreviewConfig: [{
                    caption: "<?= $no_pendaftaran ?>",
                    description: '<?= $no_pendaftaran ?>',
                    size: 932882,
                    width: "120px",
                    url: "/site/file-delete",
                    key: 0
                }, ],
            <?php endif ?>

            showBrowse: false,
            showCaption: false,

            previewFileType: 'any',
            theme: "fas",
            language: "id",
            uploadExtraData: {
                upload_path: 'uploads/ppdb', //this is formData
                nama_file: $($el2).attr('data-name') + '_<?= $no_pendaftaran ?>', //this is formData
                csrf_token_name: $("input[name=csrf_token_name]").val(),
            },
            required: true,
            pdfRendererUrl: 'https://plugins.krajee.com/pdfjs/web/viewer.html',

        }).on("filebatchselected", function(event, files) {
            $el2.fileinput("upload");
        }).on('filedeleted', function(event, id, index) {
            '<?= strtotime('now') ?>';
        }).on('filesuccessremove', function(event, id) {
            event.preventDefault();
            dp = $('div.file-preview-thumbnails #' + id).attr('server_id')
            $.post('deletefilesurl', {
                    'server_id': dp
                })
                .done(function(r) {
                    if (r == 'ok') {
                        $('#' + id).fadeOut(300, function() {
                            $(this).remove()
                        })
                    } else {
                        $('#' + id).addClass('btn-danger').find('.file-actions').html(r)
                    }
                })
                .fail(function() {
                    $('#' + id).addClass('btn-danger').find('.file-actions').html('nothing deleted')
                })

            return false
        }).on('fileuploaded', function(event, previewId, index, fileId) {
            $('input[name="upload_kartu_keluarga"]').val(previewId.response.initialPreviewConfig[0].key);
        }).on('fileloaded', function(event, previewId, index, fileId) {

        });
        // nasab
        var $el3 = $("#input-nasab");
        $($el3).on('filebatchuploadsuccess', function(event, data, previewId, index) {
            var form = data.form,
                files = data.files,
                extra = data.extra,
                response = data.response,
                reader = data.reader;
            alert(extra.bdInteli + " " + response.uploaded);
        });
        $el3.fileinput({
            allowedFileExtensions: ['pdf', 'jpg', 'png'],
            uploadUrl: "<?= base_url('ajax_upload/upload/') ?>" + $($el3).attr('file-upload'),
            uploadAsync: true,
            deleteUrl: "/site/file-delete",
            showUpload: true, // hide upload button
            overwriteInitial: true, // append files to initial preview
            minFileCount: 1,
            maxFileCount: 1,
            browseOnZoneClick: true,

            <?php if ($upload_nasab) : ?>
                initialPreview: [
                    "<?= base_url('uploads/ppdb/' . $upload_nasab) ?>",
                ],
                initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                initialPreviewConfig: [{
                    caption: "<?= $no_pendaftaran ?>",
                    description: '<?= $no_pendaftaran ?>',
                    size: 932882,
                    width: "120px",
                    url: "/site/file-delete",
                    key: 0
                }, ],
            <?php endif ?>


            showBrowse: false,
            showCaption: false,

            previewFileType: 'any',
            theme: "fas",
            language: "id",
            uploadExtraData: {
                upload_path: 'uploads/ppdb', //this is formData
                nama_file: $($el3).attr('data-name') + '_<?= $no_pendaftaran ?>', //this is formData
                csrf_token_name: $("input[name=csrf_token_name]").val(),
            },
            required: true,
            pdfRendererUrl: 'https://plugins.krajee.com/pdfjs/web/viewer.html',

        }).on("filebatchselected", function(event, files) {
            $el3.fileinput("upload");
        }).on('filedeleted', function(event, id, index) {
            '<?= strtotime('now') ?>';
        }).on('filesuccessremove', function(event, id) {
            event.preventDefault();
            dp = $('div.file-preview-thumbnails #' + id).attr('server_id')
            $.post('deletefilesurl', {
                    'server_id': dp
                })
                .done(function(r) {
                    if (r == 'ok') {
                        $('#' + id).fadeOut(300, function() {
                            $(this).remove()
                        })
                    } else {
                        $('#' + id).addClass('btn-danger').find('.file-actions').html(r)
                    }
                })
                .fail(function() {
                    $('#' + id).addClass('btn-danger').find('.file-actions').html('nothing deleted')
                })

            return false
        }).on('fileuploaded', function(event, previewId, index, fileId) {
            $('input[name="upload_nasab"]').val(previewId.response.initialPreviewConfig[0].key);
        }).on('fileloaded', function(event, previewId, index, fileId) {

        });
        // ijasah
        var $el4 = $("#input-ijasah");
        $($el4).on('filebatchuploadsuccess', function(event, data, previewId, index) {
            var form = data.form,
                files = data.files,
                extra = data.extra,
                response = data.response,
                reader = data.reader;
            alert(extra.bdInteli + " " + response.uploaded);
        });
        $el4.fileinput({
            allowedFileExtensions: ['pdf', 'jpg', 'png'],
            uploadUrl: "<?= base_url('ajax_upload/upload/') ?>" + $($el4).attr('file-upload'),
            uploadAsync: true,
            deleteUrl: "/site/file-delete",
            showUpload: true, // hide upload button
            overwriteInitial: true, // append files to initial preview
            minFileCount: 1,
            maxFileCount: 1,
            browseOnZoneClick: true,

            <?php if ($upload_ijasah) : ?>
                initialPreview: [
                    "<?= base_url('uploads/ppdb/' . $upload_ijasah) ?>",
                ],
                initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
                initialPreviewFileType: 'image', // image is the default and can be overridden in config below
                initialPreviewConfig: [{
                    caption: "<?= $no_pendaftaran ?>",
                    description: '<?= $no_pendaftaran ?>',
                    size: 932882,
                    width: "120px",
                    url: "/site/file-delete",
                    key: 0
                }, ],
            <?php endif ?>


            showBrowse: false,
            showCaption: false,

            previewFileType: 'any',
            theme: "fas",
            language: "id",
            uploadExtraData: {
                upload_path: 'uploads/ppdb', //this is formData
                nama_file: $($el4).attr('data-name') + '_<?= $no_pendaftaran ?>', //this is formData
                csrf_token_name: $("input[name=csrf_token_name]").val(),
            },
            required: true,
            pdfRendererUrl: 'https://plugins.krajee.com/pdfjs/web/viewer.html',

        }).on("filebatchselected", function(event, files) {
            $el4.fileinput("upload");
        }).on('filedeleted', function(event, id, index) {
            '<?= strtotime('now') ?>';
        }).on('filesuccessremove', function(event, id) {
            event.preventDefault();
            dp = $('div.file-preview-thumbnails #' + id).attr('server_id')
            $.post('deletefilesurl', {
                    'server_id': dp
                })
                .done(function(r) {
                    if (r == 'ok') {
                        $('#' + id).fadeOut(300, function() {
                            $(this).remove()
                        })
                    } else {
                        $('#' + id).addClass('btn-danger').find('.file-actions').html(r)
                    }
                })
                .fail(function() {
                    $('#' + id).addClass('btn-danger').find('.file-actions').html('nothing deleted')
                })

            return false
        }).on('fileuploaded', function(event, previewId, index, fileId) {
            $('input[name="upload_ijasah"]').val(previewId.response.initialPreviewConfig[0].key);
        }).on('fileloaded', function(event, previewId, index, fileId) {

        });



    });
</script>