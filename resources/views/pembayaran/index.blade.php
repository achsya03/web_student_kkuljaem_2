@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pembayaran.css') }}" rel="stylesheet" />
@endsection

@section('title')
    {{ env('APP_NAME') }} | Pembayaran
@endsection

@section('content')
    <div class="container">
        <div class="text-center mt-5 mb-5 pb-4">
            <img src="{{ asset('assets/img/berlangganan.png') }}" alt="LogoPremium" class="img-langganan">
        </div>

        <div class="row ">
            <div class="col-6">
                <div class="content-berlangganan">
                    <h2 class="font-weight-bold ">Jadi Member Premium</h2>
                    <p class="p-berlangganan">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et eu, diam lacus,
                        turpis non. Eget malesuada tortor at leo. Est aliquam.</p>
                    <div class="title-content-langganan">
                        <h4 class="">Keuntungan Menjadi Member Premium</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    <ul>
                        <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                        <li>Elit vulputate venenatis cursus vel in purus morbi. Vitae turpis et enim.</li>
                        <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                        <li>Id arcu tristique id elementum enim, nisl orci ac dis. </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="
                            col-6 mb-4 ">
                <div id=" pilih-paket" class="ml-auto">
                            <form target="_blank" class="form theme-form pb-5 f1" action="{{ route('pembayaran.langganan') }}"
                                method="GET">
                                @csrf

                                <h3 class="mb-4">Pilihan Paket</h3>
                                @foreach ($packets as $packet)
                                    <label class="radio-pembayaran">{{ $packet->lama_paket }} Bulan
                                        <b>{{ 'Rp ' . number_format($packet->harga, 2, ',', '.') }}</b>
                                        <input name="token" type="radio" checked="checked" value="{{ $packet->uuid }}"
                                            name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach

                                <h6 class="mt-4 font-weight">Punya Reference ID?</h6>
                                <div class="input-group mb-5 ">
                                    <input type="text" class="form-control input-reference select_packet" name="referal"
                                        placeholder="Masukan reference ID..." aria-label="referenceid"
                                        aria-describedby="basic-addon1">
                                </div>
                                @if (session('data'))
                                    <script>
                                      window.location.replace(session('data'));
                                    </script>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-profile-premium mt-4 mb-5" role="alert">
                                        <i class="far fa-calendar-alt ml-1 mr-3"></i> {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('failed'))
                                    <div class="alert alert-profile mt-4 mb-5" role="alert">
                                        <i class="far fa-user-circle ml-1 mr-3"></i> {{ session('failed') }}
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-premium d-flex align-items-center"
                                   >Beralih ke Premium</button>
                                </form>
                                <!-- Modal -->
                                <div class="modal fade" id="tes" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" id="detail-pesanan">
                                            <h2 class="font-weight-bold mb-5 title-detail"><img
                                                    src="{{ asset('assets/img/icon-detail-pesanan.png') }}" alt="">
                                                Detail Pesanan</h2>
                                           
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-column">
                                                        <p class="mb-0">Label Pesanan</p>
                                                        <h4 class="text-uppercase">Paket Premium 12 Bulan</h4>
                                                        <br>
                                                        <p class="mb-0">Tanggal Pesanan</p>
                                                        <h4 class="text-uppercase">12 Jan 2021</h4>
                                                        <br>
                                                        <p class="mb-0">Reference ID</p>
                                                        <h4 class="text-uppercase">JUNK2021</h4>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="d-flex flex-column align-items-end">
                                                        <p class="mb-0">Label Pesanan</p>
                                                        <h4 class="text-uppercase">Rp 500.000</h4>
                                                        <br>
                                                        <p class="mb-0">Berakhir</p>
                                                        <h4 class="text-uppercase">- 12 Jan 2022</h4>
                                                        <br>
                                                        <p class="mb-0">Pemilik</p>
                                                        <h4 class="text-uppercase">JUNKOOK </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="text-center my-4 btn btn-pesan mt-5">Pesan
                                                Sekarang</button>
                                        </div>
                                    </div>
                                </div>
                            
                    </div>
                    <!-- End Modal -->
                </div>

            </div>
        </div>
    @endsection
    @section('page-js')
        <script>
            $(document).ready(function() {
                function packet() {
                    var bagian = $('.select_packet');
                    var pesan = $('.btn-premium');
                    console.log(bagian.val());
                    pesan.addId({{ $packet->uuid }});
                }
            });
        </script>
    @endsection
