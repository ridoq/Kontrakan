<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    @include('component.head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        #loadingSpinner {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            z-index: 9999;
            justify-content: center;
            align-items: center;
            display: flex;
            animation: opacity 1s
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: .4em;
            border-radius: 50%;
            border-top-color: #3e0fd8;
            border-left-color: transparent;
            border-bottom-color: transparent;
            border-right-color: transparent;
            animation: spinner-border 0.40s linear infinite;
        }

        @keyframes spinner-border {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes opacity {
            0% {
                background: rgba(255, 255, 255, 255);
            }

            25% {
                background: rgba(255, 255, 255, 255);
            }

            50% {
                background: rgba(255, 255, 255, 255);
            }

            75% {
                background: rgba(255, 255, 255, 0.1);
            }

            100% {
                background: rgba(255, 255, 255, 0);
            }
        }
    </style>
</head>

<body onload="showSpinner()">
    <div id="loadingSpinner" class=" justify-content-center align-items-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script>
        function showSpinner() {
            const spinner = document.getElementById('loadingSpinner');
            spinner.style.display = 'flex';

            // Mengatur interval untuk memeriksa apakah halaman telah sepenuhnya dimuat
            const intervalId = setInterval(function() {
                if (document.readyState === 'complete') {
                    // Menyembunyikan spinner setelah 2 detik jika halaman telah sepenuhnya dimuat
                    setTimeout(function() {
                        spinner.style.display = 'none';
                        clearInterval(intervalId); // Menghentikan interval setelah spinner disembunyikan
                    }, 350); // Durasi spinner loading dalam milidetik (2 detik)
                }
            }, 100); // Interval pemeriksaan dalam milidetik (100ms)
        }
    </script>


    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar ">
        {{-- side bar --}}
        @include('component.sidebar')
        <!-- Layout container -->
        <div class="layout-page ">
            <!-- Navbar -->
            @include('component.navbar')

            <!-- Content wrapper -->
            <div class="content-wrapper ">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row g-5">
                        @if (session('success'))
                            <div class="col-12">
                                <div class="alert alert-solid-success alert-dismissible d-flex align-items-center shadow-sm"
                                    role="alert">
                                    <span class="alert-icon rounded">
                                        <i class="ri-checkbox-circle-line ri-22px"></i>
                                    </span>
                                    <strong> {{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                        aria-hidden="true"></button>
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="col-12">
                                <div class="alert alert-solid-danger alert-dismissible d-flex align-items-center shadow-sm"
                                    role="alert">
                                    <span class="alert-icon rounded">
                                        <i class="ri-checkbox-circle-line ri-22px"></i>
                                    </span>
                                    <strong> {{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                                        aria-hidden="true"></button>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="col-12">
                                    <div class="alert alert-solid-danger alert-dismissible d-flex align-items-center shadow-sm"
                                        role="alert">
                                        <span class="alert-icon rounded">
                                            <i class="ri-checkbox-circle-line ri-22px"></i>
                                        </span>
                                        <strong> {{ $error }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close" aria-hidden="true"></button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @yield('content')
                        {{-- @include('component.loading') --}}
                    </div>
                </div>
                <!-- / Content -->

                <!-- Footer -->
                {{-- <footer class="content-footer footer bg-footer-theme">
                  <div class="container-xxl">
                    <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                      <div class="text-body mb-2 mb-md-0">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>, made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by <a href="https://pixinvent.com/" target="_blank" class="footer-link">Pixinvent</a>
                      </div>
                      <div class="d-none d-lg-inline-block">
                        <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
                        <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>
                        <a href="https://demos.pixinvent.com/materialize-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
                        <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                      </div>
                    </div>
                  </div>
                </footer> --}}
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    @include('component.script')

    <!-- JavaScript Inline -->



</body>

</html>
