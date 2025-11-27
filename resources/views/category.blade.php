@extends('layouts.app')

@section('title', 'Kategori - E-Mading')

@section('content')
<section class="breaking-news-area clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="breaking-news-ticker d-flex flex-wrap align-items-center">
                    <div class="title"><h6>Trending</h6></div>
                    <div id="breakingNewsTicker" class="ticker">
                        <ul>
                            <li><a href="#">Artikel terbaru dari siswa dan guru</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="catagory-featured-post bg-overlay clearfix" style="background-image: url({{ asset('img/bg-img/23.jpg') }})">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-lg-9">
                <div class="post-content">
                    <p class="tag"><span>Kategori</span></p>
                    <a href="#" class="post-title">Nama Kategori</a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="intro-news-area section-padding-100-0 mb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="intro-news-tab">
                    <div class="intro-news-filter d-flex justify-content-between">
                        <h6>Semua Artikel</h6>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="single-blog-post style-2 mb-5">
                                <div class="blog-thumbnail">
                                    <a href="#"><img src="{{ asset('img/bg-img/14.jpg') }}" alt=""></a>
                                </div>
                                <div class="blog-content">
                                    <span class="post-date">June 20, 2018</span>
                                    <a href="#" class="post-title">Judul Artikel</a>
                                    <a href="#" class="post-author">By Nama Penulis</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-9 col-md-6 col-lg-4">
                <div class="sidebar-area">
                    <div class="single-widget-area add-widget mb-30">
                        <a href="#"><img src="{{ asset('img/bg-img/add3.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
