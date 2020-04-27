@extends('backend.layouts.chat-app')

@section('content')

<?php
$url = url('/');
?>
<div id="chat-container" style="background-image: url({{$url}}/public/chat-bg.jpg); height:100vh;" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                            <h3 style="color:white;">Welcome To HRM Messenger </h3>
                            <div class="card-body" id="app">
                                <chat-app :user="{{ auth()->user() }}"></chat-app>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 