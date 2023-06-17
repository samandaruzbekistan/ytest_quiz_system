@extends('user.header')

@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    />

    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
      crossorigin="anonymous"
    />
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
<link rel="stylesheet" href="{{ URL::asset('categories.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/header.css') }}" />
@endsection

@section('section')
<!-- .site-header -->
<section class="news-container">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="entry-header">
                        <h1>YANGILIKLAR</h1>
                    </header><!-- .entry-header -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header-overlay -->
  </div><!-- .page-header -->

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs">
                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="./index.html"><i class="fa fa-home"></i> Bosh sahifa</a></li>
                    <li><a href="./news.html">Yangiliklar</a></li>
                </ul>
            </div><!-- .breadcrumbs -->
        </div><!-- .col -->
    </div><!-- .row -->

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="blog-posts">
                <div class="row mx-m-25">
                    <div class="col-12 col-md-6 px-25">
                        <div class="blog-post-content">
                            <figure class="blog-post-thumbnail position-relative m-0">
                                <a href="#"><img src="images/b-1.jpg" alt=""></a>
                                 </figure><!-- .blog-post-thumbnail -->
                            <div class="blog-post-content-wrap">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="https://t.me/milliy_sertifikat/5180"> Umumta’lim fanlaridan tavsiya etilgan darsliklar ro‘yxati e’lon qilindi</a></h2>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p> 2022-2023-o‘quv yilida oliy taʼlim muassasalarining bakalavriat taʼlim yo‘nalishlariga kirish test sinovlariga tayyorgarlik ko‘rish uchun tavsiya etilgan darsliklar va o‘quv adabiyotlari ro‘yxati Davlat test markazining rasmiy veb-saytida e’lon qilindi.</p>
                                </div><!-- .entry-content -->
                            </div><!-- .blog-post-content-wrap -->
                        </div><!-- .blog-post-content -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 px-25">
                        <div class="blog-post-content">
                            <figure class="blog-post-thumbnail position-relative m-0">
                                <a href="#"><img src="images/b-2.jpg" alt=""></a>
                            </figure><!-- .blog-post-thumbnail -->

                            <div class="blog-post-content-wrap">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="https://t.me/milliy_sertifikat/5237"> TOEFL ITP va TOEIC imtihonlari uchun talabgorlarni ro‘yxatga olish boshlandi</a></h2>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p>Talabgorlarni ro‘yxatga olish my.dtm.uz (https://my.dtm.uz/ilmiy/service) sayti (“Ilmiy markaz” bo‘limi) orqali amalga oshirilmoqda va 18-noyabrga qadar davom etadi.</p>
                                </div><!-- .entry-content -->
                            </div><!-- .blog-post-content-wrap -->
                        </div><!-- .blog-post-content -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 px-25">
                        <div class="blog-post-content">
                            <figure class="blog-post-thumbnail position-relative m-0">
                                <a href="#"><img src="images/b-3.jpg" alt=""></a>
                            </figure><!-- .blog-post-thumbnail -->

                            <div class="blog-post-content-wrap">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="https://t.me/milliy_sertifikat/5167">Milliy sertifikat imtihonlarida kimlar qatnashishi mumkin?</a></h2>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p>❔ Hozirda ko‘pchilik tomonidan milliy sertifikat imtihonida kimlar ishtirok eta oladi, bu imtihon faqat abituriyentlar uchunmi degan mazmunda ko‘plab savollar berilmoqda.</p>
                                </div><!-- .entry-content -->
                            </div><!-- .blog-post-content-wrap -->
                        </div><!-- .blog-post-content -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 px-25">
                        <div class="blog-post-content">
                            <figure class="blog-post-thumbnail position-relative m-0">
                                <a href="#"><img src="images/b-4.jpg" alt=""></a>
                            </figure><!-- .blog-post-thumbnail -->

                            <div class="blog-post-content-wrap">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="https://t.me/milliy_sertifikat/5284?single">Chet tilini bilish darajasini aniqlash test sinovlari bo‘lib o‘tdi</a></h2>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p>📚 Test sinovlari ingliz tilidan yangi format asosida ko‘p darajali tizimda, boshqa tillardan esa B2 va C1 tilni bilish darajalari bo‘yicha o‘tkazildi.</p>
                                </div><!-- .entry-content -->
                            </div><!-- .blog-post-content-wrap -->
                        </div><!-- .blog-post-content -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 px-25">
                        <div class="blog-post-content">
                            <figure class="blog-post-thumbnail position-relative m-0">
                                <a href="#"><img src="images/b-5.jpg" alt=""></a>
                            </figure><!-- .blog-post-thumbnail -->

                            <div class="blog-post-content-wrap">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="https://t.me/milliy_sertifikat/5271">Ona tili va adabiyot fanidan milliy sertifikat imtihonlari yanvar oyida o‘tkaziladi</a></h2>
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p>📆 Talabgorlarni ro‘yxatga olish 12-noyabrga qadar davom etadi va test sinovlari 4- va 18-dekabr kunlari bo‘lib o‘tadi.</p>
                                </div><!-- .entry-content -->
                            </div><!-- .blog-post-content-wrap -->
                        </div><!-- .blog-post-content -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 px-25">
                        <div class="blog-post-content">
                            <figure class="blog-post-thumbnail position-relative m-0">
                                <a href="#"><img src="images/b-6.jpg" alt=""></a>

                            </figure><!-- .blog-post-thumbnail -->

                            <div class="blog-post-content-wrap">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="https://t.me/milliy_sertifikat/5280">Yangi ishga kirayotgan chet tili o'qituvchilariga B2 darajadagi sertifikat talabi 2023/2024 o'quv yilidan kiritiladi</a></h2>

                                    <div class="entry-meta flex align-items-center">
                                        <div class="post-author"><a href="#"></a></div>

                                    
                                    </div><!-- .entry-meta -->
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p> 2024/2025 o'quv yilidan maktabdagi har qanday chet tili fani o'qituvchisi B2 darajadagi sertifikatga ega bo'lishi talab etiladi. O'z navbatida C1 darajadagi xalqaro sertifikatga ega o'qituvchilar ham ayni vaqtda oylik ish haqlarini 50 foizga oshirish imkoniyatiga ega</p>
                                </div><!-- .entry-content -->
                            </div><!-- .blog-post-content-wrap -->
                        </div><!-- .blog-post-content -->
                    </div><!-- .col -->
                </div><!-- .blog-posts -->
            </div><!-- .col -->

            <div class="pagination flex flex-wrap justify-content-between align-items-center">
                <div class="col-12 col-lg-4 order-2 order-lg-1 mt-3 mt-lg-0">
                    <ul class="flex flex-wrap align-items-center order-2 order-lg-1 p-0 m-0">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>

                <div class="col-12 flex justify-content-start justify-content-lg-end col-lg-8 order-1 order-lg-2">
                </div>
            </div><!-- .pagination -->
        </div><!-- .col -->

        <div class="col-12 col-lg-4">
            <div class="sidebar">
                <div class="search-widget">
                    <form class="flex flex-wrap align-items-center">
                        <input type="search" placeholder="Izlash...">
                        <button type="submit" class="flex justify-content-center align-items-center"><i class="fa fa-search"></i></button>
                    </form><!-- .flex -->
                </div><!-- .search-widget -->

                <div class="latest-courses mt-5">
                    <h2>Ko'p o'qilgan</h2>

                    <ul class="p-0 m-0">
                        <li class="flex flex-wrap justify-content-between align-items-start">
                            <img src="images/t-1.jpg" alt="">

                            <div class="content-wrap">
                                <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            </div><!-- .content-wrap -->
                        </li>

                        <li class="flex flex-wrap justify-content-between align-items-start">
                            <img src="images/t-2.jpg" alt="">

                            <div class="content-wrap">
                                <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            </div><!-- .content-wrap -->
                        </li>

                        <li class="flex flex-wrap justify-content-between align-items-start">
                            <img src="images/t-3.jpg" alt="">

                            <div class="content-wrap">
                                <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            </div><!-- .content-wrap -->
                        </li>

                        <li class="flex flex-wrap justify-content-between align-items-start">
                            <img src="images/t-4.jpg" alt="">

                            <div class="content-wrap">
                                <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            </div><!-- .content-wrap -->
                        </li>
                    </ul>
                </div><!-- .latest-courses -->
             
            </div><!-- .sidebar -->
        </div><!-- .col -->
    </div><!-- .row -->
</div><!-- .container -->
</section>
@endsection