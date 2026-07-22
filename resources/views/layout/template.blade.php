<!doctype html>
<html lang="en"><!-- [Head] start -->

<head>
    <title>Home | Light Able Admin & Dashboard Template</title><!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Light Able admin and dashboard template offer a variety of UI elements and pages, ensuring your admin panel is both fast and effective.">
    <meta name="author" content="phoenixcoded"><!-- [Favicon] icon -->
    <x-head></x-head>
</head><!-- [Head] end --><!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light"><!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div><!-- [ Pre-loader ] End --><!-- [ Sidebar Menu ] start -->
    <x-pages.sidebar></x-pages.sidebar><!-- [ Sidebar Menu ] end --><!-- [ Header ] start -->
    <x-pages.header></x-pages.header><!-- [ Header ] end --><!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content"><!-- [ breadcrumb ] start -->
            {{-- <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Home</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- [ breadcrumb ] end --><!-- [ Main Content ] start --> --}}
            <div class="row">
                {{ $slot }}
            </div><!-- [ Main Content ] end -->
        </div>
    </div><!-- [ Main Content ] end -->
    <x-footer></x-footer>
    <x-script></x-script>
    @stack('script')
</body><!-- [Body] end -->

</html>
