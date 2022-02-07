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
                                    <h4>Kalem Düzenle</h4>
                                </div>

                                <div class="float-right">
                                    <label for="">{{$data->ad}} </label>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <form action="{{route('kalem.update',[$data->id])}}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <div class="row form-group">
                                        <label for="" class="col-form-label">Müşteri Tipi</label>
                                        <div class="col-md-12">
                                            <div>
                                                <input type="radio" class="  change-customer-type" name="kalemTipi" id="gelir" {{$data->kalemTipi==0?"checked":""}} value="0">
                                                <label for="gelir" class="col-form-label">Gelir</label>
                                            </div>
                                            <div>
                                                <input type="radio" class=" change-customer-type" name="kalemTipi" id="gider" {{$data->kalemTipi==1?"checked":""}}  value="1">
                                                <label for="gider" class="col-form-label">Gider</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row kalem-area"  >
                                        <div class="form-group col-md-6">
                                            <label for="name">Kalem Adı</label>
                                            <input type="text" name="ad" class="form-control" id="ad" required value="{{$data->ad}}"
                                                   placeholder=" Firma Adı Giriniz.">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Kdv</label>
                                            <input type="text" name="kdv" class="form-control" id="kdv" required  value="{{$data->kdv}}"
                                                   placeholder="Vergi Numarası Giriniz.">
                                        </div>

                                    </div>


                                    <div class="form-group float-right">
                                        <button class="btn btn-success" type="submit"> Güncelle</button>
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
