<?php
/*
<!-- .................................. -->
<!-- ...........COPYRIGHT ............. -->
<!-- Authors : Hisyam Husein .......... -->
<!-- Email : hisyam.husein@gmail.com .. -->
<!-- About : hisyam.ismul.com ......... -->
<!-- Instagram : @hisyambsa............ -->
<!-- .................................. -->
*/
?>
<script>
    window.addEventListener('appinstalled', (evt) => {
        // Log install to analytics
        console.log('INSTALL: Success');
    });
</script>
<h2 class="h2-responsive">Info Account </h2>
<h6 class="h6-responsive">Last Login : <?php echo $last_login; ?></h6>
<table class="table table-stripped">
    <tr>
        <td>Username Login</td>
        <td><?php echo $username; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $email = ($email) ? $email : '-'; ?></td>
    </tr>
    <tr>
        <td>Nama di Apps</td>
        <td><?php echo $last_name; ?></td>
    </tr>
    <tr>
        <td>Nama Lengkap</td>
        <td><?php echo $first_name; ?></td>
    </tr>
    <tr>
        <td>Job Level</td>
        <td><?php echo $job_level; ?></td>
    </tr>
    <tr>
        <td>Unit Kerja / Divisi</td>
        <td><?php echo $unit_kerja; ?></td>
    </tr>
    <tr>
        <td>Region</td>
        <td><?php echo $region; ?></td>
    </tr>
    <!-- <tr>
                    <td>Boss</td>
                    <td><?php echo $boss; ?></td>
                </tr> -->
    <tr>
        <td>Telphone</td>
        <td><?php echo $telp = ($telp) ? '+62 ' . $telp : '-'; ?></td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td>
        <td>
            <?php echo $tanggal_lahir; ?>
        </td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td><?php echo $alamat; ?></td>
    </tr>
    <tr>
        <td>Platform Login Terakhir</td>
        <td><?php echo $last_user_agent; ?></td>
    </tr>
    <tr>
        <td>Nomor Induk Pegawai / Identitas User</td>
        <td><?php echo $nip; ?></td>
    </tr>
    <tr>
        <td>In Charge Company</td>
        <td><?php echo $in_charge_company; ?></td>
    </tr>
    <tr>
        <td>Akun dibuat</td>
        <td><?php echo $created_on; ?></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><a href="<?= base_url('auth/change_password') ?>"><button class="btn btn-sm btn-info">GANTI PASSWORD</button></a></td>
    </tr>
</table>
<!-- <a onclick="alert('Anda akan diarahkan ke form Edit / Update data')" href="<?php echo base_url('auth/edit_user_client') ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah">
    <span class="fa fa-edit"> Edit / Update Data</span>
</a> -->

