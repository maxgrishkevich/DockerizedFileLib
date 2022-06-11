<?php use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;?>
@extends('layouts.app')

@section('menu')
    @parent
    <li class="nav-item"><a href="/upload" class="nav-link">Uploading</a></li>
    <li class="nav-item"><a href="/activation" class="nav-link">Activation</a></li>
    <li class="nav-item"><a href="/library" class="nav-link active" aria-current="page">Library</a></li>
@endsection

@section('content')
    <div class="container" style="max-width: 700px">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="product-file-type">
                            <ul class="list-unstyled">
                                <?php foreach ($data as $file): ?>
                                    <?php $type = explode('.', $file['name']); ?>
                                    <li class="media mb-3">
                                        <span class="mr-3 align-self-center img-icon primary-rgba text-primary">.{{$type[1]}}</span>
                                        <div class="media-body">
                                            <?php $name = explode('_', $type[0], 2); ?>
                                            <h5 class="font-16 mb-1">{{$name[1]}}<i class="feather icon-download-cloud float-right"></i></h5>
                                            <?php
                                                $cut_path = explode('/', $file['file_path'], 3);
                                                $file_path = storage_path('/app/public/' . $cut_path[2]);
                                                $size = File::size($file_path);
                                            ?>
                                            <p>.{{$type[1]}}, {{round($size/1000, 1)}}kb</p>
                                        </div>
                                        <div>
                                            <a href="{{route('download', $file)}}" class="file-download"><i class="fa fa-download"></i></a>
                                        </div>
                                    </li>
                                    <hr>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">

         .file-download {
            font-size: 32px;
            color: #98a6ad;
            position: absolute;
            right: 10px
        }

        .file-download:hover {
            color: #313a46
        }

        .product-file-type .img-icon {
            width: 46px;
            height: 46px;
            line-height: 46px;
            font-weight: 600;
            border-radius: 50%;
            font-size: 18px;
            text-align: center;
        }
        /* -- Text Color -- */
        .text-white {
            color: #ffffff !important;
        }

        .text-black {
            color: #282828 !important;
        }

        .text-muted {
            color: #8A98AC !important;
        }

        .text-primary {
            color: #6e81dc !important;
        }

        .text-secondary {
            color: #718093 !important;
        }

        .text-success {
            color: #5fc27e !important;
        }

        .text-danger {
            color: #f44455 !important;
        }

        .text-warning {
            color: #fcc100 !important;
        }

        .text-info {
            color: #72d0fb !important;
        }

        .text-light {
            color: #dcdde1 !important;
        }

        .text-dark {
            color: #2d3646 !important;
        }


        .primary-rgba {
            background-color: rgba(110, 129, 220, 0.1);
        }

        .secondary-rgba {
            background-color: rgba(113, 128, 147, 0.1);
        }

        .success-rgba {
            background-color: rgba(95, 194, 126, 0.1);
        }

        .danger-rgba {
            background-color: rgba(244, 68, 85, 0.1);
        }

        .warning-rgba {
            background-color: rgba(252, 193, 0, 0.1);
        }

        .info-rgba {
            background-color: rgba(114, 208, 251, 0.1);
        }

        .light-rgba {
            background-color: rgba(220, 221, 225, 0.1);
        }

        .dark-rgba {
            background-color: rgba(45, 54, 70, 0.1);
        }

        .card-header:first-child {
            border-radius: calc(5px - 1px) calc(5px - 1px) 0 0;
            padding: 15px 20px;
        }
        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }
        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background-color: transparent;
        }

        .card {
            border: none;
            border-radius: 3px;
            background-color: #ffffff;
        }
        .m-b-30 {
            margin-bottom: 30px;
        }

        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: #282828;
        }
    </style>
@endsection
