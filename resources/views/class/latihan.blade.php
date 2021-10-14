@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/quiz.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection

@section('title')
{{ env('APP_NAME') }} | Latihan
@endsection

@section('content')
<div class="container" style="min-height: 65vh;">
        <task-component v-bind:quiz='@json($quiz)' uuid='{{$id}}'></task-component>
</div>
@endsection

@section('page-js')
<script src="{{ mix('js/app.js') }}"></script>
@endsection