<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant - AllGood</title>
    <link rel="stylesheet" href="{{ asset("assetsmerchant/css/arizalar.css") }}">
    <link rel="stylesheet" href="{{ asset("assetsmerchant/css/registration.css") }}">
    <link rel="stylesheet" href="{{ asset("assetsmerchant/css/form.css") }}">
    <link rel="stylesheet" href="{{ asset("assetsmerchant/css/new.css") }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('styles')
</head>
<body>
    <div class="dashboadr__container">
        <div class="twicer">
            @include('layouts.myheader')
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assetsmerchant/js/main.js') }}"></script>
    <script src="{{ asset('assetsmerchant/js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
