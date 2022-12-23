<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    {{-- My Style CSS --}}
    <link rel="stylesheet" href="/css/style.css">

    <title>Sanz Web | {{ $title }} </title>

</head>

<body>

    @include('partials.navbar')

    <div class="container mt-3 p-4 bg">
        @yield('container')
    </div>

    <div class="footer mt-5 bg-info text-light p-3">
        <div class="row text-center">
            <h6>Copyright 2022. <span class="fw-normal">Sanz Web</span></h6>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
        integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="/js/script.js"></script>
</body>

</html>
