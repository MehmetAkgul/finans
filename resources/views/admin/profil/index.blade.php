@extends('admin.body.master')
@section('page-level-css')
@endsection()

@section('master')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Profil Ayarlarınız
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{route('profil.store')}}" enctype="multipart/form-data" method="post">
                                    @csrf


                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Fotoğraf</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="photo" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Ad Soyad</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="name" value="{{\Auth::user()->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" value="{{\Auth::user()->email}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Şifre</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password" autocomplete="off">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Güncelle</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Button trigger modal -->



@endsection()

@section('page-level-script')

@endsection()
