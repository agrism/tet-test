<html>
<head>
    <title>Currency rates</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">

    <style>
        .container{
            margin-top: 70px;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }


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
