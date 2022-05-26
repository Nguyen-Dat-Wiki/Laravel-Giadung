<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{$title}}</title>

<!-- Google Font: Source Sans Pro -->

<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Theme style -->
<link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">




<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
.table thead tr,
.table tbody tr td {
    white-space: nowrap;
}
</style>
@yield('head')


