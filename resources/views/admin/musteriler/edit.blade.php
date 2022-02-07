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
                                    <h4>Müşteri Düzenle</h4>
                                </div>

                                <div class="float-right">
                                    <label for="">{{\App\Models\Musteriler::getPublicName($data->id)}} </label>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <form action="{{route('musteriler.update',[$data->id])}}" method="POST" enctype='multipart/form-data'>
                                    @csrf

                                    @if($data->photo!="")
                                        <div class="form-group row">
                                            <div class="dol-md-12">
                                                <img src="{{asset($data->photo)}}" class="img-thumbnail" style="width: 250px;" alt="">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name"> Resmi </label>
                                        <input type="file" name="photo" class="form-control" id="photo">
                                    </div>


                                    <div class="row form-group">
                                        <label for="" class="col-form-label">Müşteri Tipi</label>
                                        <div class="col-md-12">
                                            <div>
                                                <input type="radio" class="  change-customer-type" name="musteriTipi" id="bireysel"
                                                       {{$data->musteriTipi==0?"checked":""}} value="0">
                                                <label for="bireysel" class="col-form-label">Bireysel</label>
                                            </div>
                                            <div>
                                                <input type="radio" class=" change-customer-type" name="musteriTipi"
                                                       {{$data->musteriTipi==1?"checked":""}} id="kurumsal" value="1">
                                                <label for="kurumsal" class="col-form-label">Kurumsal</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row firma-area" @if($data->musteriTipi==0) style="display: none;" @endif>
                                        <div class="form-group col-md-4">
                                            <label for="name">Firma Adı</label>
                                            <input type="text" name="firmaAdi" class="form-control" id="firmaAdi" value="{{$data->firmaAdi}}" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Vergi Numarası</label>
                                            <input type="text" name="vergiNumarasi" class="form-control" id="vergiNumarasi" value="{{$data->vergiNumarasi}}" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Vergi Dairesi</label>
                                            <input type="text" name="vergiDairesi" class="form-control" id="vargiDairesi" value="{{$data->vargiDairesi}}" >
                                        </div>
                                    </div>

                                    <div class="col-md-12 row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Adı</label>
                                            <input type="text" name="ad" class="form-control" id="ad"  value="{{$data->ad}}" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Soyad</label>
                                            <input type="text" name="soyad" class="form-control" id="soyad" value="{{$data->soyad}}" >
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Doğum Tarihi</label>
                                            <input type="date" name="dogumTarih" class="form-control" value="{{$data->dogumTarih}}"id="dogumTarih"  >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Tc</label>
                                            <input type="text" name="tc" class="form-control" id="tc" value="{{$data->tc}}" >
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Adres</label>
                                            <textarea class="form-control" id="adres" name="adres"  rows="3">{{$data->adres}}</textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Telefon</label>
                                            <input type="text" name="telefon" class="form-control" value="{{$data->telefon}}"id="telefon" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">E-mail</label>
                                            <input type="text" name="email" class="form-control" id="email" value="{{$data->email}}" >
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
        $(".change-customer-type").click(function () {
            let value = $(this).val();
            if (value == 1) {
                $(".firma-area").show();
            } else {
                $(".firma-area").hide();
            }
        });
    </script>

    <script>

    </script>
@endsection()
