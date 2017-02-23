@extends('layouts.adminLayout')
@section('header')
  <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.min.css">
  <style type="text/css">
    .card {
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }

    .card {
      margin-top: 10px;
      box-sizing: border-box;
      border-radius: 2px;
      background-clip: padding-box;
    }
    .card span.card-title {
        color: #fff;
        font-size: 24px;
        font-weight: 300;
        text-transform: uppercase;
    }

    .card .card-image {
      position: relative;
      overflow: hidden;
    }
    .card .card-image img {
      border-radius: 2px 2px 0 0;
      background-clip: padding-box;
      position: relative;
      
    }
    .card .card-image span.card-title {
      position: absolute;
      bottom: 0;
      left: 0;
      padding: 16px;
    }
    .card .card-content {
      padding: 16px;
      border-radius: 0 0 2px 2px;
      background-clip: padding-box;
      box-sizing: border-box;
    }
    .card .card-content p {
      margin: 0;
      color: inherit;
    }
    .card .card-content span.card-title {
      line-height: 48px;
    }
    .card .card-action {
      border-top: 1px solid rgba(160, 160, 160, 0.2);
      padding: 16px;
    }
    .card .card-action a {
      color: #ffab40;
      margin-right: 16px;
      transition: color 0.3s ease;
      text-transform: uppercase;
    }
    .card .card-action a:hover {
      color: #ffd8a6;
      text-decoration: none;
    }

    .img-view {
      position: relative;
    }
    .img-view .button-group {
      position: absolute;
      top: 5px;
      right: 5px;
      height: 35px;
      width: 35px;
      display: none;
    }
    .img-view .button-group button{
      margin-top: 5px;
    }
    .img-view:hover > .button-group {
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
        Promotions
      </h1>
      <ol class="breadcrumb">
        <li><a href="/administrator/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/administrator/promotions">Promotions</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="box box-warning"  style="background: none"> 
            <div class="box-header" style="background: #fff">
              <i class="fa fa-tag"></i>
              <h3 class="box-title">Promotions</h3>
              <button class="btn btn-sm btn-primary pull-right" data-toggle='modal' data-target="#createPromotions">Create</button>
            </div>
            <div class="box-body">
              @foreach($data as $d)
              <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="card">
                      <div class="card-image img-view">
                          <img class="img-responsive" src="/images/promotions/{{$d->image}}">
                          <div class="button-group">
                            <button class="detail btn btn-sm btn-info"  data-image='{{$d->image}}' data-title='{{$d->title}}' data-id='{{$d->id}}' data-created_at='{{$d->date}}' data-author='{{$d->author->name}}'><i class="fa fa-pencil"></i></button>
                            <button class="delete btn btn-sm btn-danger" data-title='{{$d->title}}' data-id='{{$d->id}}'><i class="fa fa-trash"></i></button>
                          </div>
                      </div>
                      <div class="card-content">
                          <p><b>{{$d->title}}</b></p>
                      </div>
                  </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- detail News Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id='detailPomotions'>
    <div class="modal-dialog" role="document">
      <form action="/administrator/promotions/update" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <strong>Promotion Detail</strong><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    <input type="text" class="form-control" placeholder="Title" id='detailTitle' name="title">
                  </div>
                </div>
              </div>
              <div class="col-sm-12" style="display: none;">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                    <input type="file" class="form-control" placeholder="Image" name="image" id="files">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="img-view">
                  <img src="" id="detailImage" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                  <div class="button-group">
                    <button id="filesTrigger" type='button' class="btn btn-sm btn-info" style="display: block;"><i class="fa fa-pencil"></i></button>
                  </div>
                </div>
                <br>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-sm-6"><strong>Created At</strong> <p style="display:inline" id='detailCreatedAt'>ASDASD</p></div>
              <div class="col-sm-6 "><strong>By </strong> <p style="display:inline" id='detailAuthor'>ASDASD</p></div>  
            </div>
          </div>
          <div class="modal-footer">
              <input type="hidden" name="id" value="" id='detailId'>
              {{csrf_field()}}
              <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-sm btn-primary pull-right">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id='createPromotions'>
    <div class="modal-dialog" role="document">
      <form action="/administrator/promotions/create" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <strong>Create Promotion</strong><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                  <input type="text" class="form-control" placeholder="Title" id='createTitle' name="title">
                </div>
              </div>
              <div class="form-group">
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
              <button type="submit" class="btn btn-sm btn-primary pull-right">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @endsection
  @section('js')
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript">
      $("#filesTrigger").click(function() {
          $("#files").click();
      });
      document.getElementById("files").onchange = function () {
          var reader = new FileReader();

          reader.onload = function (e) {
              // get loaded data and render thumbnail.
               $("#detailImage").fadeOut(1000, function() {
                    document.getElementById("detailImage").src = e.target.result;
                }).fadeIn(1000);
              
          };

          // read the image file as a data URL.
          reader.readAsDataURL(this.files[0]);
      };

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

      $('.detail').click(function(){
        var title = $(this).data('title');
        var image = $(this).data('image');
        var content = $(this).data('content');
        var created_at = $(this).data('created_at');
        var author = $(this).data('author');
        var id = $(this).data('id');

        $('#detailTitle').val(title);
        $('#detailContent').val(content);
        $('#detailAuthor').html(author);
        $('#detailCreatedAt').html(created_at);
        $('#detailId').val(id);

        $('#detailImage').attr('src', '/images/promotions/'+ image);
        $('#detailPomotions').modal();

      });
      $('.delete').click(function() {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var _token = '{{csrf_token()}}';

        bootbox.confirm("<b>Delete Promotions</b> with this title : <strong>"+title+" </strong> ?", function(result) {
          if (result) {
            toastr.options.timeOut = 0;
            toastr.options.extendedTimeOut = 0;
            toastr.info('<i class="fa fa-spinner fa-spin"></i><br>Process...');
            toastr.options.timeOut = 5000;
            toastr.options.extendedTimeOut = 1000;
            $.post("/administrator/promotions/delete", {id: id, _token:_token})
            .done(function(result) {
              toastr.success('Success');
              toastr.options.timeOut = 5000;
              window.location.replace("/administrator/promotions/");
            })
            .fail(function(result) {
              toastr.clear();
              toastr.error('Server Error! Please reload this page again.');
            });
          };
        }); 
      });
    </script>

  @stop