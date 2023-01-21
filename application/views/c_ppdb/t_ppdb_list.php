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
<div class="row">
    <div class="col-md-4 text-center mt-2">
        <?php echo anchor(site_url('c_ppdb/create'), 'Buat', 'class="btn btn-primary btn-rounded d-inline"'); ?>
        <br>
        <br>
    </div>
    <div class="col-md-4 text-center">
        <h2 style="margin-top:0px">Daftar T_ppdb</h2>

    </div>
    <div id="" class="col-md-4 text-center h6">
        <?php if (isset($pagination)) { ?>
            <form action="<?php echo site_url('c_ppdb/index'); ?>" class="form-group" method="get">
                <div class="input-group">
                    <input type="text" class="form-control mt-2" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php
                        if ($q <> '') {
                        ?>
                            <a href="<?php echo site_url('c_ppdb'); ?>" class="btn btn-amber">Ulangi</a>
                        <?php
                        }
                        ?>
                        <button class="btn btn-dark-green" type="submit">Cari</button>
                    </span>
                </div>
            </form>
        <? } else { ?>
            <?php // do nothing 
            ?>
        <?php } ?>
    </div>
</div>
<div class="table-responsive">
    <table class="dataTableRun table-hover text-center text-nowrap display" width="100%">
        <thead>
            <tr>
                <th class="th-sm">No</th>
                <th class="th-sm">No Pendaftaran</th>
                <th class="th-sm">Nik Santri</th>
                <th class="th-sm">Nama Santri</th>
                <th class="th-sm">Jenis Kelamin</th>
                <th class="th-sm">Tempat Lahir</th>
                <th class="th-sm">Tanggal Lahir</th>
                <th class="th-sm">Alamat</th>
                <th class="th-sm">Jenjang</th>
                <th class="th-sm">Nama Ayah</th>
                <th class="th-sm">Nama Ibu</th>
                <th class="th-sm">Golongan Darah</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Timestamp</th>
                <th class="th-sm">Create By</th>
                <th class="th-sm">Modify</th>
                <th class="th-sm">Modify By</th>
                <th class="th-sm">Delete At</th>
                <?php if (isset($pagination)) { ?>

                    <th class="th-sm">Aksi</th>
                <?php } else { ?>

                <?php } ?>
            </tr>
        </thead><?php
                foreach ($c_ppdb_data as $c_ppdb) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $c_ppdb->no_pendaftaran ?></td>
                <td><?php echo $c_ppdb->nik_santri ?></td>
                <td><?php echo $c_ppdb->nama_santri ?></td>
                <td><?php echo $c_ppdb->jenis_kelamin ?></td>
                <td><?php echo $c_ppdb->tempat_lahir ?></td>
                <td><?php echo $c_ppdb->tanggal_lahir ?></td>
                <td><?php echo $c_ppdb->alamat ?></td>
                <td><?php echo $c_ppdb->jenjang ?></td>
                <td><?php echo $c_ppdb->nama_ayah ?></td>
                <td><?php echo $c_ppdb->nama_ibu ?></td>
                <td><?php echo $c_ppdb->golongan_darah ?></td>
                <td><?php echo $c_ppdb->status ?></td>
                <td><?php echo $c_ppdb->timestamp ?></td>
                <td><?php echo $c_ppdb->create_by ?></td>
                <td><?php echo $c_ppdb->modify ?></td>
                <td><?php echo $c_ppdb->modify_by ?></td>
                <td><?php echo $c_ppdb->delete_at ?></td>
                <?php if (isset($pagination)) { ?>
                    <td style="text-align:center">
                        <a href="<?php echo base_url() . 'c_ppdb/read/' . $c_ppdb->id ?>" class="btn btn-sm btn-info" data-toggle="tooltip" title="Lihat">
                            <span class="fa fa-eye"></span>
                        </a>
                        <a onclick="alert('Anda akan diarahkan ke form Ubah data')" href="<?php echo base_url() . 'c_ppdb/update/' . $c_ppdb->id ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah">
                            <span class="fa fa-edit"></span>
                        </a>
                        <a onclick="return confirm('anda yakin akan menghapus data?')" href="<?php echo base_url() . 'c_ppdb/delete/' . $c_ppdb->id ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                <?php } else { ?>

                <?php } ?>
            </tr>
        <?php
                }
        ?>
        <tfoot>
            <tr>
                <th class="th-sm">No</th>
                <th class="th-sm">No Pendaftaran</th>
                <th class="th-sm">Nik Santri</th>
                <th class="th-sm">Nama Santri</th>
                <th class="th-sm">Jenis Kelamin</th>
                <th class="th-sm">Tempat Lahir</th>
                <th class="th-sm">Tanggal Lahir</th>
                <th class="th-sm">Alamat</th>
                <th class="th-sm">Jenjang</th>
                <th class="th-sm">Nama Ayah</th>
                <th class="th-sm">Nama Ibu</th>
                <th class="th-sm">Golongan Darah</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Timestamp</th>
                <th class="th-sm">Create By</th>
                <th class="th-sm">Modify</th>
                <th class="th-sm">Modify By</th>
                <th class="th-sm">Delete At</th><?php if (isset($pagination)) { ?>

                    <th class="th-sm">Aksi</th>
                <?php } else { ?>

                <?php } ?>

            </tr>
        </tfoot>
    </table>
</div>


<?php if (isset($pagination)) {
    echo $pagination;
} else { ?>
    <script defer>
        $(document).ready(function() {
            $('.dataTableRun').DataTable({
                responsive: true,
            });
        });
    </script>
<?php } ?>