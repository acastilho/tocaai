<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TocaAí')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #0A0A0A; color: white; font-family: 'Lexend', sans-serif; }
        .card-tocaai { background-color: #161616; border: 1px solid #222; border-radius: 20px; }
        .btn-coral { background-color: #FF4757; color: white; border-radius: 50px; font-weight: bold; border: none; transition: 0.3s; }
        .btn-coral:hover { background-color: #ff6b81; transform: translateY(-2px); color: white; }
        .form-control { background-color: #0A0A0A; border: 1px solid #333; color: white; }
        .form-control:focus { background-color: #0f0f0f; border-color: #FF4757; color: white; box-shadow: none; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
