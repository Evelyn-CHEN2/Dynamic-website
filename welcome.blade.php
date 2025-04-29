<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <div class="container my-3 d-flex just-fi justify-content-center align-items-center vh-100" style="width:70%;">
            <div class="position-relative p-3 d-flex flex-row">
                <form method="GET" action="{{ route('login') }}">
                    <input type="hidden" name="user_type" value="teacher">
                    <button class="btn btn-sm btn-outline-secondary me-5 fs-3" type="submit">Teacher</button>
                </form>

        <!-- Form for Student -->
                <form method="GET" action="{{ route('login') }}">
                    <input type="hidden" name="user_type" value="student">
                    <button class="btn btn-sm btn-outline-secondary me-5 fs-3" type="submit">Student</button>
                </form>
            </div>
        </div>
    </body>
</html>



