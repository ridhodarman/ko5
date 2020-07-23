<div class="card">
    <article class="filter-group">
        <header class="card-header">
            <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">Cari</h6>
            </a>
        </header>
        <div class="filter-content collapse show" id="collapse_1" style="">
            <div class="card-body">
                <form class="pb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari nama kos">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>

                Popular Keywords:
                <ul class="list-menu">
                    <a class="badge badge-light" href='{{ route("cari") }}/
                            @php echo base64_encode("-0.928748") @endphp/
                            @php echo base64_encode("100.428233") @endphp/
                            @php echo base64_encode("pasar baru") @endphp'>
                        Kos pasar baru
                    </a>
                    <a class="badge badge-light" href='{{ route("cari") }}/
                            @php echo base64_encode("-0.915512") @endphp/
                            @php echo base64_encode("100.457822") @endphp/
                            @php echo base64_encode("kampus unand limau manis") @endphp'>
                        Kos unand limau manis
                    </a>
                    <a class="badge badge-light" href='{{ route("cari") }}/
                            @php echo base64_encode("-0.897338") @endphp/
                            @php echo base64_encode("100.350741") @endphp/
                            @php echo base64_encode("kampus UNP air tawar") @endphp'>
                        Kos unp air tawar
                    </a>
                    <a class="badge badge-light" href='{{ route("cari") }}/
                            @php echo base64_encode("-0.940535") @endphp/
                            @php echo base64_encode("100.366351") @endphp/
                            @php echo base64_encode("kampus FK Unand Jati") @endphp'>
                        Kos FK Unand jati
                    </a>
                </ul>

            </div> <!-- card-body.// -->
        </div>
    </article> <!-- filter-group  .// -->
    <form action='{{ route("cari") }}' method="POST">
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Fasilitas </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_2" style="">
                <div class="card-body">
                    @foreach ($fasilitas as $f)
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="{{$f->id}}" name="fasilitas[]"">
                        <div class="custom-control-label">{{$f->nama}}</div>
                    </label>
                    @endforeach
                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Tipe </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_3" style="">
                <div class="card-body">
                    @foreach ($jenis as $j)
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="{{$j->id}}" name="jenis[]" checked>
                        <div class="custom-control-label">{{$j->nama}}</div>
                    </label>
                    @endforeach
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Status </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_4" style="">
                <div class="card-body">
                    @foreach ($status as $s)
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="{{$s->id}}" name="status[]" checked>
                        <div class="custom-control-label">{{$s->nama}}</div>
                    </label>
                    @endforeach
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Urutkan Berdasarkan </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_5" style="">
                <div class="card-body">
                    <label class="custom-control custom-radio">
                        <input type="radio" name="urutan" checked="" class="custom-control-input" value="harga_rendah">
                        <div class="custom-control-label">Harga Rendah Ke Tinggi</div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="urutan" class="custom-control-input" value="harga_tinggi">
                        <div class="custom-control-label">Harga Tinggi Ke rendah </div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="urutan" id="radio_kampus" class="custom-control-input" value="kampus">
                        <div class="custom-control-label">Paling dekat dengan kampus <font style="color: darkgray;">
                                (pilih kampus)</font>
                        </div>
                        <select class="form-control" id="pilih_kampus">
                            @foreach ($kampus as $k)
                            <option value="{{$k->id}}">{{$k->nama}}</option>
                            @endforeach
                        </select>
                    </label>

                    <script>
                        $("#pilih_kampus").hide();
                        $("[name='urutan']").click(function () {
                            $("#pilih_kampus").hide();
                            if ($('#radio_kampus').is(':checked')) {
                                $("#pilih_kampus").show();
                            }
                        });
                    </script>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_6" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Price range </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_6" style="">
                <div class="card-body">
                    <label class="custom-control custom-radio">
                        <input type="radio" name="atur_harga" class="custom-control-input" id="semua"
                            onclick="aturharga()">
                        <div class="custom-control-label">Semua Harga</div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="atur_harga" class="custom-control-input" onclick="aturharga()"
                            id="show_harga">
                        <div class="custom-control-label">Tetapkan Rentang Harga</div>
                    </label>
                    <div id="rentangnya">
                        <div style="float: right;"><label>Rp. <font id="nilai"></font></label></div>
                        <input type="range" class="custom-range" min="0" max="150" name="" onchange="teksharga()"
                            id="harga">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Min</label>
                                <input class="form-control" placeholder="0" type="number" name="min" id="teks-min">
                            </div>
                            <div class="form-group text-right col-md-6">
                                <label>Max</label>
                                <input class="form-control" placeholder="Rp 10000" type="number" id="teks-harga" name="max">
                            </div>
                        </div> <!-- form-row.// -->
                    </div>
                    <script>
                        $("#rentangnya").hide();
                        document.getElementById("teks-min").value = 0;
                        document.getElementById("teks-harga").value = 99999999999999;
                        function aturharga() {
                            if ($('#show_harga').is(':checked')) {
                                $("#rentangnya").show();
                                teksharga();
                            }
                            else if ($('#semua').is(':checked')) {
                                $("#rentangnya").hide();
                                document.getElementById("teks-min").value = 0;
                                document.getElementById("teks-harga").value = 99999999999999;
                            }
                        }

                        function teksharga() {
                            //alert(document.getElementById("harga").value)
                            let nilai = $("#harga").val() * 100000;
                            let nilai2 = (nilai).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                            nilai2 = nilai2.replace(".00", "");
                            nilai2 = nilai2.replace(/\,/g, ".");
                            document.getElementById("teks-harga").value = nilai;
                            $("#nilai").html(nilai2);
                        }
                    </script>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <div style="width: 120%; background-color: white; margin-left: -5px;">&nbsp;</div>
        @csrf
        <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-search"></i> Cari</button>
    </form>
</div> <!-- card.// -->