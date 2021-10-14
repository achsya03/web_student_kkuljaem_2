@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/class.css') }}">
@endsection

@section('title')
    {{ env('APP_NAME') }} | Detail Mentor
@endsection

@section('content')


    <div id="hero-detail" class="container mb-4 mt-4">
        <div class="profil-mentor">
            <div class="row mb-4 py-4">
                <div class="col-lg-1 pl-4">
                    <img class="rounded-circle" src="{{ $class->mentor_foto }}" width="80px" height="80px" alt="Profile">
                </div>
                <div class="col-lg-10 pl-4 ml-4 mt-2">
                    <h4>{{ $class->mentor_nama }} <i class="fas fa-check-circle"></i></h4>
                    <h5>Menjadi Mentor sejak {{ $class->mentor_lama }}</h5>
                </div>
            </div>
        </div>
        <h4 class="mb-2"><Strong>Tentang {{ $class->mentor_nama }}</Strong></h4>
        <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget convallis ullamcorper nisl, rhoncus imperdiet
            pharetra eget integer venenatis. Neque etiam fusce malesuada blandit id diam. Maecenas in laoreet adipiscing at
            tortor aliquam cursus sit aliquam. Velit condimentum lacus scelerisque sed id viverra. Risus, varius cras auctor
            massa id arcu id. Nunc, iaculis aliquam accumsan mauris nisl diam posuere et suspendisse. Sed elit egestas
            hendrerit venenatis lectus nisi, adipiscing. Arcu cras erat est amet a ornare amet. Tristique lacus ut congue
            quis arcu, aliquam.</h5>
        {{-- {{$class->mentor_bio}} --}}
    </div>
    <div id="hero-kelas" class="container ">
        <div class="tittle-kelas mt-4">
            <h4><strong>Kelas yang Diajar</strong></h4>
        </div>
        <div class="kelas-utama">
            <div class="pilihan-kelas">
                <div class="card-deck">
                    @forelse ($class->classroom as $item)
                        <button class="kelas">
                            <div class="row py-4">
                                <div class="col-lg-4">
                                    <img class="gambar-kelas mt-2" src="{{ $item->class_url_web }}" width="160px"
                                        height="160px">
                                </div>
                                <div class="col-lg-5 ml-2 text-left deskripsi">
                                    <div class="nama-kelas">
                                        <a href="{{ route('class.detail', $item->class_uuid) }}"
                                            style="text-decoration: none; color: black">
                                            <h5>{{ $item->class_nama }}</h5>
                                        </a>
                                    </div>

                                    <div class="jumlah-materi">
                                        <h5>{{ $item->class_jml_materi }} Materi</h5>
                                    </div>
                                </div>
                            </div>
                        </button>
                    @empty

                    @endforelse


                </div>
            </div>
        </div>
    </div>

    </div>



@endsection
