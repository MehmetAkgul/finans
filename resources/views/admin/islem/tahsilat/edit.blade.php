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
                                <h4> Tahsilat Güncelle</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <form action="{{route('islem.update',['id'=>$data->id])}}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="type" value="{{ISLEM_TAHSILAT}}" >

                                    <div class="col-md-12 row  ">
                                        <div class="form-group col-md-4">
                                            <label for="name">Fatura Seçiniz</label>

                                            <select class="form-control select2 fatura" name="faturaId">
                                                @foreach(\App\Models\Fatura::getList(FATURA_GIDER) as $k=>$v)
                                                    <option value="{{$v->id}}" data-musteriId="{{$v->musteriId}}">{{$v->faturaNo}}
                                                        /{{\App\Models\Musteriler::getPublicName($v->musteriId)}}
                                                        /{{\App\Models\Fatura::getTotal($v->id)}} TL
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group col-md-4">
                                            <label for="name">Müşteri Seçiniz</label>
                                            <select class="form-control select2 musteri" name="musteriId">
                                                @foreach($musteriler as $k=>$v)
                                                    <option value="{{$v->id}}">{{\App\Models\Musteriler::getPublicName($v->id)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">İşlem Tarihi</label>
                                            <input type="date" name="tarih" class="form-control" value="{{$data->tarih}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 row  ">
                                        <div class="form-group col-md-4">
                                            <label for="name">Hesap</label>
                                            <select class="form-control select2" name="hesap">
                                                <option value="0" @if(0==$data->hesap) selected @endif>Nakit</option>
                                                @foreach($banka as $k=>$v)
                                                    <option value="{{$v->id}}" @if($v->id==$data->hesap) selected @endif> {{$v->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="name">Tahsilat Şekli</label>
                                            <select class="form-control select2" name="odemeSekli">
                                                <option value="0" @if( $data->odemeSekli==0) selected @endif>Nakit</option>
                                                <option value="1" @if( $data->odemeSekli==1) selected @endif>Banka</option>

                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="name">Fiyat</label>
                                            <input type="text" name="fiyat" class="form-control" value="{{$data->fiyat}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name">Açıklama</label>
                                        <textarea name="description" rows="4" class="form-control">{{$data->description}}</textarea>
                                    </div>

                                    <div class="form-group float-right">
                                        <button class="btn btn-success" type="submit"> Tahsilatı Güncelle</button>
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
        $(document).ready(function () {
            $('.fatura').change(function () {
                let musteriId = $(this).find(":selected").attr('data-musteriId');
                $(".musteri").val(musteriId).trigger('change');
            })
        })
    </script>


@endsection()
