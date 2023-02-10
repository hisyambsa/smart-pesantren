<script src="https://cdn.jsdelivr.net/npm/piexifjs@1.0.6/piexif.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/css/fileinput.min.css" integrity="sha512-8KeRJXvPns3KF9uGWdZW18Azo4c1SG8dy2IqiMBq8Il1wdj7EWtR3EGLwj+DnvznrRjn0oyBU+OEwJk7A79n7w==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/fileinput.min.js" integrity="sha512-vDrq7v1F/VUDuBTB+eILVfb9ErriIMW7Dn3JC/HOQLI8ZzTBTRRKrKJO3vfMmZFQpEGVpi+EYJFatPgVFxOKGA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/locales/id.min.js" integrity="sha512-jzCNGQc2Inz0st0pcHOFXbRuZSP6AoRDZk5gV++BA1v9T70FR612nsMmKZw+nuHP/UaZ/RdC5o5mkXQK3YOQVg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/themes/fas/theme.min.js" integrity="sha512-BeQMmfGMfVp5kEkEGxUtlT5R9+m7jDVr5LDFCG2EK9VR50cEhR0kKzD5bn3XtSit/qNoYQUtr405lf5aSCSF8A==" crossorigin="anonymous"></script>

<?= form_open_multipart($action, $attributes, $hidden); ?>
<div class="form-group"><?php echo form_error('upload_kartu_keluarga') ?>
    <input data-allowed-file-extensions='["jpg", "png"]' data-browse-on-zone-click="true" data-msg-placeholder="Select {files} for upload..." data-drop-zone-click-title="<br>Klik disini" data-drop-zone-title="UPLOAD PAS FOTO" class="file-input" type="file" name="upload_kartu_keluarga" id="input-kartu-keluarga" />
</div>
<div class="form-group"><?php echo form_error('upload_kartu_keluarga') ?>
    <input data-browse-on-zone-click="true" data-msg-placeholder="Select {files} for upload..." data-drop-zone-click-title="<br>Klik disini" data-drop-zone-title="UPLOAD KARTU KELUARGA" class="file-input" type="file" name="upload_kartu_keluarga" id="input-kartu-keluarga" />
</div>
<div class="form-group"><?php echo form_error('upload_nasab') ?>
    <input data-browse-on-zone-click="true" data-msg-placeholder="Select {files} for upload..." data-drop-zone-click-title="<br>Klik disini" data-drop-zone-title="UPLOAD NASAB" class="file-input" type="file" name="upload_nasab" id="input-nasab" />
</div>
<div class="form-group"><?php echo form_error('upload_ijasah') ?>
    <input data-browse-on-zone-click="true" data-msg-placeholder="Select {files} for upload..." data-drop-zone-click-title="<br>Klik disini" data-drop-zone-title="UPLOAD IJASAH" class="file-input" type="file" name="upload_ijasah" id="input-ijasah" />
</div>
<button type="submit" class="btn btn-secondary btn-block btn-rounded mt-3">UPLOAD</button>
<?= form_close(); ?>
<script>
    $(function() {
        $(".file-input").fileinput({
            theme: "fas",
            language: "id",
            showUpload: false,
            allowedFileExtensions: ['pdf'],
            maxFileCount: 1,
            maxFilePreviewSize: 8192, // 1MB
            maxFileSize: 8192, // 1MB
            showPreview: true,
            showCaption: false,
            showBrowse: false,
            layoutTemplates: {
                actionDrag: '',
            },
            previewFileIconSettings: { // configure your icon file extensions
                'doc': '<i class="fas fa-file-word text-primary"></i>',
                'xls': '<i class="fas fa-file-excel text-success"></i>',
                'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
                'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
                'zip': '<i class="fas fa-file-archive text-muted"></i>',
                'htm': '<i class="fas fa-file-code text-info"></i>',
                'txt': '<i class="fas fa-file-alt text-info"></i>',
                'mov': '<i class="fas fa-file-video text-warning"></i>',
                'mp3': '<i class="fas fa-file-audio text-warning"></i>',
                // note for these file types below no extension determination logic 
                // has been configured (the keys itself will be used as extensions)
                'jpg': '<i class="fas fa-file-image text-danger"></i>',
                'gif': '<i class="fas fa-file-image text-muted"></i>',
                'png': '<i class="fas fa-file-image text-primary"></i>'
            },
        });

    });
</script>