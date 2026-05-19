<!DOCTYPE html>
<html>
<title>{{ $weblinks->name }}</title>

<head>
    <link rel="icon" href="{{ asset('admin/assets/images/page') }}/{{ $home_page_data['header_favicon'] }}"
        type="image/png" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    @if ($weblinks->image)
        <img src="{{ asset('admin/assets/images/weblinks/' . $weblinks->image) }}" alt="">
    @else
        <img src="{{ asset('admin/assets/images/weblinks/no-photo1.jpg') }}">
    @endif
</body>

</html>
