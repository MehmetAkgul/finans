@extends('admin.body.master')
@section('page-level-css')

@endsection()

@section('master')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="float-left">
                                    <h4>Banka Düzenle</h4>
                                </div>

                                <div class="float-right">
                                    <label for="">{{$data->ad}} </label>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <form action="{{route('banka.update',[$data->id])}}" method="POST" enctype='multipart/form-data'>
                                    @csrf

                                    <div class="col-md-12 row ">
                                        <div class="form-group col-md-4">
                                            <label for="name">Banka Adı</label>
                                            <input type="text" name="name" class="form-control" id="name" required value="{{$data->name}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">İban</label>
                                            <input type="text" name="iban" class="form-control" id="iban" value="{{$data->iban}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Hesap No</label>
                                            <input type="text" name="hesapNo" class="form-control" id="hesapNo" value="{{$data->hesapNo}}">
                                        </div>

                                    </div>


                                    <div class="form-group float-right">
                                        <button class="btn btn-success" type="submit"> Banka Güncelle</button>
                                    </div>
                                </form>


                            </div>


                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Button trigger modal -->




@endsection()

@section('page-level-script')



    <script>

    </script>
@endsection()
