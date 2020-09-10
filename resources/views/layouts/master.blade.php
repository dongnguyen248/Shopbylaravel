<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel </title>
	<base href="{{asset('')}}">
	<link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="assets/dest/css/style.css">
	<link rel="stylesheet" href="assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
	<div class="wrapper" id="app">
  @include('layouts.header')
  
	<div class=" container">
    <div class="content">
      <div class="">
      <router-view ></router-view>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
  @include('layouts.footer')
  @include('layouts.copyright')


	</div>
<script src="/js/app.js"></script>
</body>
</html>
