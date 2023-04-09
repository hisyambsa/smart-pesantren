<div class="tg-wrap">
    <table style="table-layout: fixed; width: 100%;">
        <tbody>
            <tr>
                <td width="1.50cm"></td>
                <td width="0.85cm"></td>
                <td width="4.70cm"></td>
                <td width="0.25cm"></td>
                <td width="1.15cm"></td>
                <td width="0.75cm"></td>
                <td width="2cm"></td>
                <td width="2.20cm"></td>
                <td width="0.75cm"></td>
                <td width="2.20cm"></td>
                <td width="1cm"></td>
                <td width="1.45cm"></td>
            </tr>
            <tr>
                <td style="text-align:center; border-bottom: 2px solid black;" colspan="2" rowspan="4">
                    <!-- logo -->
                </td>
                <td style="text-align:center;" colspan="10">
                    <font size="12"><b>
                            <?= $this->session->userdata('settings')->nama_yayasan; ?></b>
                    </font>
                </td>
            </tr>
            <tr>
                <td style="text-align:center;" colspan="10">
                    <font size="13">
                        <b>PESANTREN
                            <?= $this->session->userdata('settings')->nama_pesantren; ?>
                        </b>
                    </font>
                </td>
            </tr>
            <tr>
                <td style="text-align:center;" colspan="10">
                    <font size="9"><?= $this->session->userdata('settings')->alamat_pesantren; ?></font>
                </td>
            </tr>
            <tr>
                <td style="text-align:center; border-bottom: 2px solid black;" colspan="10">
                    <font size="9"> <?= $this->session->userdata('settings')->kontak_pesantren; ?></font>
                </td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td style="text-align:center;" colspan="12">
                    <font size="12"><b>FORMULIR PENERIMAAN PESERTA DIDIK BARU</b></font>
                </td>
            </tr>
            <tr>
                <td style="text-align:center;" colspan="12">
                    <font size="12"><b><?= $this->session->userdata('settings')->nama_pesantren; ?></b></font>
                </td>
            </tr>
            <tr>
                <td style="text-align:center;" colspan="12">
                    <font size="9"><b>TAHUN PELAJARAN 2023/2024</b></font>
                </td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td></td>
                <td style="vertical-align: middle; border: 2px solid black; text-align:center;" colspan="3" rowspan="4">
                    <br>
                    <br>
                    <font size="10"><b>NO. PENDAFTARAN</b></font>
                    <br>
                    <font size="18"><b><?= $no_pendaftaran ?></b></font>
                </td>
                <td colspan="5"></td>
                <td colspan="2" rowspan="6">
                    <!-- <font size="10">PAS POTO</font> -->
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td colspan="10"></td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>A.</b></td>
                <td colspan="7">
                    <font size="10"><b>KETERANGAN CALON PESERTA DIDIK</b></font>
                </td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">1.</font>
                </td>
                <td colspan="2">
                    <font size="10">NIK</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $nik_santri ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">2.</font>
                </td>
                <td colspan="2">
                    <font size="10">Nama Lengkap</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $nama_santri ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">3.</font>
                </td>
                <td colspan="2">
                    <font size="10">Tempat, Tanggal Lahir</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $tempat_lahir ?>, <?= $tanggal_lahir_locale ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">4.</font>
                </td>
                <td colspan="2">
                    <font size="10">Jenis Kelamin</font>
                </td>
                <td style="text-align: center;">:</td>
                <td style="border: 1px solid black;">
                    <font face="zapfdingbats"><?= $jenis_kelamin == 'Laki-laki' ? '4' : '';  ?></font>
                </td>
                <td colspan="2">
                    <font size="10">Laki-laki</font>
                </td>
                <td style="border: 1px solid black;">
                    <?= $jenis_kelamin == 'Perempuan' ? '4' : '';  ?>
                </td>
                <td colspan="2">
                    <font size="10">Perempuan</font>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">5.</font>
                </td>
                <td colspan="2">
                    <font size="10">Golongan Darah</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $golongan_darah ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">6.</font>
                </td>
                <td colspan="2">
                    <font size="10">Alamat</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $alamat ?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td>
                    <font size="10">Kel.</font>
                </td>
                <td colspan="7"><?= $village_name ?></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td>
                    <font size="10">Kab.</font>
                </td>
                <td colspan="7"><?= $district_name ?></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td>
                    <font size="10">Kec.</font>
                </td>
                <td colspan="7"><?= $regency_name ?></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td>
                    <font size="10">Prov.</font>
                </td>
                <td colspan="7"><?= $province_name ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">7.</font>
                </td>
                <td colspan="2">
                    <font size="10">Jenjang</font>
                </td>
                <td style="text-align: center;">:</td>
                <td style="border: 1px solid black;">
                    <font face="zapfdingbats"><?= $jenjang == "I'dadiyah" ? '4' : '';  ?></font>
                </td>
                <td colspan="2">
                    <font size="10">I'dadiyah</font>
                </td>
                <td style="border: 1px solid black;">
                    <font face="zapfdingbats"><?= $jenjang == 'Ibtidaiyah' ? '4' : '';  ?></font>
                </td>
                <td colspan="2">
                    <font size="10">Ibtidaiyah</font>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td></td>
                <td style="border: 1px solid black;">
                    <font face="zapfdingbats"><?= $jenjang == 'Tsanawiyah' ? '4' : '';  ?></font>
                </td>
                <td colspan="2">
                    <font size="10">Tsanawiyah</font>
                </td>
                <td style="border: 1px solid black;">
                    <font face="zapfdingbats"><?= $jenjang == 'Aliyah' ? '4' : '';  ?></font>
                </td>
                <td colspan="2">
                    <font size="10">Aliyah</font>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">8.</font>
                </td>
                <td colspan="2">
                    <font size="10">Email</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $email ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">9.</font>
                </td>
                <td colspan="2">
                    <font size="10">No. Telp/HP</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $no_hp ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">10.</font>
                </td>
                <td colspan="2">
                    <font size="10">No. Kartu Keluarga</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $nomor_kartu_keluarga ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">11.</font>
                </td>
                <td colspan="2">
                    <font size="10">Nama Ayah</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $nama_ayah ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <font size="10">12.</font>
                </td>
                <td colspan="2">
                    <font size="10">Nama Ibu</font>
                </td>
                <td style="text-align: center;">:</td>
                <td colspan="7"><?= $nama_ibu ?></td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>B.</b></td>
                <td colspan="7">
                    <font size="10"><b>LAMPIRAN</b></font>
                </td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td style="border: 1px solid black;">
                    <font face="zapfdingbats"><?= $upload_kartu_keluarga != NULL ? '4' : '';  ?></font>
                </td>
                <td colspan="2">
                    <font size="10">Kartu Kerluarga</font>
                </td>
                <td colspan="5"></td>
                <td style="text-align:center;" colspan="2" rowspan="4">
                    <!-- <font size="10">BARCODE</font> -->
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="border: 1px solid black;">
                    <font face="zapfdingbats"><?= $upload_ijasah != NULL ? '4' : '';  ?></font>
                </td>
                <td colspan="2">
                    <font size="10">Ijazah</font>
                </td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td></td>
                <td style="border: 1px solid black;">
                    <font face="zapfdingbats"><?= $upload_nasab != NULL ? '4' : '';  ?></font>
                </td>
                <td colspan="2">
                    <font size="10">Nasab</font>
                </td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="2">
                    <font size="10"></font>
                </td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12"></td>
            </tr>
        </tbody>
    </table>
</div>