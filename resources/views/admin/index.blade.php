@extends('layouts.adminLayout')
@section('header')
<style>
  #map {
    height: 400px;
    width: 100%;
   }
</style>
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
      </h1>
      <ol class="breadcrumb">
        <li><a href="/administrator"><i class="fa fa-home"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-feed"></i></span>

              <div class="info-box-content">
                <span class='info-box-text'>News</span>
                <span class="info-box-number">{{$data['news']}}</span>
                <span class="progress-description" style="margin-top: 12px;">
                    <a href="/administrator/news" style="text-decorations:none; color:inherit;"><b>See more</b></a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        <!-- /.col -->

          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-map-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tours</span>
                <span class="info-box-number">{{$data['tours']}}</span>
                <span class="progress-description" style="margin-top: 12px;">
                    <a href="/administrator/tours" style="text-decorations:none; color:inherit;"><b>See more</b></a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Promotions</span>
                <span class="info-box-number">{{$data['promotions']}}</span>
                <span class="progress-description" style="margin-top: 12px;">
                    <a href="/administrator/promotions" style="text-decorations:none; color:inherit;"><b>See more</b></a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-video-camera  "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Video</span>
                <span class="info-box-number">{{$data['videos']}}</span>
                <span class="progress-description" style="margin-top: 12px;">
                    <a href="/administrator/video" style="text-decorations:none; color:inherit;"><b>See more</b></a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        <!-- /.col -->
          </div>  
        </div>
        <div class="col-md-8">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-map"></i> Tours Map</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
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
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-feed"></i> Recently Added News</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($news as $n)
                <li class="item">
                  <div class="product-img">
                    <img class="img-responsive" src="/images/news/{{$n->image}}" >
                  </div>
                  <div class="product-info">
                    <a href="/administrator/news" class="product-title">{{$n->title}}</a>
                        <span class="product-description">
                          {{$n->date}}
                        </span>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="/administrator/news" class="uppercase">View All News</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection

  @section('js')
    <script>
      var map;
      var point;

      function initMap() {
        point = {lat: -7.104843, lng: 109.421864};
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: point
        });
        var marker = new google.maps.Marker({
          position: point,
          animation: google.maps.Animation.DROP,
          map: map
        });

        getLocationTours();
      }

      function getLocationTours(){
        $.getJSON('tours/json', function(data) { 
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

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQc7eRbHzd2uo60nlzH_4G2BZqLd5j-xg&callback=initMap">
    </script>
  @endsection