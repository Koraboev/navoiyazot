<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <!-- metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <!-- title  -->
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:site_name" content="Navoiyazot">
    <meta property="og:locale" content="{{ app()->getLocale() }}">
    
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/logos/logo.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/logos/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/logos/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/logos/apple-touch-icon-114x114.png') }}">

    <!-- fa icon list -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- plugins -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">

    <!-- search css -->
    <link rel="stylesheet" href="{{ asset('assets/search/search.css') }}">

    <!-- quform css -->
    <link rel="stylesheet" href="{{ asset('assets/quform/css/base.css') }}">

    <!-- theme core css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- custom css -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <style>
        .search-div{width: 100%;height: 100%;background-color: black;opacity: 0.9;z-index: 999999;position: absolute;padding: 250px 20px;display: none;
        }
        .search-nav{
            display: flex;column-gap: 10px;
        }
        .dropdown-item{
            background-color: white;
        }
    </style>
</head>

<body>
<div class="search-div" id="search-div">
<p class="hide-search text-center mb-3 fs-1 text-danger"><i class="fa fa-close"></i></p>

    <div class="search-nav">
        <input type="text" id="search-input"
                        class="form-control bg-brand-2 border-brand-color" placeholder="Search..."
                        aria-label="Search..." aria-describedby="button-addon2">
        <button
            class="btn btn-outline-secondary border-brand-color bg-brand-2 d-flex align-items-center py-2"
            type="button" id="button-addon2">
            <svg class="address__svg" width="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_167_6100)">
                    <path
                        d="M13.9395 1.93115C8.98074 1.93115 4.94141 5.97047 4.94141 10.9292C4.94141 15.8879 8.98074 19.9351 13.9395 19.9351C16.0575 19.9351 18.0054 19.1929 19.5449 17.9605L23.293 21.7065C23.4821 21.8879 23.7347 21.9879 23.9967 21.9852C24.2587 21.9825 24.5093 21.8774 24.6947 21.6922C24.8801 21.5071 24.9856 21.2568 24.9886 20.9948C24.9917 20.7328 24.892 20.48 24.7109 20.2906L20.9629 16.5426C22.1963 15.0007 22.9395 13.0497 22.9395 10.9292C22.9395 5.97047 18.8982 1.93115 13.9395 1.93115ZM13.9395 3.93118C17.8173 3.93118 20.9375 7.05138 20.9375 10.9292C20.9375 14.807 17.8173 17.9351 13.9395 17.9351C10.0616 17.9351 6.94141 14.807 6.94141 10.9292C6.94141 7.05138 10.0616 3.93118 13.9395 3.93118Z"
                        fill="#A6A6A6" />
                </g>
                <defs>
                    <clipPath id="clip0_167_6100">
                        <rect width="24" height="24" fill="white" />
                    </clipPath>
                </defs>
            </svg>
        </button>
    </div>
    <div id="search-results" class="dropdown-menu"></div>
</div>
    <!-- PAGE LOADING
    ================================================== -->
    <div id="preloader"></div>

    <!-- MAIN WRAPPER
    ================================================== -->
    <div class="main-wrapper">
        <x-header/>

        @yield('content')

        <x-footer/>

    </div>

    <!-- SCROLL TO TOP
    ================================================== -->
    <a href="#!" class="scroll-to-top border-radius-50"><i class="fas fa-angle-up" aria-hidden="true"></i></a>

    <!-- all js include start -->
    <script>

        document.getElementById('search-input').addEventListener('input', function() {
            let query = this.value;
            
            if (query.length > 2) {
                fetch(`/search/${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let dropdown = document.getElementById('search-results');
                        dropdown.innerHTML = '';

                        data.results.forEach(result => {
                            let item = document.createElement('a');
                            item.classList.add('dropdown-item');
                            item.href = result.url;
                            item.textContent = result.name;
                            dropdown.appendChild(item);
                        });

                        dropdown.style.display = data.results.length ? 'block' :
                            'none'; // Natijalarni ko'rsatish
                    });
            } else document.getElementById('search-results').style.display = 'none'; // Natijalarni yashirish
        });

    </script>

    <!-- Adaptation -->
    <script src="{{ asset('assets/js/adaptation.js') }}"></script>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- popper js -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>

    <!-- bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- search -->
    <script src="{{ asset('assets/search/search.js') }}"></script>

    <!-- navigation -->
    <script src="{{ asset('assets/js/nav-menu.js') }}"></script>

    <!-- owl carousel -->
    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>

    <!-- jarallax -->
    <script src="{{ asset('assets/js/jarallax.min.js') }}"></script>

    <!-- jarallax video -->
    <script src="{{ asset('assets/js/jarallax-video.js') }}"></script>

    <!-- jquery.counterup.min -->
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>

    <!-- stellar js -->
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>

    <!-- easy.responsive.tabs js -->
    <script src="{{ asset('assets/js/easy.responsive.tabs.js') }}"></script>

    <!-- waypoints js -->
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>

    <!-- countdown js -->
    <script src="{{ asset('assets/js/countdown.js') }}"></script>

    <!-- jquery.magnific-popup js -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- lightgallery js -->
    <script src="{{ asset('assets/js/lightgallery-all.js') }}"></script>

    <!-- mousewheel js -->
    <script src="{{ asset('assets/js/jquery.mousewheel.min.js') }}"></script>

    <!-- wow js -->
    <script src="{{ asset('assets/js/wow.js') }}"></script>

    <!--  clipboard js -->
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>

    <!--  prism js -->
    <script src="{{ asset('assets/js/prism.js') }}"></script>

    <!-- custom scripts -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- form plugins js -->
    <script src="{{ asset('assets/quform/js/plugins.js') }}"></script>

    <!-- form scripts js -->
    <script src="{{ asset('assets/quform/js/scripts.js') }}"></script>

    <!-- all js include end -->

    </body>

</html>
