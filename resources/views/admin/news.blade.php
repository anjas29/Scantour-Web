@extends('layouts.adminLayout')
@section('header')
  <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.min.css">
  <style type="text/css">
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
        News
      </h1>
      <ol class="breadcrumb">
        <li><a href="/administrator/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/administrator/news">News</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="box box-warning">
            <div class="box-header">
              <i class="fa fa-feed"></i>
              <h3 class="box-title">News</h3>
              <button class="btn btn-sm btn-primary pull-right" data-toggle='modal' data-target="#createNews">Create</button>
            </div>
            <div class="box-body">
              <table class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $c=1; ?>
                  @foreach($data as $d)
                  <tr>
                      <td>{{ $c++ }}</td>
                      <td>{{ $d->title }}</td>
                      <td>{{ $d->content }}</td>
                      <td>{{ $d->date}}</td>
                      <td>
                        <a href="#" class="btn btn-xs btn-success detail" data-id='{{$d->id}}' data-title='{{$d->title}}' data-content='{{$d->content}}' data-author='{{$d->author->name}}' data-image="{{$d->image}}" data-created_at="{{$d->date}}"><i class="fa fa-eye"></i></a>
                        <a href="#" class="delete btn btn-xs btn-danger" data-id='{{$d->id}}' data-title='{{$d->title}}'><i class="fa fa-times"></i></a>
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

  <!-- detail News Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id='detailNews'>
    <div class="modal-dialog" role="document">
      <form action="/administrator/news/update" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <strong>News Detail</strong><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="col-md-5">
                <div class="img-view">
                  <img src="" id="detailImage" class="img-responsive">
                  <button id="filesTrigger" type='button' class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button>
                </div>
                
                <br>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-feed"></i></span>
                    <input type="text" class="form-control" placeholder="Title" id='detailTitle' name="title">
                  </div>
                </div>
                <div class="form-group" style="display: none;">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                    <input type="file" class="form-control" placeholder="Image" name="image" id="files">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                    <textarea class="form-control" name="content" id='detailContent' placeholder="Content"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div for='' class="col-sm-6"><i class="fa fa-calendar"></i>  <p style="display:inline" id='detailCreatedAt'>ASDASD</p></div>  
              <div for='' class="col-sm-6 "><i class="fa fa-user"></i> <p style="display:inline" id='detailAuthor'>ASDASD</p></div>  
            </div>
          </div>
          <div class="modal-footer">
              <input type="hidden" name="id" value="" id="detailId">
              {{csrf_field()}}
              <button type="button" class="btn btn-sm" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-sm btn-primary pull-right">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id='createNews'>
    <div class="modal-dialog" role="document">
      <form action="/administrator/news/create" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <strong>Create News</strong><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-feed"></i></span>
                  <input type="text" class="form-control" placeholder="Title" id='createTitle' name="title">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                  <textarea class="form-control" name="content" id='createContent' placeholder="Content"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-image"></i></span>
                  <input type="file" class="form-control" placeholder="Image" id='createImage' name="image">
                </div>
              </div>
              <div class="form-group">
                <img src="" id="createImageDetail" class="img-responsive" style="margin-left: auto; margin-right: auto;">
                <br>
              </div>
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
    <script>
      $(document).ready(function() {
        $('.dataTable').dataTable();
      });
    </script>
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

        $('#detailImage').attr('src', '/images/news/'+ image);
        $('#detailNews').modal();

      });
      $('.delete').click(function() {
        var id = $(this).data('id');
        var title = $(this).data('title');
        var _token = '{{csrf_token()}}';

        bootbox.confirm("<b>Delete News</b> with this title : <strong>"+title+" </strong> ?", function(result) {
          if (result) {
            toastr.options.timeOut = 0;
            toastr.options.extendedTimeOut = 0;
            toastr.info('<i class="fa fa-spinner fa-spin"></i><br>Process...');
            toastr.options.timeOut = 5000;
            toastr.options.extendedTimeOut = 1000;
            $.post("/administrator/news/delete", {id: id, _token:_token})
            .done(function(result) {
              window.location.replace("/administrator/news/");
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