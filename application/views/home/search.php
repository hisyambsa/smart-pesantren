<style>
    .select2-selection__rendered {
        line-height: 40px !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__arrow {
        height: 40px !important;
    }
</style>
<ul class="nav nav-tabs md-tabs red text-center nav-justified red lighten-1" id="myTabMD" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="umroh-tab-md" data-toggle="tab" href="#umroh-md" role="tab" aria-controls="umroh-md" aria-selected="true">Umroh</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tour-tab-md" data-toggle="tab" href="#tour-md" role="tab" aria-controls="tour-md" aria-selected="false">Tour</a>
    </li>
</ul>
<div class="border-dark border-top border-bottom red lighten-2 px-5 rounded-sm">
    <div class="tab-content card pt-5 red lighten-5" id="myTabContentMD">
        <div class="tab-pane fade show active" id="umroh-md" role="tabpanel" aria-labelledby="umroh-tab-md">
            <form class="">
                <div class="row my-3">
                    <div class="col-md-5 my-2">
                        <select class="js-example-basic-single form-control" data-placeholder="Pilih Embarkasi / Keberangkatan" name="state">
                            <option value=""></option>
                            <option value="31">Jakarta / CGK</option>
                            <option value="35">Surabaya / SUB</option>
                        </select>
                    </div>
                    <div class="col-md-5 my-2">
                        <select class="js-example-basic-single form-control" data-placeholder="Pilih Bulan - Tahun" name="state">
                            <option value=""></option>
                            <option value="Januari - 2022">Januari - 2022</option>
                            <option value="Februari - 2022">Februari - 2022</option>
                        </select>
                    </div>
                    <div class="col-md-2 my-1">
                        <button type="submit" class="btn btn-info btn-block">Pencarian</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="tour-md" role="tabpanel" aria-labelledby="tour-tab-md">
            <div class="row align-middle my-3">
                <div class="col-md-5">
                    <label class="mdb-mainl">Kota Tujuan</label>
                    <select class="mdb-select md-fosrm" searchable="Search here..">
                        <option value="" disabled selected></option>
                        <option value="Depok">Depok</option>
                        <option value="Surabaya">Surabaya</option>
                    </select>
                    <label class="mdb-main-label">Pilih Kota Tujuan</label>
                </div>
                <div class="col-md-5">
                    <label class="mdb-main-label">Jumlah Hari</label>
                    <input type="number" class="form-control" placeholder="Masukan Jumlah Hari">
                </div>
                <div class="col-md-2 my-1">
                    <button type="submit" class="btn btn-info btn-block">Pencarian</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Material inline form -->
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Pilih",
                theme: "classic",
                allowClear: true
            });
            $('.js-example-basic-single').select2({
                placeholder: "Pilih",
                theme: "classic",
                allowClear: true
            });
        });
    </script>
</div>