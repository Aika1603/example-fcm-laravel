@extends('layouts.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body">
                    <h4>Demo Notif</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scriptcss')
    <style>
        /* skeleton css */
        .skeleton-loader:empty {
            width: 100%;
            height: 15px;
            display: block;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0),
                rgba(255, 255, 255, 0.5) 50%,
                rgba(255, 255, 255, 0) 80%
                ),
                lightgray;
            background-repeat: repeat-y;
            background-size: 50px 500px;
            background-position: 0 0;
            animation: shine 1s infinite;
        }

        @keyframes shine {
            to {
                background-position: 100% 0;
            }
        }
    </style>
@endsection

