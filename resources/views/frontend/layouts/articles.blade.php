<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Allaia | Bootstrap eCommerce Template - ThemeForest</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ asset('frontend') }}/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('frontend') }}/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ asset('frontend') }}/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ asset('frontend') }}/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('frontend') }}/css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/style.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('frontend') }}/css/contact.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('frontend') }}/css/custom.css" rel="stylesheet">

</head>
<style>
    .img__articles {
        max-width: 100%;
    }
</style>

<body>

    <div id="page">

        @include('frontend.layouts.header')
        <!-- /header -->
        <main class="bg_gray">
            <div class="container margin_30">
                <!-- /page_header -->
                <div class="row">
                    <div class="col-lg-9">
                        <div class="widget search_blog d-block d-sm-block d-md-block d-lg-none">
                            <div class="form-group">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Search..">
                                <button type="submit"><i class="ti-search"></i><span
                                        class="sr-only">Search</span></button>
                            </div>
                        </div>
                        <!-- /widget -->
                        <div class="row">

                            <div class="col-md-6">
                                <article class="blog">
                                    @foreach ($articles as $article)
                                        <figure>
                                            <a href="{{ route('detail-article', ['slug' => $article->slug, 'id' => $article->id]) }}">
                                                @if ($article->image && file_exists(public_path($article->image)))
                                                    <img src="{{ asset($article->image) }}" class="img__articles">
                                                @else
                                                    <img src="{{ asset('upload/azaka.jpg') }}" class="img__articles">
                                                @endif
                                            </a>
                                            <a href="{{ route('detail-article', ['slug' => $article->slug]) }}"
                                                class="blog__btn">Chi tiết <span class="arrow_right"></span></a>
                                        </figure>
                                        <div class="post_info">
                                            <small>{{ date( 'Y/m/d H:i:s ', strtotime($article->updated_at)) }}</small>
                                            <h2><a
                                                    href="{{ route('detail-article', ['slug' => $article->slug]) }}">{{ $article->title }}</a>
                                            </h2>
                                            <p>{!! $article->summary !!}</p>
                                        </div>

                                    @endforeach
                                </article>
                            </div>
                            {{-- <div class="pagination__wrapper no_border add_bottom_30">
                                <ul class="pagination">
                                    <li><a href="#0" class="prev" title="previous page">&#10094;</a></li>
                                    <li>
                                        <a href="#0" class="active">1</a>
                                    </li>
                                    <li>
                                        <a href="#0">2</a>
                                    </li>
                                    <li>
                                        <a href="#0">3</a>
                                    </li>
                                    <li>
                                        <a href="#0">4</a>
                                    </li>
                                    <li><a href="#0" class="next" title="next page">&#10095;</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('frontend.layouts.footer')
    </div>
    <!-- page -->
    <div id="toTop"></div><!-- Back to top button -->
    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('frontend') }}/js/common_scripts.min.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>

</body>

</html>
