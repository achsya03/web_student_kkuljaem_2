        @extends('layouts.dashboard')

        @section('css')
        <link rel="stylesheet" href="{{ asset('assets/css/quiz.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
        @endsection

        @section('title')
        {{ env('APP_NAME') }} | Quiz
        @endsection

        @section('content')
        <div class="container" style="min-height: 65vh;">
                <quiz-component v-bind:quiz='@json($quiz)' token='{{session()->get('bearer_token')}}'></quiz-component>
        </div>
        @endsection

        @section('page-js')
        <script src="{{ mix('js/app.js') }}"></script>
        @endsection