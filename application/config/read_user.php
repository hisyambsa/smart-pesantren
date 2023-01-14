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
<h2 class="h2-responsive">User Account </h2>
<h6 class="h6-responsive">Last Login : <?php echo $last_login; ?></h6>

<!-- Classic tabs -->
<div class="classic-tabs mx-2">

    <ul class="nav tabs-blue" id="myClassicTab role=" tablist">
        <li class="nav-item">
            <a class="nav-link  waves-light active show" id="profile-tab-classic" data-toggle="tab" href="#profile-classic" role="tab" aria-controls="profile-classic" aria-selected="true"><i class="fas fa-user pb-2" aria-hidden="true"></i><br>Apps</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link waves-light" id="follow-tab-classic" data-toggle="tab" href="#follow-classic" role="tab" aria-controls="follow-classic" aria-selected="false"><i class="fas fa-address-card pb-2" aria-hidden="true"></i><br>SDM</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link waves-light" id="contact-tab-classic" data-toggle="tab" href="#contact-classic" role="tab" aria-controls="contact-classic" aria-selected="false"><i class="fas fa-lock pb-2" aria-hidden="true"></i><br>Permission</a>
        </li>
    </ul>

    <div class="tab-content card" id="myClassicTabContent">
        <div class="tab-pane fade active show" id="profile-classic" role="tabpanel" aria-labelledby="profile-tab-classic">
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
                    <td>Nama Lengkap</td>
                    <td><?php echo $first_name; ?></td>
                </tr>
                <tr>
                    <td>Nama </td>
                    <td><?php echo $last_name; ?></td>
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
                    <td>Phone</td>
                    <td><?php echo $phone = ($phone) ? $phone : '-'; ?></td>
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
                    <td>Nomor Induk Pegawai / Identitas User Aplikasi</td>
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
                    <td><a href="<?= base_url('auth/change_password') ?>"><button class="btn btn-sm btn-info">Change Password</button></a></td>
                </tr>
            </table>
            <a onclick="alert('Anda akan diarahkan ke form Edit / Update data')" href="<?php echo base_url('auth/edit_user_client') ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah">
                <span class="fa fa-edit"> Edit / Update Data</span>
            </a>
        </div>
        <!-- <div class="tab-pane fade" id="follow-classic" role="tabpanel" aria-labelledby="follow-tab-classic">
            <table class="table">
                <tr>
                    <td>NIK</td>
                    <td><?php echo $NIK_sdm; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><?php echo $nama_sdm; ?></td>
                </tr>
                <tr>
                    <td>Telp</td>
                    <td><?php echo "+62-" . $telp_sdm; ?></td>
                </tr>
                <tr>
                    <td>Organ Perusahaan</td>
                    <td><?php echo $organ_perusahaan_sdm; ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td><?php echo $jabatan_sdm; ?></td>
                </tr>
                <tr>
                    <td>Job Level</td>
                    <td><?php echo $job_level_sdm; ?></td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td><?php echo $unit_kerja_sdm; ?></td>
                </tr>
                <tr>
                    <td>Bidang Kerja</td>
                    <td><?php echo $bidang_kerja_sdm; ?></td>
                </tr>
                <tr>
                    <td>Mulai Kerja</td>
                    <td><?php if ($mulai_kerja_sdm == '0000-00-00' or is_null($mulai_kerja_sdm)) {
                            echo "-";
                        } else {
                            echo $mulai_kerja_sdm;
                        }
                        ?></td>
                </tr>
                <tr>
                    <td>Akhir Kerja</td>
                    <td><?php if ($akhir_kerja_sdm == '0000-00-00' or is_null($akhir_kerja_sdm)) {
                            echo "-";
                        } else {
                            echo $akhir_kerja_sdm;
                        }
                        ?></td>
                </tr>
                <tr>
                    <td>Status Pekerjaan</td>
                    <td><?php echo $status_pekerjaan_sdm; ?></td>
                </tr>
                <tr>
                    <td>Status Aktif</td>
                    <td><?php echo $data = ($status_aktif_sdm == 1) ? 'Aktif' : 'Tidak aktif'; ?></td>
                </tr>
                <tr>
                    <td>Tempat Lahir</td>
                    <td><?php echo $tempat_lahir_sdm; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td><?php echo $tanggal_lahir_sdm; ?></td>
                </tr>
                <tr>
                    <td>No Npwp</td>
                    <td><?php echo $no_npwp_sdm; ?></td>
                </tr>
                <tr>
                    <td>Jumlah Tanggungan</td>
                    <td>
                        <?php echo $tampil = ($jumlah_tanggungan_sdm == 0) ? "tidak ada tanggungan" : $jumlah_tanggungan_sdm . " orang";
                        ?>

                    </td>
                </tr>
                <tr>
                    <td>Detail Tanggungan</td>
                    <td>
                        <?php
                        if ($detail_tanggungan_sdm != Null) {
                            $data =  explode(',', $detail_tanggungan_sdm);
                            $dataPasangan = ($data[0] == '0') ? 'Tidak Ada ' : $data[0];
                            $dataAnak = ($data[1] == '0') ? 'Tidak Ada ' : $data[1];
                            echo $dataPasangan . ' (Suami / Istri) dan ' . $dataAnak . ' (Anak)';
                        } else {
                            echo "Tidak di Ketahui";
                        }
                        ?>

                    </td>

                </tr>
                <tr>
                    <td>Tingkat Pendidikan</td>
                    <td><?php echo $tingkat_pendidikan_sdm; ?></td>
                </tr>
                <tr>
                    <td>Bidang Pendidikan</td>
                    <td><?php echo $bidang_pendidikan_sdm; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $email_sdm; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>
                        <?php if ($jenis_kelamin_sdm == 'L') {
                            echo "Laki-Laki";
                        } elseif ($jenis_kelamin_sdm == 'P') {
                            echo "Perempuan";
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td>Keterangan Status</td>
                    <td><?php echo $keterangan_status_sdm; ?></td>
                </tr>
                <tr>
                    <td>Foto Karyawan</td>
                    <td><a href="<?php echo base_url('uploads/karyawan/foto_karyawan/' . $foto_karyawan_sdm) ?>" data-lightbox="image-1" data-title="My caption"><img class="zoom" height="30" width="30" src="<?php echo base_url('uploads/karyawan/foto_karyawan/' . $foto_karyawan_sdm) ?>" alt="<?php echo $foto_karyawan_sdm ?>"></a></td>
                </tr>
            </table>
        </div> -->
        <div class="tab-pane fade" id="contact-classic" role="tabpanel" aria-labelledby="contact-tab-classic">
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
                    foreach ($list_nofitifikasi_data as $c_users_notifications) {
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
            </div>
        </div>
    </div>

</div>
<!-- Classic tabs -->

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

                    $('#td_notifikasi').html('Enabled <button class="btn btn-danger" onclick="sendMyDevice()">Test My Device</button>');
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
                $('#td_notifikasi').html('Enabled <button class="btn btn-danger" onclick="sendMyDevice()">Test My Device</button>');

                setTimeout(() => {
                    OneSignal.getUserId(function(userId) {
                        if (userId) {
                            $.ajax({
                                type: "get",
                                url: "https://onesignal.com/api/v1/players/" + userId,
                                data: {
                                    app_id: '539e467a-dd56-43fb-a40a-c3eead933bae'
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
                pesan: 'Test Notifikasi berhasil, ',

            },
            // dataType: "dataType",
            success: function(response) {
                console.log(response);
                if (response.recipients == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Device tidak terdaftar.',
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Device ini terdaftar.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    OneSignal.sendSelfNotification(
                        /* Title (defaults if unset) */
                        "Device sudah terdaftar",
                        /* Message (defaults if unset) */
                        "Notifikasi ini hadir jika Device anda sudah terdaftar",
                    );
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Device tidak terdaftar.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        });
    }
</script>