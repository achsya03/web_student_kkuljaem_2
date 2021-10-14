@extends('layouts.dashboard')

@section('css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pembayaran.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/profil.css') }}" rel="stylesheet" />
@endsection

@section('title')
    {{ env('APP_NAME') }} | Pembayaran
@endsection

@section('content')
<div class="container" style="height: 500px">
        
            <!-- Modal -->
            <div class="modal fade" id="subs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="detail-pesanan">
                        
                        <h2 class="font-weight-bold mb-5 title-detail"><img
                                src="{{ asset('assets/img/icon-detail-pesanan.png') }}" alt="">
                            Detail Langganan</h2>                           
                            
                            
                                <div class="alert alert-profile-premium mt-4 mb-5" role="alert">
                                    <i class="far fa-calendar-alt ml-1 mr-3"></i> {{ $info }}
                                </div>
                            
                            
                            <input type="hidden" name="token" value="{{$token}}" id="">
                            <input type="hidden" name="referal" value="{{$referal}}" id="">
                        <div class="row">
                           
                            <div class="col-8">
                                <div class="d-flex flex-column">
                                    <p class="mb-0">Paket yang dipilih</p>
                                    <h4 class="text-uppercase">Paket Premium {{$packets->packet->lama_paket ?? ''}} Bulan</h4>
                                    <br>
                                    <p class="mb-0">Tanggal Langganan</p>
                                    <h4 class="text-uppercase">{{ date('d m Y', strtotime($packets->tgl_daftar)) ?? ''}}</h4>
                                    <br>
                                    <p class="mb-0">Kode Referal</p>
                                    <h4 class="text-uppercase">{{$packets->kode_referal ?? ''}}</h4>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-column align-items-end">
                                    <p class="mb-0">Nominal</p>
                                    <h4 class="text-uppercase">{{"Rp " . number_format($packets->packet->harga,2,',','.')}}</h4>
                                    <br>
                                    <p class="mb-0">Berakhir</p>
                                    <h4 class="text-uppercase">- {{ date('d m Y', strtotime($packets->tgl_akhir)) ?? ''}}</h4>
                                    <br>
                                    <p class="mb-0">Pemilik</p>
                                    <h4 class="text-uppercase">{{$packets->nama_referal ?? ''}} </h4>
                                </div>
                            </div>
                        </div>
                        <a class="text-center my-4" href="{{$subs}}" target="_blank"><button type="button" class="btn btn-pesan mt-5">Pembayaran</button></a>
                    </div>
                </div>
            </div>
        

    </div>
@endsection

@section('page-js')
    <script>
        $('#subs').modal('show');
    </script>
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                infinite: true,
                dots: true,
            });
        });
    </script>
@endsection