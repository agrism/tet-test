<html>
<head>
    <title>Currency rates</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>



    </style>
</head>
<body class="d-flex flex-column h-100">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Currency rates</a>
    </nav>
</header>

<main role="main" class="container">
    @yield('content')
</main>>

<script src="/js/app.js"></script>
</body>
</html>
