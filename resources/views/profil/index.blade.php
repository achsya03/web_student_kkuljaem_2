@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" />
@endsection

@section('title')
    {{ env('APP_NAME') }} | Profil
@endsection

@section('content')
    <!-- Top Menu -->
    <div class="container mt-5">
        <!-- tab-menu -->
        <ul class="nav mb-5" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link mr-4 top-menu active " id="pills-home-tab" data-toggle="pill" href="#akun-pengguna"
                    role="tab" aria-controls="pills-home" aria-selected="true">
                    <h3 class=" pb-1 font-weight-bold ">Akun Pengguna</h3>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link top-menu " id="pills-profile-tab" data-toggle="pill" href="#lain-lain" role="tab"
                    aria-controls="pills-profile" aria-selected="false">
                    <h3 class=" pb-1  font-weight-bold">Lain-lain</h3>
                </a>
            </li>
        </ul>
        <!-- end tab menu -->

        <!-- tab content -->
        <div class="tab-content" id="pills-tabContent">
            <!-- .content-akun-pengguna -->
            <div class="tab-pane fade show active" id="akun-pengguna" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="container">
                    <!-- Profile and name -->
                    <div class="profile-akun d-flex justify-content-between align-items-center">
                        <div class="avatar-name">
                            <img src="{{ asset('assets/img/avatar.png') }}" alt="Avatar " class="float-left mr-3 avatar">
                            <div class="d-flex flex-column mt-4 ">
                                <h5 class="font-weight-bold">{{ $profil->nama }}</h5>
                                <p>{{ $profil->email }}</p>
                            </div>
                        </div>
                        <div class="marker">
                            <h5 class="font-weight-bold">Akun Premium</h5>
                        </div>
                    </div>

                    <!-- Profile and name -->
                    <!-- alert -->
                    {{-- <div class="alert alert-profile-premium mt-4 mb-5" role="alert">
                        <i class="far fa-calendar-alt ml-1 mr-3"></i> Masa berakhir akun premium pada 
                    </div> --}}
                    <!-- end alert -->

                    @if ($profil->tempat_lahir == '-' || $profil->tempat_lahir == null)
                        <!-- alert -->
                        <div class="alert alert-profile mt-4 mb-5" role="alert">
                            <i class="far fa-user-circle ml-1 mr-3"></i> Tinggal selangkah lagi nih, ayo lengkapi profilmu
                        </div>
                        <!-- end alert -->
                    @else
                    @endif
                    @if (session('success'))

                        <div class="alert alert-profile-premium mt-4 mb-5" role="alert">
                            <i class="far fa-user-circle ml-1 mr-3"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if (session('failed'))
                        <!-- alert -->
                        <div class="alert alert-profile mt-4 mb-5" role="alert">
                            <i class="far fa-user-circle ml-1 mr-3"></i> {{ session('failed') }}
                        </div>
                    @endif

                    <!-- Pengaturan Akun -->
                    <div class="container">
                        <div class="row pengaturan-akun">
                            <div class="col-4 left">
                                <h6 class="mt-1 mb-3">Akun Pengguna</h6>
                                <div class="list-group font-weight-bold" id="list-tab" role="tablist">
                                    <a class=" list-group-item-action active" id="list-home-list" data-toggle="list"
                                        href="#list-profile-saya" role="tab" aria-controls="home"><i
                                            class="far fa-user-circle mr-3"></i> Profile Saya</a>
                                    <a class=" list-group-item-action" id="list-profile-list" data-toggle="list"
                                        href="#list-ubah-sandi" role="tab" aria-controls="profile"><i
                                            class="fal fa-key mr-3"></i>Ubah Kata Sandi</a>
                                    <a class=" list-group-item-action" id="list-messages-list" data-toggle="list"
                                        href="#list-langganan" role="tab" aria-controls="messages"><i
                                            class="fal fa-wallet mr-3"></i>Langganan</a>
                                    <a class=" list-group-item-action" href="{{ route('pembayaran.index') }}"><i
                                            class="fal fa-wallet mr-3"></i>Pembayaran</a>
                                </div>
                            </div>
                            <div class="col-8 right">
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- List Profile Saya -->
                                    <!-- Banner Promo -->
                                    {{-- @if ($account->status_member == 'Non-Member') --}}
                                    <div class="banner">
                                        <a href="">
                                            <img src="{{ asset('assets/img/Bannerpromo.png') }}" alt="Banner Promo"
                                                class="banner-promo mb-3">
                                        </a>
                                    </div>

                                    {{-- @else

                                    @endif --}}
                                    <!-- End Banner Promo -->

                                    <div class="tab-pane fade show active" id="list-profile-saya" role="tabpanel"
                                        aria-labelledby="list-home-list">

                                        <form class="form theme-form pb-5 f1"
                                            action="{{ route('profil.update_profil') }}" method="POST">
                                            @csrf
                                            <div class="form-group font-weight-bold">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ $profil->nama }}" placeholder="Your Text">
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label for="jenis-kelamin">Jenis Kelamin</label>
                                                <select class="form-control" name="jenis_kel" id="jenis-kelamin">
                                                    <option value="laki" @if (old('jenis_kel', $profil->jenis_kel) == 'laki')
                                                        selected @endif>Laki-laki</option>
                                                    <option value="perempuan" @if (old('jenis_kel', $profil->jenis_kel) == 'perempuan')
                                                        selected @endif>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label for="tempat-lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir"
                                                    value="{{ $profil->tempat_lahir }}" class="form-control"
                                                    id="tempat-lahir" placeholder="Your Text">
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label for="tanggal-lahir">Tanggal Lahir</label>
                                                <input type="date" name="tgl_lahir" class="form-control"
                                                    id="tanggal-lahir" value="{{ $profil->tgl_lahir }}"
                                                    placeholder="DD/MM/YY">
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label for="alamat">Alamat</label>
                                                <textarea class="form-control" name="alamat" id="alamat" rows=""
                                                    placeholder="Your Text">{{ $profil->alamat }}</textarea>
                                            </div>
                                            <div class="form-group d-flex justify-content-end">
                                                <button type="submit" class="btn btn-save ml-auto">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- End List Profile Saya -->
                                    <div class="tab-pane fade" id="list-ubah-sandi" role="tabpanel"
                                        aria-labelledby="list-profile-list">
                                        <form class="form theme-form pb-5 f1"
                                            action="{{ route('profil.change_password') }}" method="POST">
                                            @csrf

                                            <div class="form-group font-weight-bold">
                                                <label for="sandi-baru">Kata Sandi Lama</label>
                                                <input type="password" name="password_old" class="form-control"
                                                    id="sandi-baru" placeholder="Masukkan kata sandi Lama Anda">
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label for="sandi-baru">Kata Sandi Baru</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="sandi-baru" placeholder="Masukkan kata sandi baru Anda">
                                            </div>
                                            <div class="form-group font-weight-bold">
                                                <label for="konfirmasi-sandi">Konfirmasi Kata Sandi Baru</label>
                                                <input type="password" name="password_confirmation" class="form-control"
                                                    id="konfirmasi-sandi"
                                                    placeholder="Masukkan Konfirmasi Kata Sandi Baru Anda">
                                            </div>
                                            <div class="form-group d-flex justify-content-end">
                                                <button type="submit" class="btn btn-save ml-auto">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Langganan -->
                                    <div class="tab-pane fade show" id="list-langganan" role="tabpanel"
                                        aria-labelledby="list-messages-list">
                                        <h6 class="font-weight-bold my-4 title"> Langganan</h6>
                                        <div class="accordion" id="accordionHistory">
                                            @if ($histori == null)

                                            @else
                                                @foreach ($histori->subscription as $history)
                                                    <div class="card mb-3">
                                                        <div class="card-header" id="headingOne">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link btn-block text-left"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#collapseOne{{ $history->subs_uuid }}"
                                                                    aria-expanded="true" aria-controls="collapseOne">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex flex-column">
                                                                            <p class="font-weight-bold mb-0">Paket
                                                                                {{ $history->lama_paket }} Bulan</p>
                                                                            <p>{{ date('d m Y - H.i', strtotime($history->tgl_subs)) }}
                                                                            </p>
                                                                        </div>

                                                                        @if ($history->subs_status == 'SUKSES')
                                                                            <p class="status status-success">Berhasil</p>
                                                                        @elseif($history->subs_status=="GAGAL")
                                                                            <p class="status status-danger">Gagal</p>
                                                                        @elseif($history->subs_status=="TUNGGU")
                                                                            <p class="status status-warning">Tunggu</p>
                                                                        @endif

                                                                    </div>
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="collapseOne{{ $history->subs_uuid }}"
                                                            class="collapse show" aria-labelledby="headingOne"
                                                            data-parent="#accordionHistory">

                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-6 detail-left">
                                                                        <div class="d-flex flex-column">
                                                                            <p class="mb-0 label-history">Label Pesanan</p>
                                                                            <p class="detail-label-history">paket premium
                                                                                {{ $history->lama_paket }} bulan</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6 detail-right">
                                                                        <div class="d-flex flex-column align-items-end">
                                                                            <p class="mb-0 label-history">Periode Pesanan
                                                                            </p>
                                                                            <p class="detail-label-history">
                                                                                {{ date('d m Y', strtotime($history->tgl_subs)) }}
                                                                                -
                                                                                {{ date('d m Y', strtotime($history->tgl_subs)) }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="d-flex flex-column align-items-end">
                                                                            <p class="mb-0 label-history">Nominal</p>
                                                                            <p class="detail-label-history">
                                                                                {{ 'Rp ' . number_format($history->harga, 2, ',', '.') }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif


                                        </div>
                                    </div>
                                    <!-- End Langganan -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Pengaturan Akun -->

                </div>
            </div>

            <!-- end content akun pengguna -->

            <!-- content lain-lain -->
            <div class="tab-pane fade show" id="lain-lain" role="tabpanel" aria-labelledby="pills-profile-tab">
                <img src="../Assets/img/banner-promo.png" alt="" class="banner-promo">
                <div class="container">
                    <!-- Pengaturan Lain-lain -->

                    <div class="container">
                        <div class="row pengaturan-akun">

                            <!-- Menu Kiri -->
                            <div class="col-4 left">

                                <h6 class="mt-1 mb-3 my-4 title">Lain-lain</h6>
                                <div class="list-group font-weight-bold" id="list-tab" role="tablist">
                                    <a class=" list-group-item-action active" id="list-home-list" data-toggle="list"
                                        href="#list-nilai-kami" role="tab" aria-controls="home"><i
                                            class="far fa-user-circle mr-3"></i> Nilai Kami</a>
                                    <a class=" list-group-item-action" id="list-profile-list" data-toggle="list"
                                        href="#list-keluhan" role="tab" aria-controls="profile"><i
                                            class="fal fa-key mr-3"></i>Kirim Keluhan</a>
                                    <a class=" list-group-item-action" id="list-messages-list" data-toggle="list"
                                        href="#list-about" role="tab" aria-controls="messages"><i
                                            class="far fa-question-circle mr-3"></i>About Kkuljaem</a>
                                    <a class=" list-group-item-action " id="list-messages-list" data-toggle="list"
                                        href="#list-term-condition" role="tab" aria-controls="messages"><i
                                            class="far fa-question-circle mr-3 "></i>Term & Condition</a>
                                    <a class=" list-group-item-action" id="list-messages-list" data-toggle="list"
                                        href="#list-privacy-policy" role="tab" aria-controls="messages"><i
                                            class="far fa-file-alt mr-3"></i>Privacy & Policy</a>

                                </div>

                            </div>


                            <!-- End Menu Kiri -->
                            <!-- Content Kanan -->
                            <div class="col-8 right">
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- List Nilai Kami -->
                                    <div class="tab-pane fade show active" id="list-nilai-kami" role="tabpanel"
                                        aria-labelledby="list-home-list">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit
                                        necessitatibus quo nesciunt voluptatem magnam architecto nobis quisquam. Nam ipsum
                                        facere temporibus. Sunt dolorem porro modi rem non natus, vero fugiat debitis! Rem
                                        perspiciatis minus
                                        id tempore dolores, sapiente aut nam placeat atque accusantium ipsa repudiandae
                                        rerum pariatur? Veritatis, ullam doloremque. Culpa vel sed ab atque sint eum
                                        assumenda nisi dicta, reiciendis accusamus. Placeat, enim.
                                        Sapiente, quas alias? Sit quam praesentium suscipit amet dolore sequi incidunt ullam
                                        ducimus autem in vero eum velit quia qui tenetur, quasi atque maxime dicta illo
                                        deserunt quo consequatur tempore officia rerum!
                                        Reiciendis odit molestiae sapiente laudantium eius nobis repellat blanditiis quod
                                        dolor quisquam, dolorem a, rerum fuga officia? Atque dicta excepturi, alias repellat
                                        deleniti perferendis aliquid dolor nobis, debitis
                                        neque illo, in omnis necessitatibus cum quasi qui maxime! Suscipit ea, magni nobis
                                        animi numquam adipisci repudiandae consequuntur eveniet et dolor ducimus impedit
                                        illum harum, cum doloremque temporibus vel ad cupiditate
                                        aspernatur eius libero? Totam soluta unde id et dolorem deserunt, expedita quas!
                                        Amet, tempora voluptates? Sapiente nulla suscipit esse corrupti in quis ratione
                                        maiores est quod libero sequi, neque quam tempora
                                        eaque ipsum natus nisi! Fugit repudiandae, aliquam maxime veritatis necessitatibus,
                                        veniam aut, voluptates iusto assumenda error hic corrupti dicta laudantium. Itaque
                                        non officia perspiciatis molestiae eos labore,
                                        in reiciendis modi quo excepturi incidunt vero ipsum ullam minima optio iusto
                                        tenetur aliquid! Possimus quisquam maiores repudiandae, enim eos saepe minus
                                        repellat ullam! Veniam officia vel commodi. Ipsa accusamus
                                        praesentium fugiat quam quas rem dicta delectus labore dignissimos unde nemo
                                        corrupti maiores commodi ex tempore aliquid temporibus amet expedita voluptates
                                        beatae iure, quos cupiditate! Quidem et nemo ipsam maxime
                                        rem beatae quibusdam, molestiae quisquam aperiam! Blanditiis praesentium
                                        reprehenderit vel quos asperiores totam ipsa culpa ipsam consequuntur iusto,
                                        cupiditate aut fugit illum distinctio natus aspernatur in suscipit
                                        iure tempora recusandae eligendi pariatur error. Officia nostrum nisi laborum, alias
                                        earum repellendus. Blanditiis pariatur, vitae, autem, eos voluptate quas fugiat
                                        placeat error recusandae molestias saepe delectus.
                                        Pariatur tenetur autem libero? Vitae facere, itaque, numquam, at voluptatem saepe
                                        illo debitis explicabo dolore ea magnam similique alias optio. Earum deleniti omnis
                                        fugit reiciendis placeat fugiat ipsum eaque enim,
                                        pariatur mollitia dolorum consequatur consequuntur sint molestias molestiae sequi
                                        dolore non cum ut. Ut beatae voluptatum dicta ad. Quasi, ipsam! Mollitia non
                                        incidunt quo commodi perferendis nemo, quos suscipit
                                        facilis, cupiditate corporis, esse aspernatur natus dicta dolor velit eius veritatis
                                        vel quibusdam? Deserunt vitae hic architecto neque exercitationem praesentium magnam
                                        illum molestias dolorem sunt debitis eligendi
                                        reprehenderit expedita accusamus, earum quisquam laborum, a sapiente doloribus
                                        facilis! Incidunt at dignissimos omnis unde ea repellendus temporibus eos reiciendis
                                        quia modi labore voluptas aut dolorum ratione,
                                        quidem harum nisi cupiditate ipsam minus voluptatem quisquam! Quis quas impedit
                                        quaerat qui pariatur suscipit fugiat ex error possimus quidem, explicabo odio.
                                        Expedita ipsa fugiat eveniet voluptatem architecto,
                                        ullam dolor aut qui rem ipsam accusamus iusto reprehenderit tenetur mollitia aliquam
                                        iste tempora facilis explicabo vel. Quis porro nesciunt repellat reiciendis aut
                                        itaque explicabo veritatis facilis adipisci soluta
                                        error, culpa nam.
                                    </div>
                                    <!-- End List Nilai Kami -->
                                    <!-- List Kirim Keluhan -->
                                    <div class="tab-pane fade show" id="list-keluhan" role="tabpanel"
                                        aria-labelledby="list-profile-list">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, unde libero,
                                        reprehenderit placeat quo molestiae quisquam repellendus eius nihil nam impedit
                                        blanditiis debitis sit aliquid quasi dolore reiciendis ad animi obcaecati neque.
                                        Velit quae vel
                                        ipsum corporis modi eos, maiores a, maxime quisquam minima rem esse sunt dolor eius
                                        dolorem, obcaecati soluta id mollitia cum placeat quibusdam sit? Ipsum temporibus
                                        neque earum, accusamus vel animi quis cum tempore
                                        magni, quae dicta ab aliquid esse ea blanditiis quas omnis! Accusantium tempore
                                        cupiditate molestias atque dolor itaque, quod officia ex tenetur, soluta vitae! Ab
                                        eos, repellat quas illo a maiores enim, ullam sint
                                        accusamus impedit nemo laboriosam libero, natus beatae pariatur! Illum quos magni
                                        molestiae incidunt, velit voluptatum asperiores in assumenda repudiandae laudantium
                                        possimus ipsam itaque vero. Ut, tempora temporibus.
                                        Laudantium, ex dolorum omnis, laboriosam dicta quia commodi vero doloremque quasi
                                        laborum illo eos nisi sit! Ratione pariatur, repellat repudiandae dolorem ut neque
                                        non, odit mollitia praesentium saepe, molestiae
                                        unde eaque quaerat laboriosam! Soluta optio, molestias, dolorem nostrum facere modi
                                        eveniet vel, enim unde consequatur minus similique ducimus nihil esse eum! Rem
                                        consectetur sequi rerum? Nostrum id unde voluptates!
                                        Asperiores, eos illo iusto laborum rerum modi assumenda ut cum dolores doloribus
                                        itaque soluta nesciunt, in, pariatur deleniti aperiam quibusdam. Labore, pariatur
                                        assumenda! Esse nihil optio sapiente velit odit,
                                        iste architecto possimus provident obcaecati veritatis porro neque iusto atque nam
                                        corrupti assumenda sed, temporibus incidunt accusamus. Placeat exercitationem
                                        molestiae beatae rem, tenetur odit iusto molestias
                                        quis. Obcaecati, consectetur, perferendis vitae autem earum assumenda iusto ipsam
                                        iste minus quibusdam nam porro dolor id dolorem ex optio possimus sit neque
                                        similique hic qui est quod expedita. Incidunt sunt quibusdam
                                        veniam quo dolores ipsam ullam modi. Quisquam vel repudiandae nisi maxime ad
                                        quibusdam quis! Consequuntur beatae molestiae aut dicta harum repellat sed
                                        dignissimos delectus quod repellendus minima omnis facere ex
                                        necessitatibus deleniti laudantium non vitae quam, aspernatur labore. Voluptates
                                        illo a enim, aspernatur ipsum nulla iste id ea sint dolor repellendus tenetur culpa
                                        eveniet dolores cumque nihil repellat suscipit,
                                        quas asperiores quae harum iusto? Nobis dolore error repellat illum tempore adipisci
                                        accusantium. Eum inventore aliquam vel dignissimos harum doloremque voluptas odit,
                                        pariatur omnis asperiores. Esse, fugit rem!
                                        Est quae repellat molestiae unde sunt ipsa iste, soluta neque ducimus! Maxime
                                        placeat alias itaque nemo fugiat tempore enim vero, blanditiis accusantium
                                        laudantium praesentium, nulla facilis eum earum animi commodi?
                                        Qui autem corporis excepturi totam placeat amet eligendi doloribus odio voluptas.
                                        Accusamus nulla magnam iste doloribus expedita veritatis quam modi molestias!
                                        Tenetur officia neque eveniet, hic porro odit sed id
                                        illum quae consectetur. Aspernatur, labore officiis a fugit expedita autem corporis?
                                        Explicabo repellat velit saepe eligendi at provident dignissimos commodi iusto
                                        excepturi necessitatibus recusandae ratione rem,
                                        rerum magnam possimus, incidunt similique? Temporibus molestias vitae adipisci
                                        eaque, quaerat ea pariatur sunt et eligendi omnis suscipit ullam natus earum tenetur
                                        blanditiis, delectus aspernatur. Accusamus enim
                                        assumenda id consequatur rerum. Nihil animi eligendi, id odio cupiditate vero quidem
                                        quod laborum consequatur sunt ad temporibus accusantium assumenda aperiam aliquam
                                        non iure eos beatae.
                                    </div>
                                    <!-- List Kirim Keluhan -->
                                    <!-- List About -->
                                    <div class="tab-pane fade show" id="list-about" role="tabpanel"
                                        aria-labelledby="list-messages-list">
                                        <img src="../Assets/img/img-example.png" alt="Img-About" class="img-about">
                                        <h6 class="font-weight-bold mt-4 title">Why Kkuljaem?</h6>
                                        <div class="paragraph">
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Duis lectus at a suspendisse vivamus at netus ullamcorper purus. Enim
                                                enim, feugiat sed nec. Mauris id pharetra felis.</p>
                                        </div>
                                        <div class="paragraph my-4">
                                            <h6 class="font-weight-bold title-2">Jangan belajar sendiri</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Duis lectus at a suspendisse vivamus at netus ullamcorper purus. Enim
                                                enim, feugiat sed nec. Mauris id pharetra felis.</p>
                                        </div>
                                        <div class="paragraph my-4">
                                            <h6 class="font-weight-bold title-2">Keuntungan Menjadi Member</h6>
                                            <p class="text-justify mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. </p>
                                            <ul>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Elit vulputate venenatis cursus vel in purus morbi. Vitae turpis et
                                                    enim.</li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                            </ul>
                                        </div>
                                        <div class="paragraph my-4">
                                            <h6 class="font-weight-bold title-2">Testimoni</h6>
                                            <div class="testimoni mb-3">
                                                <p class="p-testimoni">"Walaupun sistem online, asisten gurunya fast
                                                    respon banget, penjelasan dari asisten guru pun dapat dimengerti.
                                                    Pelafalan saya yg awalnya kurang bagus, sedikit demi sedikit membaik
                                                    karena dibimbing oleh
                                                    guru dan asisten guru."
                                                </p>
                                                <hr class="line-testimoni">
                                                <h6 class="text-uppercase">TERESA</h6>
                                                <p class="detail-user pl-1"> 30 thn, Karyawan Swasta - Kelas Percakapan
                                                    Gangnam 4B</p>
                                            </div>

                                            <div class="testimoni mb-3">
                                                <p class="p-testimoni">"Walaupun sistem online, asisten gurunya fast
                                                    respon banget, penjelasan dari asisten guru pun dapat dimengerti.
                                                    Pelafalan saya yg awalnya kurang bagus, sedikit demi sedikit membaik
                                                    karena dibimbing oleh
                                                    guru dan asisten guru."
                                                </p>
                                                <hr class="line-testimoni">
                                                <h6 class="text-uppercase">TERESA</h6>
                                                <p class="detail-user pl-1"> 30 thn, Karyawan Swasta - Kelas Percakapan
                                                    Gangnam 4B</p>
                                            </div>

                                            <div class="testimoni mb-3">
                                                <p class="p-testimoni">"Walaupun sistem online, asisten gurunya fast
                                                    respon banget, penjelasan dari asisten guru pun dapat dimengerti.
                                                    Pelafalan saya yg awalnya kurang bagus, sedikit demi sedikit membaik
                                                    karena dibimbing oleh
                                                    guru dan asisten guru."
                                                </p>
                                                <hr class="line-testimoni">
                                                <h6 class="text-uppercase">TERESA</h6>
                                                <p class="detail-user pl-1"> 30 thn, Karyawan Swasta - Kelas Percakapan
                                                    Gangnam 4B</p>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- End List About -->
                                    <!-- List Term & Condition -->
                                    <div class="tab-pane fade show " id="list-term-condition" role="tabpanel"
                                        aria-labelledby="list-messages-list">
                                        <h6 class="font-weight-bold my-4 title-main">Term & Condition</h6>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title">Header 1</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Duis lectus at a suspendisse vivamus at netus ullamcorper purus. Enim
                                                enim, feugiat sed nec. Mauris id pharetra felis.</p>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title-2">Header 4</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Id arcu tristique id elementum enim, nisl orci ac dis. Elit vulputate
                                                venenatis cursus vel in purus morbi. Vitae turpis et enim.</p>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title-2">Header 4</h6>
                                            <p class="text-justify mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. </p>
                                            <ul>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Elit vulputate venenatis cursus vel in purus morbi. Vitae turpis et
                                                    enim.</li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                            </ul>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title">Header 1</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Duis lectus at a suspendisse vivamus at netus ullamcorper purus. Enim
                                                enim, feugiat sed nec. Mauris id pharetra felis.</p>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title-2">Header 4</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Id arcu tristique id elementum enim, nisl orci ac dis. Elit vulputate
                                                venenatis cursus vel in purus morbi. Vitae turpis et enim.</p>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title-2">Header 4</h6>
                                            <p class="text-justify mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. </p>
                                            <ul>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Elit vulputate venenatis cursus vel in purus morbi. Vitae turpis et
                                                    enim.</li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                            </ul>
                                        </div>

                                    </div>
                                    <!-- End List Term & Condition -->
                                    <!-- List Privacy & Policy -->
                                    <div class="tab-pane fade show" id="list-privacy-policy" role="tabpanel"
                                        aria-labelledby="list-messages-list">
                                        <h6 class="font-weight-bold my-4 title-main">Privacy & Policy</h6>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title">Header 1</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Duis lectus at a suspendisse vivamus at netus ullamcorper purus. Enim
                                                enim, feugiat sed nec. Mauris id pharetra felis.</p>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title-2">Header 4</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Id arcu tristique id elementum enim, nisl orci ac dis. Elit vulputate
                                                venenatis cursus vel in purus morbi. Vitae turpis et enim.</p>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title-2">Header 4</h6>
                                            <p class="text-justify mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. </p>
                                            <ul>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Elit vulputate venenatis cursus vel in purus morbi. Vitae turpis et
                                                    enim.</li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                            </ul>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title">Header 1</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Duis lectus at a suspendisse vivamus at netus ullamcorper purus. Enim
                                                enim, feugiat sed nec. Mauris id pharetra felis.</p>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title-2">Header 4</h6>
                                            <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Id arcu tristique id elementum enim, nisl orci ac dis. Elit vulputate
                                                venenatis cursus vel in purus morbi. Vitae turpis et enim.</p>
                                        </div>
                                        <div class="paragraph">
                                            <h6 class="font-weight-bold title-2">Header 4</h6>
                                            <p class="text-justify mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. </p>
                                            <ul>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Elit vulputate venenatis cursus vel in purus morbi. Vitae turpis et
                                                    enim.</li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                                <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End List Privacy & Policy -->
                                    <!-- End Content Kanan -->
                                </div>
                            </div>


                            <!-- Button-Keluar -->
                            <div class="row pengaturan-akun-keluar">
                                <div class="col-12 left-keluar align-items-content">
                                    <div class="list-group font-weight-bold " id="list-tab" role="tablist">
                                        <form action="{{ route('dashboard.noauth') }}" method="POST">
                                            @csrf
                                            <button class="list-group-item-action" type="submit">Keluar</button>
                                        </form>

                                    </div>
                                </div>

                                <!-- End Button-Keluar -->
                            </div>

                        </div>
                        <!-- End Pengaturan Lain-lain -->

                    </div>
                </div>
                <!-- end content lain-lain -->
                <br><br><br>

            </div>
            <!-- end tab content -->
        </div>
        <!-- End Top Menu -->
    @endsection
