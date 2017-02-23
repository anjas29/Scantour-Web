@extends('layouts.adminLayout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-cube"></i> Detail Usulan
      </h1>
      <ol class="breadcrumb">
        <li><a href="/administrator"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Usulan</li>
        <li class="active">Detail Usulan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <div class="box box-success">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <h4>Foto</h4>
                    <div class="row" style="padding: 20px;">
                      <div class="col-md-10 col-md-offset-1 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                        @if(is_null($data->foto))
                        <img src="/images/default_usulan.jpg" class="img-responsive">
                        @else
                        <img src="/images/usulan/{{$data->foto}}" class="img-responsive">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                  <h4>Keterangan</h4>
                    <table class="table table-striped">
                      <tr>
                        <th>Judul</th>
                        <td>{{$data->judul}}</td>
                      </tr>
                      <tr>
                        <th>Kategori</th>
                        <td>{{$data->kategori}}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        @if($data->status)
                        <td>Terverifikasi</td>
                        @else
                        <td>Belum terverifikasi</td>
                        @endif
                      </tr>
                      <tr>
                        <th>Jenis Usulan</th>
                        <td>{{$data->jenis}}</td>
                      </tr>
                      <tr>
                        <th>Jenis Inovasi</th>
                        <td>{{$data->inovasi}}</td>
                      </tr>
                    </table>

                    <h4>Pengusul</h4>
                    <table class="table table-striped">
                      <tr>
                        <th>Nama</th>
                        <td>{{$data->nama_lengkap}}</td>
                      </tr>
                      <tr>
                        <th>Identitas</th>
                        <td>{{$data->identitas}}</td>
                      </tr>
                      <tr>
                        <th>No Identitas</th>
                        <td>{{$data->no_identitas}}</td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <td>{{$data->jenis}}</td>
                      </tr>
                    </table>
                  </div>
                  <!-- col-8 -->
              </div>
              <!-- row -->
              <div class="row">
                <div class="col-md-12">
                  <h4>Kebaharuan</h4>
                  @if($data->kebaharuan->count() > 0)
                  <table class="table table-striped">
                    <?php $c=1; ?>
                    @foreach($data->kebaharuan as $d)
                    <tr>
                      <th>{{$c++}}</th>
                      <th>{{$d->kebaharuan}}</th>
                    </tr>
                    @endforeach
                  </table>
                  @else
                  <strong>Tidak ada kebaharuan</strong>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection