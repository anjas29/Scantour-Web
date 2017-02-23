@extends('layouts.adminLayout')
@section('header')
  <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.min.css">
  <style>
    #map {
      height: 400px;
      width: 100%;
     }

    .img-view {
      position: relative;
    }
    .img-view button {
      position: absolute;
      top: 5px;
      right: 5px;
      height: 35px;
      width: 35px;
      display: block;
    }
  </style>
@stop
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tours
      </h1>
      <ol class="breadcrumb">
        <li><a href="/administrator/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/administrator/tours">Tours</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">Tours Map</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <br>
                <div class="form-group col-sm-6 col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i> Lat</span>
                    <input type="text" class="input-disabled form-control" id="latvalSearch" value="" name="lat">
                  </div><!-- /input-group -->
                </div>
                <div class="form-group col-sm-6 col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i> Long</span>
                    <input type="text" class="input-disabled form-control" id="longvalSearch" value="" name="long">
                  </div><!-- /input-group -->
                </div>
              
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div id="map"></div>
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-map-o"></i>
              <h3 class="box-title">Tours Data</h3>
              
            </div>
            <div class="box-body">
              <table class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $c=1; ?>
                  @foreach($data as $d)
                  <tr>
                      <td>{{ $c++ }}</td>
                      <td>{{ $d->name }}</td>
                      <td>{{ $d->city }}</td>
                      <td>{{ $d->price}}</td>
                      <td>
                        <a href="#" class="detail btn btn-xs btn-success" data-toggle='modal' data-target='#detailTourModal' data-id='{{$d->id}}' data-name='{{$d->name}}' data-lat='{{$d->latitude}}' data-long='{{$d->longitude}}' data-city='{{$d->city}}' data-address='{{$d->address}}' data-description='{{$d->description}}' data-price='{{$d->price}}' data-image='{{$d->photo}}'><i class="fa fa-eye"></i></a>
                        <a href="#" class="delete btn btn-xs btn-danger" data-id='{{$d->id}}' data-name='{{$d->name}}'><i class="fa fa-times"></i></a>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" tabindex="-1" role="dialog" id='createTourModal'>
    <div class="modal-dialog" role="document">
      <form action="/administrator/tours/create" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <strong>Create Tour</strong><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map"></i></span>
                  <input type="text" class="form-control" placeholder="Name" id='createName' name="name">
                </div>
              </div>
              <div class="form-group col-sm-6 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i> Lat</span>
                  <input type="text" class="input-disabled form-control" id="latval" value="" disabled name="lat">
                </div><!-- /input-group -->
              </div>
              <div class="form-group col-sm-6 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i> Long</span>
                  <input type="text" class="input-disabled form-control" id="longval" value="" disabled name="long">
                </div><!-- /input-group -->
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-building"></i></span>
                  <input type="text" class="form-control" placeholder="City" id='createCity' name="city">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                  <input type="text" class="form-control" placeholder="Address" id='createAddress' name="address">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="text" class="form-control" placeholder="Price" id='createPrice' name="price">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                  <textarea class="form-control" placeholder="Description" id="createDescription" name="description"></textarea>
                </div>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-image"></i></span>
                  <input type="file" class="form-control" placeholder="Image" id='createImage' name="image">
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <img src="" id="createImageDetail" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                <br>
              </div>
          </div>
          <div class="modal-footer">
              {{csrf_field()}}
              <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
              <button type="submit" id="submit_it" class="btn btn-sm btn-primary pull-right">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id='detailTourModal'>
    <div class="modal-dialog" role="document">
      <form action="/administrator/tours/update" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <strong>Detail Tour</strong><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map"></i></span>
                  <input type="text" class="form-control" placeholder="Name" id='detailName' name="name">
                </div>
              </div>
              <div class="form-group col-sm-6 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i> Lat</span>
                  <input type="text" class="input-disabled form-control" id="detailLat" value="" disabled name="lat">
                </div><!-- /input-group -->
              </div>
              <div class="form-group col-sm-6 col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i> Long</span>
                  <input type="text" class="input-disabled form-control" id="detailLong" value="" disabled name="long">
                </div><!-- /input-group -->
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-building"></i></span>
                  <input type="text" class="form-control" placeholder="City" id='detailCity' name="city">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-book"></i></span>
                  <input type="text" class="form-control" placeholder="Address" id='detailAddress' name="address">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="text" class="form-control" placeholder="Price" id='detailPrice' name="price">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                  <textarea class="form-control" placeholder="Description" id="detailDescription" name="description"></textarea>
                </div>
              </div>
              <div class="form-group col-sm-12" style="display: none;">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-image"></i></span>
                  <input type="file" class="form-control" placeholder="Image" id='files' name="image">
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <div class="img-view">
                  <img src="" id="detailImageDetail" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                  <button type="button" id="filesTrigger" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></button>  
                </div>
                <br>
              </div>
          </div>
          <div class="modal-footer">
              {{csrf_field()}}
              <input type="hidden" name="id" value="" id='detailId'>
              <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
              <button type="submit" id="submit_it" class="btn btn-sm btn-primary pull-right">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @endsection
  @section('js')
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables.bootstrap.js') }}"></script>
    
    <script>
      var map;
      var marker;
      var infowindow;
      var contentString;
      var def_latval = 131.044;
      var def_latval = -25.363

      function initMap() {
        var point = {lat: -7.104843, lng: 109.421864};
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: point
        });
        marker = new google.maps.Marker({
          position: point,
          animation: google.maps.Animation.BOUNCE,
          map: map
        });

        contentString = "<div id='content'><h3>Selected Marker</h3><p><ul><li><b>Latitde</b> :"+marker.getPosition().lat()+"</li><li><b>Longitude</b> :"+marker.getPosition().lng()+"</li></ul></p><button class='btn btn-xs btn-primary' id='createTour' data-toggle='modal' data-target='#createTourModal'><i class='fa fa-map-marker'></i> Add New   Tour Here</button></div>";

        infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        map.addListener('click', function(event) {
          document.getElementById("longval").value = event.latLng.lng().toFixed(6);
          document.getElementById("latval").value = event.latLng.lat().toFixed(6);

          document.getElementById("longvalSearch").value = event.latLng.lng().toFixed(6);
          document.getElementById("latvalSearch").value = event.latLng.lat().toFixed(6);;

          marker.setPosition(event.latLng);
          map.setCenter(event.latlng);
          info_window_update();
        });

        marker.addListener('click', function() {
          info_window_update();
          infowindow.open(map, marker);
        });

        document.getElementById("longval").value = marker.getPosition().lng().toFixed(6);
        document.getElementById("latval").value = marker.getPosition().lat().toFixed(6);

        document.getElementById("longvalSearch").value = marker.getPosition().lng().toFixed(6);
        document.getElementById("latvalSearch").value = marker.getPosition().lat().toFixed(6);
        getLocationTours();
      }

      function info_window_update(){
        contentString = "<div id='content'><h3>Selected Marker</h3><p><ul><li><b>Latitde</b> :"+marker.getPosition().lat()+"</li><li><b>Longitude</b> :"+marker.getPosition().lng()+"</li></ul></p><button class='create btn btn-xs btn-primary' id='createTour' data-toggle='modal' data-target='#createTourModal'><i class='fa fa-map-marker'></i> Add New Tour Here</button></div>";
        infowindow.setContent(contentString);
      }

      function getLocationTours(){
        $.getJSON('/administrator/tours/json', function(data) { 
            $.each( data, function(i, value) {

                var myLatlng = new google.maps.LatLng(value.latitude, value.longitude);
                
                var addMarker = new google.maps.Marker({
                  position: myLatlng,
                  map: map,
                  animation: google.maps.Animation.DROP,
                  title: "Title "+value.name
                  });

            });
          });
      }

      function load_map(){
        var longval = document.getElementById("longvalSearch").value;
        var latval = document.getElementById("latvalSearch").value;

        if (longval.length > 0) {
          if (isNaN(parseFloat(longval)) == true) {
            longval = def_longval;
          } // end of if
        } else {
          longval = def_longval;
        } // end of if

        if (latval.length > 0) {
          if (isNaN(parseFloat(latval)) == true) {
            latval = def_latval;
          } // end of if
        } else {
          latval = def_latval;
        } // end of if

        var curpoint = new google.maps.LatLng(latval,longval);

        marker.setPosition(curpoint);
        map.setCenter(curpoint);
        info_window_update();
      }

      $("#latvalSearch").on('change keydown paste input', function(){
            load_map();
      });

      $("#longvalSearch").on('change keydown paste input', function(){
            load_map();
      });
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQc7eRbHzd2uo60nlzH_4G2BZqLd5j-xg&callback=initMap">
    </script>
    <script>
      $(document).ready(function() {
        $('.dataTable').dataTable();
      });
    </script>
    <script type="text/javascript">
      document.getElementById("createImage").onchange = function () {
          var reader = new FileReader();

          reader.onload = function (e) {
              // get loaded data and render thumbnail.
               $("#createImageDetail").fadeOut(1000, function() {
                    document.getElementById("createImageDetail").src = e.target.result;
                }).fadeIn(1000);
          };

          // read the image file as a data URL.
          reader.readAsDataURL(this.files[0]);
      };

      $("#filesTrigger").click(function() {
          $("#files").click();
      });

      document.getElementById("files").onchange = function () {
          var reader = new FileReader();

          reader.onload = function (e) {
              // get loaded data and render thumbnail.
               $("#detailImageDetail").fadeOut(1000, function() {
                    document.getElementById("detailImageDetail").src = e.target.result;
                }).fadeIn(1000);
              
          };

          // read the image file as a data URL.
          reader.readAsDataURL(this.files[0]);
      };
      $('.detail').click(function(){
        var name = $(this).data('name');
        var image = $(this).data('image');
        var price = $(this).data('price');
        var lat = $(this).data('lat');
        var long = $(this).data('long');
        var city = $(this).data('city');
        var address = $(this).data('address');
        var description = $(this).data('description');
        var id = $(this).data('id');

        $('#detailName').val(name);
        $('#detailLat').val(lat);
        $('#detailLong').val(long);
        $('#detailDescription').val(description);
        $('#detailCity').val(city);
        $('#detailAddress').val(address);
        $('#detailPrice').val(price);
        $('#detailId').val(id);

        $('#detailImageDetail').attr('src', '/images/tours/'+ image);
        $('#detailPomotions').modal();

      });

      $('.delete').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var _token = '{{csrf_token()}}';

        bootbox.confirm("<b>Delete Tour</b> with this name : <strong>"+name+" </strong> ?", function(result) {
          if (result) {
            toastr.options.timeOut = 0;
            toastr.options.extendedTimeOut = 0;
            toastr.info('<i class="fa fa-spinner fa-spin"></i><br>Process...');
            toastr.options.timeOut = 5000;
            toastr.options.extendedTimeOut = 1000;
            $.post("/administrator/tours/delete", {id: id, _token:_token})
            .done(function(result) {
              window.location.replace("/administrator/tours/");
            })
            .fail(function(result) {
              toastr.clear();
              toastr.error('Server Error! Please reload this page again.');
            });
          };
        }); 
      });

      $('#submit_it').click(function() {
            $('.input-disabled').removeAttr("disabled");
      });
    </script>

  @stop