<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth" dir="ltr">

<head>
    <!-- META ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="author" content="Eng. Felix Nyachio" />
    <meta name="robots" content="" />
    <title>Notification System</title>
    <!-- DESCRIPTION -->
    <meta name="description" content="Notification System With Laravel & Vuejs" />
    <!-- OG -->
    <meta property="og:title" content="Notification System With Laravel & Vuejs" />
    <meta property="og:description" content="Notification System With Laravel & Vuejs" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">
    {{--  --}}
    <link rel="icon" type="icon" href="{{ asset('assets/themes/plurk/assets/images/favicon.png') }}" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;700;800&display=swap" rel="stylesheet" />
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="{{ asset('assets/themes/plurk/assets/css/swiper-bundle.min.css') }}" />
    <!-- AOS Animation CSS -->
    <link href="{{ asset('assets/themes/plurk/assets/css/aos.css') }}" rel="stylesheet" />
    <!-- FancyBox -->
    <link rel="stylesheet" href="{{ asset('assets/themes/plurk/assets/css/fancybox.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/themes/plurk/assets/css/style.css') }}" />
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="overflow-x-hidden">
    <div id="app" class="bg-white font-mulish text-base text-gray antialiased dark:bg-[#101926]">
        <guestmaster></guestmaster>
    </div>
</body>

</html>
