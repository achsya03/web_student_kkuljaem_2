        @extends('layouts.dashboard')

        @section('css')
            <link rel="stylesheet" href="{{ asset('assets/css/detail-video.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
        @endsection

        @section('title')
            {{ env('APP_NAME') }} | Latihan
        @endsection

        @section('content')
            <div class="container">
                <div class="title">
                    <h4 class="font-weight-bold my-4">Shadowing</h4>
                </div>

                <div class="top-deskripsi d-flex align-items-center">
                    <img src="{{ asset('assets/img/img-shadowing.png') }}" alt="" class="ml-4">
                    <h5 class="ml-4">Latih pelafalan kamu dalam melafalkan kata/ kalimat berikut</h5>
                </div>

                <div class="main-pelafalan mt-5 d-flex justify-content-between">
                    <!-- All Card -->
                    <div class="card-deck mx-auto">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($shadowing as $item)
                            <div class="card-sound mx-2 my-2">
                                <div id="kata{{ ++$no }}" class="shadowing">
                                    <div class="d-flex justify-content-between align-items-center my-4">
                                        <div class="d-flex">
                                            <button></button>
                                            <div class="title-lafal ml-3">
                                                <h3 class="mb-0">{{ $item->hangeul }}</h3>
                                                <p class="mb-0">{{ $item->pelafalan }}</p>
                                            </div>
                                        </div>

                                        <div class="d-flex controls">
                                            <button></button>
                                            <button></button>
                                        </div>

                                    </div>

                                    <audio controls></audio>
                                    <audio controls></audio>
                                </div>
                                <!-- End Shadowing Element -->
                            </div>
                        @endforeach
                    </div>

                    <!-- End All Card -->
                </div>

            </div>
        @endsection
        @section('page-js')
            <script src="{{ asset('assets/js/kata.js') }}"></script>

            <script type="text/javascript">
                // Script Shadowing
                window.onload = function() {
                    @php
                    $nomor = 1;
                    $nokata = 1;
                    @endphp
                    @foreach ($shadowing as $item)
                        kata{{ ++$nomor }} = new Shadowing("kata{{ ++$nokata }}", "{{ $item->url_pengucapan }}");
                    @endforeach
                }
            </script>
        @endsection
