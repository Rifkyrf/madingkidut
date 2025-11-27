@extends('layouts.app')

@section('title', 'Detail Artikel - E-Mading')

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

<div class="post-details-title-area bg-overlay clearfix" style="background-image: url({{ asset('img/bg-img/22.jpg') }})">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-lg-8">
                <div class="post-content">
                    <p class="tag"><span>Kategori</span></p>
                    <p class="post-title">Judul Artikel</p>
                    <div class="d-flex align-items-center">
                        <span class="post-date mr-30">June 20, 2018</span>
                        <span class="post-date">By Nama Penulis</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="post-news-area section-padding-100-0 mb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="post-details-content mb-100">
                    <p>Isi artikel akan ditampilkan di sini...</p>
                    <img class="mb-30" src="{{ asset('img/bg-img/31.jpg') }}" alt="">
                </div>

                <div class="comment_area clearfix mb-100">
                    <h4 class="mb-50">Komentar</h4>
                    <ol>
                        <li class="single_comment_area">
                            <div class="comment-content d-flex">
                                <div class="comment-author">
                                    <img src="{{ asset('img/bg-img/32.jpg') }}" alt="author">
                                </div>
                                <div class="comment-meta">
                                    <div class="d-flex">
                                        <a href="#" class="post-author">Nama User</a>
                                        <a href="#" class="post-date">June 23, 2018</a>
                                    </div>
                                    <p>Komentar user...</p>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>

                <div class="post-a-comment-area mb-30 clearfix">
                    <h4 class="mb-50">Tulis Komentar</h4>
                    <div class="contact-form-area">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Komentar"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn newsbox-btn mt-30" type="submit">Kirim Komentar</button>
                                </div>
                            </div>
                        </form>
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
