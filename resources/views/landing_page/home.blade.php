<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/Favicon-01.png') }}">
    <!-- <meta http-equiv="refresh" content="10"> -->
    <title>Gamers Parlor </title>
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/landing-page-assets/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing-page-assets/scss/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing-page-assets/scss/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/landing-page-assets/fontawesome/css/all.min.css') }}">

</head>

<body>
    <header class="fixed-top top-0 w-100 navbar-fixed-top">
        <nav class="navbar navbar-expand-md bg-transparent">
            <div class="container">
                <a class="navbar-brand d-flex justify-content-center" href="#">
                    <img src="{{ asset('assets/landing-page-assets/imgs/Company_logo_no_background.png') }}"
                        class="img-fluid" alt="">
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">about</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#gallery">media</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#mobile_app">mobile app</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="main-banner" id="home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="get-corner flex-md-row flex-column gap-4">
                        <div class="main-banner-content site-text">
                            <h1>
                                A <span>New Home</span> for
                                <br>
                                Gamers to Compete
                            </h1>
                            <p class="mt-40">
                                Create your team, compete with others and earn
                                real money Push your gaming limits. Start playing now!
                            </p>
                            <a href=""
                                class="primary-btn d-inline-flex align-items-center justify-content-center mt-25">start
                                playing</a>
                        </div>
                        <div>
                            <img src="{{ asset('assets/landing-page-assets/imgs/avatar.png') }}" class="img-fluid"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-banner" id="about">
        <div class="about-section pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="about-banner d-flex align-items-end justify-content-end pb-100">
                            <div class="site-text  small">
                                <h1>
                                    who we are
                                </h1>
                                <p class="mt-20">
                                    Gamers Parlor started with a close-knit group of friends, each having a relentless
                                    desire to
                                    compete yet with a missing gateway to nourish our competitive natures. For us,
                                    gaming fuels
                                    our competitive spirits and serves as a therapeutic vessel for relaxation. For these
                                    reasons,
                                    gaming has always been an integral part of our lives.
                                    Our most exciting moments are when we place informal wagers among each other. Our
                                    gaming
                                    chats erupt with anticipation as both parties prepare for the challenge. Once the
                                    stream is up,
                                    it’s game on from there.
                                    Although this is great fun, we have realized that something is missing; an
                                    opportunity to
                                    enhance our gaming experience. We need a vessel that fuels, even more, our desire to
                                    compete. We need a platform that connects competitive, like-minded players together
                                    in real-
                                    time. Indeed, it’s apparent that there is a vast market of casual – yet competitive
                                    – gamers who
                                    are looking for this extra gaming platform.
                                    So what did we do? We made one ourselves: Gamers Parlor.
                                    Gamers Parlor, Founded by avid gamers Dhandre Weekes, Cedric Fiske-Casault and
                                    Joshua
                                    Archibald, offers an immersive experience to those who have yet to receive the
                                    opportunity to
                                    compete on a grander scale with the likes of head-to-head user matches, player
                                    tournaments or
                                    team up with friends to join our competitive league to earn hard-fought cash. We’re
                                    calling on
                                    all the gamers to join our Parlor and compete for something real. Fuel your fire.
                                </p>
                                {{-- <a href="" class="btn btn-dark text-capitalize px-4 mt-30">register now</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slider-section get-center" id="gallery">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="main-banner-content site-text">
                        <h1>
                            <span>Upload your clips </span> for a chance to make our <span>highlights on youtube</span>
                        </h1>
                        <form class="row g-3 needs-validation" novalidate action="{{ route('upload-video') }}"
                            method="post" enctype="multipart/form-data">
                            <div class="col-md-6 mt-50">
                                <div class="form-label-group in-border">
                                    {{-- <label for="gamerTagName" class="form-label fs-5 fs-lg-1">Name</label> --}}
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        id="gamerTagName" name="name" placeholder="Gamer Tag"
                                        value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-50">
                                <div class="form-label-group in-border">
                                    <input type="text"
                                        class="form-control @if ($errors->has('game')) is-invalid @endif"
                                        id="abbreviation" name="game" placeholder="Game"
                                        value="{{ old('game') }}">
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('game'))
                                            {{ $errors->first('game') }}
                                        @else
                                            Game is required!
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mt-30">
                                <div class="form-label-group in-border">
                                    <input type="file" class="form-control vip_image" id="video"
                                        name="video" placeholder="video" value="{{ old('video') }}">
                                </div>
                            </div>

                            <div class="col-12 text-end">
                                <button
                                    class="primary-btn d-inline-flex align-items-center justify-content-center mt-25"
                                    type="submit">Submit</button>
                                {{-- <button
                                    class="btn btn-light  d-inline-flex align-items-center justify-content-center mt-25"
                                    type="reset">Cancel</button> --}}
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="swiper mySwiper overflow-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="img-slider">
                                    <img src="{{ asset('assets/landing-page-assets/imgs/sl1.jpg') }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="img-slider">
                                    <img src="{{ asset('assets/landing-page-assets/imgs/sl2.jpg') }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="img-slider">
                                    <img src="{{ asset('assets/landing-page-assets/imgs/sl3.jpg') }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="img-slider">
                                    <img src="{{ asset('assets/landing-page-assets/imgs/sl1.jpg') }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="img-slider">
                                    <img src="{{ asset('assets/landing-page-assets/imgs/sl2.jpg') }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="img-slider">
                                    <img src="{{ asset('assets/landing-page-assets/imgs/sl3.jpg') }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="app-section get-center py-4" id="mobile_app">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('assets/landing-page-assets/imgs/phn.png') }}" class="img-fluid"
                        alt="">
                </div>
                <div class="col-md-6">
                    <div class="site-text text-end">
                        <h1>
                            <span>Fuel </span> your <span>Fire.</span>
                        </h1>
                        <p class="mt-40">
                            Gamers Parlor matches you up with other players waiting
                            to fuel their competitive fire for cash prizes
                        </p>
                        <div class="app-download d-flex flex-wrap gap-2 align-items-center justify-content-end mt-25">
                            <a href="" class="d-btn d-flex justify-content-center overflow-hidden">
                                <img src="{{ asset('assets/landing-page-assets/imgs/playstore.png') }}"
                                    class="img-fluid" alt="">
                            </a>
                            <a href="" class="d-btn d-flex justify-content-center overflow-hidden">
                                <img src="{{ asset('assets/landing-page-assets/imgs/appstore.png') }}"
                                    class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <footer class="position-relative" id="footer">
        {{-- <div class="ft-float-img position-absolute d-lg-flex d-none">
            <img src="{{ asset('assets/landing-page-assets/imgs/ftfish1.png') }}" class="img-fluid" alt="">
        </div>
        <div class="newsletter get-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="news-letter d-flex flex-column align-items-end justify-content-center text-center">
                            <div>
                                <h1 class="text-light text-uppercase fw-bolder">newsletter</h1>
                                <p class="text-light">Get More Information to Register now</p>
                            </div>
                            <form action="" class="sub-input mt-4 flex-column flex-md-row">
                                <input type="email"
                                    class="bg-transparent border border-1 border-light text-light px-4"
                                    placeholder="Your Email">
                                <button type="submit" class="btn btn-light btn-group-lg rounded-0">subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="copyrights text-center d-flex flex-column justify-content-center align-items-center gap-3">
            <p class="text-light tezt-center">
                <span>&copy;</span> 2022 Gamers Parlor G.P. All rights reserved.
                <br>
                Gamers Parlor G.P. is not endorsed by, directly affiliated with, maintained or sponsored by Riot Games,
                Inc. or VALORANT Esports, Apple Inc, Electronic Arts, Activision Blizzard, Take-Two Interactive,
                Microsoft, Xbox, Sony, PlayStation or Epic Games. All content, games titles, trade names and/or trade
                dress, trademarks, artwork and associated imagery are trademarks and/or copyright material of their
                respective owners.
            </p>
            <div class="d-flex align-items-center justify-content-center">
                <a href="{{ route('terms') }}" target="_blank" rel="noopener noreferrer"
                    class="text-light text-capitalize get-center">terms</a>
                <span class="text-light text-capitalize get-center mx-3">|</span>
                <a href="{{ route('privacy') }}" target="_blank" rel="noopener noreferrer"
                    class="text-light text-capitalize get-center">conditions</a>
            </div>
        </div>
    </footer>



    <script src="{{ asset('assets/landing-page-assets/custom-js/jquery.js') }}"></script>
    <script src="{{ asset('assets/landing-page-assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page-assets/custom-js/swiper.js') }}"></script>
    <script src="{{ asset('assets/landing-page-assets/custom-js/custom.js') }}"></script>
    <script src="{{ asset('assets/landing-page-assets/fontawesome/js/all.min.js') }}"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "cards",
            grabCursor: true,
        });
    </script>

</body>

</html>
