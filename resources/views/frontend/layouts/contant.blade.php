<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Allaia | Bootstrap eCommerce Template - ThemeForest</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('frontend')}}/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('frontend')}}/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('frontend')}}/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('frontend')}}/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('frontend')}}/css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="{{asset('frontend')}}/css/contact.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('frontend')}}/css/custom.css" rel="stylesheet">

</head>

<body>

	<div id="page">

     @include('frontend.layouts.header')
	<!-- /header -->

	<main class="bg_gray">

			<div class="container margin_60">
				<div class="main_title">
					<h2>Contact Allaia</h2>
					<p>Euismod phasellus ac lectus fusce parturient cubilia a nisi blandit sem cras nec tempor adipiscing rcu ullamcorper ligula.</p>
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-4">
						<div class="box_contacts">
							<i class="ti-support"></i>
							<h2>Allaia Help Center</h2>
							<a href="#0">+94 423-23-221</a> - <a href="#0">help@allaia.com</a>
							<small>MON to FRI 9am-6pm SAT 9am-2pm</small>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="box_contacts">
							<i class="ti-map-alt"></i>
							<h2>Allaia Showroom</h2>
							<div>6th Forrest Ray, London - 10001 UK</div>
							<small>MON to FRI 9am-6pm SAT 9am-2pm</small>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="box_contacts">
							<i class="ti-package"></i>
							<h2>Allaia Orders</h2>
							<a href="#0">+94 423-23-221</a> - <a href="#0">order@allaia.com</a>
							<small>MON to FRI 9am-6pm SAT 9am-2pm</small>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
    <form action="{{route('contactPost')}}" method="POST">
        @csrf
		<div class="bg_white">
			<div class="container margin_60_35">
				<h4 class="pb-3">Drop Us a Line</h4>
                {{-- @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif --}}
				<div class="row">
					<div class="col-lg-4 col-md-6 add_bottom_25">
						<div class="form-group">
							<input value="{{ old('name') }}" name = "name" class="form-control" type="text" placeholder="Name *">
						</div>
                        @error('name')
                        <p  style = "color : red;">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
							<input value="{{ old('phone') }}" name = "phone" class="form-control" type="tel" placeholder="Phone *">
						</div>
                        @error('phone')
                        <p  style = "color : red;">{{ $message }}</p>
                        @enderror
						<div class="form-group">
							<input value="{{ old('email') }}" name = "email" class="form-control" type="email" placeholder="Email *">
						</div>
                        @error('email')
                        <p  style = "color : red;">{{ $message }}</p>
                        @enderror
						<div class="form-group">
							<textarea  value="{{ old('content') }}" name = "content" class="form-control" style="height: 150px;" placeholder="Message *"></textarea>
						</div>
                        @error('content')
                        <p  style = "color : red;">{{ $message }}</p>
                        @enderror
						<div class="form-group">
							<input class="btn_1 full-width btnSend" type="submit" value="Submit">
						</div>
					</div>
					<div class="col-lg-8 col-md-6 add_bottom_25">
					<iframe class="map_contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39714.47749917409!2d-0.13662037019554393!3d51.52871971170425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondra%2C+Regno+Unito!5e0!3m2!1sit!2ses!4v1557824540343!5m2!1sit!2ses" style="border: 0" allowfullscreen></iframe>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_white -->
    </form>
	</main>
	<!--/main-->

    @include('frontend.layouts.footer')
	<!--/footer-->
	</div>
	<!-- page -->

	<div id="toTop"></div><!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
    <script src="{{asset('frontend')}}/js/common_scripts.min.js"></script>
    <script src="{{asset('frontend')}}/js/main.js"></script>

</body>
</html>



