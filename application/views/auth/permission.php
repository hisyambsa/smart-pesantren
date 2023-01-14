<h2 class="h2-responsive">Permission </h2>
<table class="table table-bordered">
    <tr>
        <th>Fitur</th>
        <th>Keterangan</th>
    </tr>
    <tr>
        <td>GPS</td>
        <td id="td_gps"></td>
    </tr>
    <tr>
        <td>Camera</td>
        <td id="td_camera"></td>
    </tr>
    <tr>
        <td>Notifikasi</td>
        <td id="td_notifikasi">Security Issue</td>
    </tr>
</table>
<div class="table-responsive">
    <table class="table text-center text-nowrap display">

        <tr>
            <th>No.</th>
            <th>Model</th>
            <th>Browser</th>
            <th>Last Active</th>
            <th>Aksi</th>
        </tr>


        <h4 class="h4-responsive">Daftar Device Notifikasi yang terdaftar</h4>
        <?php
        $start = 0;
        foreach ($list_notifikasi_data as $c_users_notifications) {
        ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <!-- <td><?php echo $c_users_notifications->nama_users_notifications ?></td> -->
                <!-- <td><?php echo $c_users_notifications->nip_users_notifications ?></td> -->
                <!-- <td><?php echo $c_users_notifications->user_id_users_notifications ?></td> -->
                <td><?php echo $c_users_notifications->device_model_users_notifications ?></td>
                <td><?php echo $c_users_notifications->device_type_users_notifications . ' V.' . $c_users_notifications->device_os_users_notifications ?></td>
                <td><?php echo date("d M Y H:i:s", $c_users_notifications->last_active_users_notifications); ?></td>
                <td><button class="btn btn-sm btn-purple text-nowrap" onclick="sendThisDevice('<?= $c_users_notifications->user_id_users_notifications ?>')">Test This Browser</button></td>
            </tr>
        <?php } ?>
    </table>

    <script>
        // let otVersion = false;
        // const butSet = document.getElementById('butSet');
        // const butClear = document.getElementById('butClear');
        // const inputBadgeVal = document.getElementById('badgeVal');

        // const butMakeXHR = document.getElementById('butMakeXHR');

        // // Check if the API is supported.
        // if ('setExperimentalAppBadge' in navigator) {
        //     isSupported('v2')
        // }

        // // Check if the previous API surface is supported.
        // if ('ExperimentalBadge' in window) {
        //     isSupported('v1');
        // }

        // // Check if the previous API surface is supported.
        // if ('setAppBadge' in navigator) {
        //     isSupported('v3');
        // }

        // // Check if the previous API surface is supported.
        // if ('setClientBadge' in navigator) {
        //     isSupported('v4');
        // }

        // // Update the UI to indicate whether the API is supported.
        // function isSupported(kind) {
        //     console.log('supported', kind);
        //     const divNotSupported = document.getElementById('notSupported');
        //     divNotSupported.classList.toggle('hidden', true);
        //     butSet.removeAttribute('disabled');
        //     butClear.removeAttribute('disabled');
        //     inputBadgeVal.removeAttribute('disabled');

        //     butMakeXHR.removeAttribute('disabled');
        // }

        // // Click event handler for Set button.
        // butSet.addEventListener('click', () => {
        //     // const val = parseInt(inputBadgeVal.value, 10);
        //     const val = parseInt(999);
        //     if (isNaN(val)) {
        //         setBadge();
        //         return;
        //     }
        //     setBadge(val);
        // });

        // // Click event handler for Clear button.
        // butClear.addEventListener('click', () => {
        //     clearBadge();
        // });

        // butMakeXHR.addEventListener('click', () => {
        //     fetch('/manifest.json');
        // });

        setBadge(999);
        // Wrapper to support first and second origin trial
        // See https://web.dev/badging-api/ for details.
        function setBadge(...args) {
            if (navigator.setClientBadge) {
                navigator.setClientBadge(...args);
            } else if (navigator.setAppBadge) {
                navigator.setAppBadge(...args);
            } else if (navigator.setExperimentalAppBadge) {
                navigator.setExperimentalAppBadge(...args);
            } else if (window.ExperimentalBadge) {
                window.ExperimentalBadge.set(...args);
            }
        }

        // Wrapper to support first and second origin trial
        // See https://web.dev/badging-api/ for details.
        function clearBadge() {
            if (navigator.clearAppBadge) {
                navigator.clearAppBadge();
            } else if (navigator.clearExperimentalAppBadge) {
                navigator.clearExperimentalAppBadge();
            } else if (window.ExperimentalBadge) {
                window.ExperimentalBadge.clear();
            }
        }
    </script>

    <script defer>
        $(document).ready(function() {
            OneSignal.push(function() {
                // Occurs when the user's subscription changes to a new value.
                OneSignal.on('subscriptionChange', function(isSubscribed) {
                    console.log("The user's subscription state is now:", isSubscribed);
                });

                // This event can be listened to via the `on()` or `once()` listener.
            });

            console.log(navigator);
            var facingMode = "user"; // Can be 'user' or 'environment' to access back or front camera (NEAT!)
            var constraints = {
                audio: false,
                video: {
                    facingMode: facingMode
                }
            };
            $('#td_camera').html('Belum Diizinkan');
            console.log(navigator.mediaDevices.getUserMedia(constraints).then(function success(stream) {
                $('#td_camera').html('Allow / Diizinkan');
            }));

            $('#td_gps').html('Belum Diizinkan');
            navigator.permissions && navigator.permissions.query({
                    name: 'geolocation'
                })
                .then(function(PermissionStatus) {
                    if (PermissionStatus.state == 'granted') {
                        //allowed
                        $('#td_gps').html('Allow / Dizinkan');
                    } else if (PermissionStatus.state == 'prompt') {
                        // prompt - not yet grated or denied
                    } else {
                        //denied
                    }
                })

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