<script defer>
    $(document).ready(function() {
        OneSignal.push(function() {
            // Occurs when the user's subscription changes to a new value.
            OneSignal.on('subscriptionChange', function(isSubscribed) {
                console.log("The user's subscription state is now:", isSubscribed);
            });

            // This event can be listened to via the `on()` or `once()` listener.
        });


        if (navigator.geolocation) {
            $('#td_gps').html('active');
        } else {
            $('#td_gps').html('inactive');
        }

        var table = $('.dataTableRun').DataTable({
            dom: 't',
        });

        /* These examples are all valid */
        var isPushSupported = OneSignal.isPushNotificationsSupported();
        if (isPushSupported) {
            // Push notifications are supported

            OneSignal.push(["getNotificationPermission", function(permission) {
                // (Output) Site Notification Permission: default
                if (permission == 'granted') {


                    // OneSignal.setSubscription()

                    $('#td_notifikasi').html('Enabled <button class="btn btn-success" onclick="sendMyDevice()">Test My Device</button>');
                } else if (permission == 'denied') {
                    $('#td_notifikasi').html('Anda tidak mengizinkan <sup>*periksa permission device</sup>');
                } else if (permission == 'default') {
                    $('#td_notifikasi').html('Not Enabled / belum diberikan izin. Klik tombol <a href="#" class="btn btn-sm btn-danger" onclick="OneSignal.showSlidedownPrompt({force: true});">berikan izin <i class="fa fa-bell" aria-hidden="true"></i></a>');
                }
            }]);


        } else {
            // Push notifications are not supported
            $('#td_notifikasi').html('Not Supported / browser anda tidak didukung');
        }

        OneSignal.push(function() {
            // Occurs when the user's subscription changes to a new value.
            OneSignal.on('subscriptionChange', function(isSubscribed) {
                console.log("The user's subscription state is now:", isSubscribed);
            });
        });

        OneSignal.on('notificationPermissionChange', function(permissionChange) {
            var currentPermission = permissionChange.to;
            if (currentPermission == 'granted') {
                $('#td_notifikasi').html('Enabled <button class="btn btn-success" onclick="sendMyDevice()">Test My Device</button>');

                setTimeout(() => {
                    OneSignal.getUserId(function(userId) {
                        if (userId) {
                            $.ajax({
                                type: "get",
                                url: "https://onesignal.com/api/v1/players/" + userId,
                                data: {
                                    app_id: ''
                                },
                                dataType: "json",
                                success: function(response) {
                                    $.ajax({
                                        type: "post",
                                        url: "<?= base_url('ajax/create_update_users_notifications') ?>",
                                        data: {
                                            nama_users_notifications: '<?= $this->ion_auth->user()->row()->first_name ?>',
                                            nip_users_notifications: '<?= $this->ion_auth->user()->row()->nip ?>',
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
                        console.log("OneSignal User ID:", userId);
                        // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
                    });
                }, 2000);
            } else if (currentPermission == 'denied') {
                $('#td_notifikasi').html('Anda tidak mengizinkan <sup>*periksa permission device</sup>');
            } else if (currentPermission == 'default') {
                $('#td_notifikasi').html('Not Enabled / belum diberikan izin. Klik tombol <a href="#" class="btn btn-sm btn-danger" onclick="OneSignal.showSlidedownPrompt({force: true});">berikan izin <i class="fa fa-bell" aria-hidden="true"></i></a>');
            }
            console.log('New permission state:', currentPermission);
        });

    });




    function sendThisDevice(id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('ajax/send_client_notifications') ?>",
            data: {
                id: id,
                pesan: 'Test Notifikasi berhasil ',

            },
            // dataType: "dataType",
            success: function(response) {
                console.log(response);
                if (response.recipients == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: '.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Notifikasi sudah dikirim.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }

    function sendMyDevice() {
        OneSignal.push(function() {
            /* These examples are all valid */
            OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                if (isEnabled) {

                    setTimeout(() => {
                        OneSignal.getUserId(function(userId) {
                            if (userId) {
                                $.ajax({
                                    type: "get",
                                    url: "https://onesignal.com/api/v1/players/" + userId,
                                    data: {
                                        appId: "<?= $this->config->item('app_id') ?>", // config
                                        safari_web_id: "<?= $this->config->item('safari_web_id') ?>",
                                    },
                                    dataType: "json",
                                    success: function(response) {
                                        $.ajax({
                                            type: "post",
                                            url: "<?= base_url('ajax/create_update_users_notifications') ?>",
                                            data: {
                                                nama_users_notifications: '<?= $this->ion_auth->user()->row()->first_name ?>',
                                                nip_users_notifications: '<?= $this->ion_auth->user()->row()->nip ?>',
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
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'INSTALL BERHASIL',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                })
                                            }
                                        });
                                    }
                                });
                            } else {

                            }
                            console.log("OneSignal User ID:", userId);
                            // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
                        });
                    }, 2000);
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Notifikasi Terinstall.',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                    OneSignal.sendSelfNotification(
                        /* Title (defaults if unset) */
                        "Success",
                        /* Message (defaults if unset) */
                        "INSTALL BERHASIL",
                    );
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Notifikasi Gagal Install',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                }
            });
        });
    }
</script>