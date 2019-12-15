<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DirEngine - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">

    <link rel="stylesheet" href="/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.css">

    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">

    <link rel="stylesheet" href="/css/aos.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">

    <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/css/jquery.timepicker.css">


    <link rel="stylesheet" href="/css/flaticon.css">
    <link rel="stylesheet" href="/css/icomoon.css">
    <link rel="stylesheet" href="/css/style.css">

    <style>
            #myMap {
               height: 350px;
               width: 680px;
            }
    </style>

    <?php $latitude = $homestay->latitude_homestay?>
    <?php $longitude = $homestay->longitude_homestay?>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLoMMn99YE6DsmN97AOnzs1G0mcOOpJ9U&callback=initMap">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
    </script>
    <script type="text/javascript">
        var map;
        var marker;
        var myLatlng = new google.maps.LatLng({!! json_encode($latitude) !!}, {!! json_encode($longitude) !!});
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
        function initialize(){
        var mapOptions = {
        zoom: 14,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

        marker = new google.maps.Marker({
        map: map,
        position: myLatlng,
        draggable: true
        });

        geocoder.geocode({'latLng': myLatlng }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
        $('#latitude,#longitude').show();
        $('#address').val(results[0].formatted_address);
        $('#latitude').val(marker.getPosition().lat());
        $('#longitude').val(marker.getPosition().lng());
        infowindow.setContent(results[0].formatted_address);
        infowindow.open(map, marker);
        }
        }
        });

        google.maps.event.addListener(marker, 'dragend', function() {

        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
        $('#address').val(results[0].formatted_address);
        $('#latitude').val(marker.getPosition().lat());
        $('#longitude').val(marker.getPosition().lng());
        infowindow.setContent(results[0].formatted_address);
        infowindow.open(map, marker);
        }
        }
        });
        });

        }
        google.maps.event.addDomListener(window, 'load', initialize);
        </script>

  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="/">FindStay.</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
                @if(Auth::check())
                <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                <li class="nav-item"><p class="nav-link"> You're Traveler! </p></li>
                <li class="nav-item cta"><a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <span>Log Out</span></a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  @elseif(Auth::guard('owner')->check())
                <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{url('signup_homestay')}}" class="nav-link">Add Homestay</a></li>
                <li class="nav-item"><p class="nav-link"> You're Owner! </p></li>
                <li class="nav-item cta"><a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <span>Log Out</span></a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  @else
                <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                <li class="nav-item cta"><a href="/login-user" class="nav-link"><span>Log in</span></a></li>
                  @endif
        </ul>
      </div>
    </div>
  </nav>
    <!-- END nav -->

    <div class="hero-wrap js-fullheight" style="background-image: url('/images/bg_5.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
          <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="/">Home</a></span> <span class="mr-2"></span> <span>Hotel Single</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Homestay Details</h1>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
          	<div class="row">
          		<div class="col-md-12 ftco-animate">
          			<div class="single-slider owl-carousel">
          				<div class="item">
          					<div class="hotel-img" style="background-image: url(<?= $homestay->foto_homestay?>);"></div>
          				</div>
          			</div>
          		</div>
          		<div class="col-md-12 hotel-single mt-4 mb-5 ftco-animate">
          			<span>Our Best Homestay</span>
          			<h2><?= $homestay->nama_homestay?></h2>
          			<p class="rate mb-5">
          				<span class="loc"><a href="#"><i class="icon-map"></i> <?= $homestay->alamat_homestay?></a></span>
          				<span class="star">
    							<i class="icon-money"></i>
    							Rp <?= $homestay->harga_homestay?>/night</span>
    						</p>
    						<p><?=$homestay->deskripsi_homestay?></p>

    						</div>

          		</div>
          		<div class="col-md-12 hotel-single ftco-animate mb-5 mt-4">
          			<h4 class="mb-4">Our Homestay Location</h4>
                      <div id="myMap"></div>

                  </div>
                  <?php
                        // Set your Merchant Server Key
                        \Midtrans\Config::$serverKey = 'SB-Mid-server-vg9xdjx-fHJrfLSkEMVxIEAf';
                        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                        \Midtrans\Config::$isProduction = false;
                        // Set sanitization on (default)
                        \Midtrans\Config::$isSanitized = true;
                        // Set 3DS transaction for credit card to true
                        \Midtrans\Config::$is3ds = true;

                        $params = array(
                        'transaction_details' => array(
                         'order_id' => rand(),
                         'gross_amount' => $homestay->harga_homestay,
                            )
                            );

                        $snapToken = \Midtrans\Snap::getSnapToken($params);
                  ?>

          		<div class="col-md-12 hotel-single ftco-animate mb-5 mt-4">
          			<h4 class="mb-5">Check Availability &amp; Booking</h4>
          			<div class="fields">
                      <form action="{{url('book_homestay')}}" method="post">
                            @csrf
          				<div class="row">
          					<div class="col-md-6">
				              <div class="form-group">
				                <input type="text" class="form-control" name="nama" value="<?=Auth::user()->nama_depan_wisatawan?> <?=Auth::user()->nama_belakang_wisatawan ?> " placeholder="Name">
				              </div>
                          </div>
                                <input type="hidden" class="form-control" name="nama_homestay" value="<?=$homestay->nama_homestay?>" placeholder="Name">
                                <input type="hidden" class="form-control" name="total_harga" value="<?=$homestay->harga_homestay?>" placeholder="Name">
			              <div class="col-md-6">
				              <div class="form-group">
				                <input type="text" class="form-control" value="<?=Auth::user()->email_wisatawan?>" placeholder="Email">
				              </div>
                          </div>

			              <div class="col-md-6">
				              <div class="form-group">
				                <input type="text"  class="form-control" name="tanggal_masuk" placeholder="Date from:YYYY-mm-dd" required>
				              </div>
			              </div>
			              <div class="col-md-6">
				              <div class="form-group">
				                <input type="text"  class="form-control" name="tanggal_keluar" placeholder="Date to:YYYY-mm-dd" required>
				              </div>
				            </div>
			              <div class="col-md-6">
					            <div class="form-group">
				                <div class="select-wrap one-third">
			                  </div>
				              </div>
			              </div>
				            <div class="col-md-12">
				              <div class="form-group">
				                <input type="submit" value="Book now!" class="btn btn-primary py-3">
				              </div>
			              </div>
                      </div>
                    </form>
		            </div>
          		</div>

          	</div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">dirEngine</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Service</a></li>
                <li><a href="#" class="py-2 d-block">Terms and Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Become a partner</a></li>
                <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                <li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Customer Support</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                <li><a href="#" class="py-2 d-block">How it works</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-IGi6jx4lV3_C1YMX"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('<?=$snapToken?>', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/js/popper.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/jquery.easing.1.3.js"></script>
  <script src="/js/jquery.waypoints.min.js"></script>
  <script src="/js/jquery.stellar.min.js"></script>
  <script src="/js/owl.carousel.min.js"></script>
  <script src="/js/jquery.magnific-popup.min.js"></script>
  <script src="/js/aos.js"></script>
  <script src="/js/jquery.animateNumber.min.js"></script>
  <script src="/js/bootstrap-datepicker.js"></script>
  <script src="/js/jquery.timepicker.min.js"></script>
  <script src="/js/scrollax.min.js"></script>
  <script src="/js/google-map.js"></script>
  <script src="/js/main.js"></script>

  </body>
</html>
