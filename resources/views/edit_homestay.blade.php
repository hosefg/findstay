<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Findstay Homepage</title>
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
 <?php $latitude = $homestay->latitude_homestay; ?>
 <?php    $longitude = $homestay->longitude_homestay; ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLoMMn99YE6DsmN97AOnzs1G0mcOOpJ9U&callback=initMap">
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script type="text/javascript">
    //var latitude = {!! json_encode($homestay->latitude) !!};
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

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark " id="ftco-navbar">
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
    <section class="ftco-section ftco-destination">
            <div class="container">
                <div class="col-md-6 pr-md-">



                        <h2 class="mb-4"><strong>Sign up</strong> as Homestay Owner</h2>
                <form action="/homestay/{{$homestay->id_homestay}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                            {{ csrf_field()}}
                        <div class="form-group">
                        Id Owner<input type="text" class="form-control" id="id_owner" name="id_owner" value="<?=$id_owner?>" placeholder="Nama Homestay">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_homestay" name="nama_homestay" value="<?=$homestay->nama_homestay?>" placeholder="Nama Homestay">
                            {{ $errors->first('nama_homestay')}}
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="alamat_homestay" name="alamat_homestay" value="<?=$homestay->alamat_homestay?>" placeholder="Alamat Homestay">
                            {{ $errors->first('alamat_homestay')}}
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="harga_homestay" name="harga_homestay" value="<?=$homestay->harga_homestay?>" placeholder="Harga homestay / hari">
                            {{ $errors->first('harga_homestay')}}
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="deskripsi_homestay" name="deskripsi_homestay" value="<?=$homestay->deskripsi_homestay?>" placeholder="Deskripsi Homestay">
                            {{ $errors->first('deskripsi_homestay')}}
                        </div>
                        <div class="form-group">
                             Upload Photo<input type="file" class="form-control" id="foto_homestay" name="foto_homestay" value="<?=$homestay->foto_homestay?>" placeholder="Deskripsi Homestay" required>
                             {{ $errors->first('foto_homestay')}}
                        </div>
                        Select location
                        <div id="myMap"></div>
                        <input id="address" type="text" style="width:600px;"/><br/>
                        <div class="form-group">
                        <input type="text" id="latitude" name="latitude" value="<?=$homestay->latitude?>" placeholder="Latitude"/>
                        <input type="text" id="longitude" name="longitude" value="<?=$homestay->longitude?>" placeholder="Longitude"/>
                        </div>
                        <div class="form-group">
                                <input type="submit" value="Sign up now" class="btn btn-primary py-2 px-3">
                        </div>
                        </form>

                      </div>
            </div>
    </section>
    </div>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>



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
