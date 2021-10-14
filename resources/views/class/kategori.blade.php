@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/class.css') }}">
    
@endsection

@section('title')
    {{ env('APP_NAME') }} | Kelas
@endsection

@section('content')

            
            <div id="hero-kelas" class="container ">
                <div class="tittle-kelas">
                    <h3><a href="{{route('class.kategori',$class->category_uuid)}}"> {{$class->category}} </a></h3>
                    <p>{{$class->deskripsi}}</p>
                </div>
                <div class="kelas-utama">
                    <div class="pilihan-kelas">
                        <div class="card-deck">
                            @foreach($class->class as $children)
                            <button class="kelas">
                                <div class="row py-4">
                                    <div class="col-lg-4">
                                        <img  class="gambar-kelas" src="{{$children->url_web}}" width="160px" height="160px" srcset="">
                                    </div>
                                    <div class="col-lg-6 py-6 text-left deskripsi">
                                        <div class="nama-kelas">
                                            <a href="{{route('class.detail', $children->class_uuid)}}" style="text-decoration: none; color: black">
                                            <h5>{{$children->class_nama}}</h5></a>
                                        </div>
                                        <div class="nama-guru">
                                            <h5>{{$children->mentor_nama ?? '-'}} <i class="fas fa-check-circle"></i></h5>
                                            
                                        </div>
                                        <div class="jumlah-materi">
                                            <h5>{{$children->jml_materi}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </button> 
                            @endforeach                           
                        </div>
                    </div>
                </div>
            </div>
                     
            <div id="hero-kelas" class="container ">
                <div class="tittle-kelas">
                  <h3><a href="#"> Kelas Lainnya </a></h3>
                  <p>Lihat kelas lainnya yuk yang tidak kalah menarik!</p>
                </div>
                <div class="kelas-utama">
                  <div class="pilihan-kelas">
                    <div class="card-deck">
                      <button class="kelas-lain">
                        <div class="class-lainnya">
                          <h3>Kelas Intensif</h3>
                          <hr />
                          <h4>Belajar bahasa Korea mendalam dan mudah dimengerti</h4>
                        </div>
                      </button>
                      <button class="kelas-lain">
                        <div class="class-lainnya">
                          <h3>Kelas Intensif</h3>
                          <hr />
                          <h4>Belajar bahasa Korea mendalam dan mudah dimengerti</h4>
                        </div>
                      </button>
                    </div>
                  </div>
                  <div class="lainnya mt-3 mb-3" width="100%">
                    <center><button type='button' class='btn btn-lainnya text-center py-2 my-1'> Lainnya </button>
                    </center>
                  </div>
                </div>
              </div>
    

@endsection

