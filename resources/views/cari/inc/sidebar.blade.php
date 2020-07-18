
    <div class="card">
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true"
                    class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Cari</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_1" style="">
                <div class="card-body">
                    <form class="pb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-light" type="button"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    Popular Keywords:
                    <ul class="list-menu">
                        <a href="#" class="badge badge-light">Kos pasar baru </a>
                        <a class="badge badge-light" 
                            href='{{ route('cari') }}/1/2/@php echo base64_encode("Kos cowok unand") @endphp' >
                            Kos cowok unand
                        </a>
                        <a href="#" class="badge badge-light">Kos cewek unand </a>
                        <a href="#" class="badge badge-light">Kos cowok unp </a>
                        <a href="#" class="badge badge-light">Kos cewek unp </a>
                        <a href="#" class="badge badge-light">Kontrakan unand </a>
                        <a href="#" class="badge badge-light">Kontrakan unp</a>
                    </ul>

                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group  .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true"
                    class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Fasilitas </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_2" style="">
                <div class="card-body">
                    
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" checked="" class="custom-control-input">
                        <div class="custom-control-label">Mercedes
                            <b class="badge badge-pill badge-light float-right">120</b> </div>
                    </label>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" checked="" class="custom-control-input">
                        <div class="custom-control-label">Toyota
                            <b class="badge badge-pill badge-light float-right">15</b> </div>
                    </label>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" checked="" class="custom-control-input">
                        <div class="custom-control-label">Mitsubishi
                            <b class="badge badge-pill badge-light float-right">35</b> </div>
                    </label>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" checked="" class="custom-control-input">
                        <div class="custom-control-label">Nissan
                            <b class="badge badge-pill badge-light float-right">89</b> </div>
                    </label>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input">
                        <div class="custom-control-label">Honda
                            <b class="badge badge-pill badge-light float-right">30</b> </div>
                    </label>
                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true"
                    class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Price range </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_3" style="">
                <div class="card-body">
                    <div style="float: right;"><label>Rp. <font id="nilai"></font></label></div>
                    <input type="range" class="custom-range" min="0" max="150" name="" onchange="tes()" id="harga">
                    <script>
                        function tes(){
                            //alert(document.getElementById("harga").value)
                            let nilai = $("#harga").val() *100000;
                            let nilai2 = (nilai).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                            document.getElementById("teks-harga").value = nilai;
                            $( "#nilai" ).html(nilai2);
                        }
                    </script>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Min</label>
                            <input class="form-control" placeholder="$0" type="number">
                        </div>
                        <div class="form-group text-right col-md-6">
                            <label>Max</label>
                            <input class="form-control" placeholder="Rp 10000" type="number" id="teks-harga">
                        </div>
                    </div> <!-- form-row.// -->
                    <button class="btn btn-block btn-primary">Apply</button>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true"
                    class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Sizes </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_4" style="">
                <div class="card-body">
                    <label class="checkbox-btn">
                        <input type="checkbox">
                        <span class="btn btn-light"> XS </span>
                    </label>

                    <label class="checkbox-btn">
                        <input type="checkbox">
                        <span class="btn btn-light"> SM </span>
                    </label>

                    <label class="checkbox-btn">
                        <input type="checkbox">
                        <span class="btn btn-light"> LG </span>
                    </label>

                    <label class="checkbox-btn">
                        <input type="checkbox">
                        <span class="btn btn-light"> XXL </span>
                    </label>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false"
                    class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">More filter </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_5" style="">
                <div class="card-body">
                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" checked=""
                            class="custom-control-input">
                        <div class="custom-control-label">Any condition</div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Brand new </div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Used items</div>
                    </label>

                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Very old</div>
                    </label>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
    </div> <!-- card.// -->
