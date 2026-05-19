{{-- Redirect to admin login: session expired / not logged in --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="0;url={{ url('admin/login') }}">
    <title>Redirecting to Admin Login...</title>
    <script>window.location.replace("{{ url('admin/login') }}");</script>
</head>
<body>
    <p>Redirecting to <a href="{{ url('admin/login') }}">Admin Login</a>...</p>
</body>
</html>
