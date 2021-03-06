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
                                <h4>Fatura Düzenle</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <form action="{{route('fatura.update',['id'=>$data->id])}}" method="POST" enctype='multipart/form-data'>
                                    @csrf

                                    <div class="col-md-12 row fatura-area">
                                        <div class="form-group col-md-4">
                                            <label for="name">Fatura No</label>
                                            <input type="text" name="faturaNo" class="form-control" required value="{{$data->faturaNo}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Müşteri Seçiniz</label>

                                            <select class="form-control select2" name="musteriId">
                                                @foreach($musteriler as $k=>$v)
                                                    <option value="{{$v->id}}"
                                                            @if ($data->musteriId==$v->id)selected @endif >{{\App\Models\Musteriler::getPublicName($v->id)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Fatura Tarihi</label>
                                            <input type="date" name="faturaTarihi" class="form-control" value="{{$data->faturaTarihi}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="faturaData" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Kalem</th>
                                                    <th>Adet/Gün</th>
                                                    <th>Tutar</th>
                                                    <th>Toplam Tutar</th>
                                                    <th>Kdv</th>
                                                    <th>Kdv Toplam</th>
                                                    <th>Genel Toplam</th>
                                                    <th>Açıklama</th>
                                                    <th>Kaldır</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($dataIslem as $k=>$v )
                                                    <tr class="islem_field">
                                                        <td>
                                                            <select name="islem[{{$k}}][kalemId]" class="form-control kalem">
                                                                <option value="0"> Kalem Seçiniz</option>
                                                                @foreach($kalem as $key=>$val )
                                                                    <option @if ($v->kalemId==$val->id) selected @endif data-kdv="{{$val->kdv}}"
                                                                            value="{{$val->id}}">{{$val->ad}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input type="text" class="form-control" name=" islem[{{$k}}][gun_adet]" id="gun_adet"
                                                                   value="{{$v->gun_adet}}"></td>
                                                        <td><input type="text" class="form-control" name=" islem[{{$k}}][tutar]" id="tutar"
                                                                   value="{{$v->tutar}}"></td>
                                                        <td><input type="text" class="form-control" name=" islem[{{$k}}][toplam_tutar]"
                                                                   id="toplam_tutar" value="{{$v->toplam_tutar}}"></td>
                                                        <td><input type="text" class="form-control" name=" islem[{{$k}}][kdv]" id="kdv"
                                                                   value="{{$v->kdv}}"></td>
                                                        <td><input type="text" class="form-control" name=" islem[{{$k}}][kdv_tutar]" id="kdv_tutar"
                                                                   value="{{$v->kdv_tutar}}"></td>
                                                        <td><input type="text" class="form-control" name=" islem[{{$k}}][genel_toplam_tutar]"
                                                                   id="genel_toplam_tutar" value="{{$v->genel_toplam_tutar}}"></td>
                                                        <td><input type="text" class="form-control" name=" islem[{{$k}}][description]"
                                                                   id="description" value="{{$v->description}}"></td>
                                                        <td>
                                                            <button type="button" id="removeButton" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block" id="addRowBtn">EKLE</button>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="faturaData1" class="table ">

                                                <tr>
                                                    <td class=" ">Ara Toplam</td>
                                                    <td class=" float-right  ara_toplam">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td class=" ">Kdv Toplam</td>
                                                    <td class=" float-right  kdv_toplam">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td class=" ">Genel Toplam</td>
                                                    <td class="float-right   genel_toplam">0.00</td>
                                                </tr>

                                            </table>
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
        $(document).ready(function () {
            calc();
        });

        let i = $('.islem_field').length;
        $('#addRowBtn').click(function () {
            console.log(i);
            let newRow =
                '<tr class="islem_field">' +
                '<td> <select   name="islem['+i+'][kalemId]" class="form-control kalem"> ' +
                '<option value="0"> Kalem Seçiniz </option>';
            @foreach($kalem as $k=>$v )
                newRow += '<option data-kdv="{{$v->kdv}}" value="{{$v->id}}">{{$v->ad}}</option>';
            @endforeach
                newRow += '</select></td>' +
                '<td> <input type="text"  class="form-control" name=" islem['+i+'][gun_adet]" id="gun_adet"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem['+i+'][tutar]" id="tutar"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem['+i+'][toplam_tutar]" id="toplam_tutar"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem['+i+'][kdv]" id="kdv"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem['+i+'][kdv_tutar]" id="kdv_tutar"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem['+i+'][genel_toplam_tutar]" id="genel_toplam_tutar"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem['+i+'][description]" id="description"> </td>' +
                '<td> <button type="button" id="removeButton" class="btn btn-danger" > <i class="fa fa-trash"></i> </button> </td>' +
                '</tr>'

            $('#faturaData').append(newRow);
            i++;
        })

        $("body").on("change", ".kalem", function () {

            let kdv = $(this).find(":selected").data("kdv");

            $(this).closest(".islem_field").find("#kdv").val(kdv);
        })

        $("body").on("change", "#faturaData input", function () {




            if ($(this).is("#tutar", "#gun_adet", "#toplam_tutar", "#genel_toplam_tutar", "#kdv")) {
                let adet = $(this).closest("tr").find("#gun_adet").val();
                let tutar = $(this).closest("tr").find("#tutar").val();
                let kdv = $(this).closest("tr").find("#kdv").val();
                let toplam_tutar;
                let genel_toplam_tutar;
                let kdv_tutar;

                if (adet === "" && tutar === "") {
                    toplam_tutar = $(this).closest("tr").find("#toplam_tutar").val();
                    if (toplam_tutar === "") {
                        genel_toplam_tutar = parseFloat($(this).closest("tr").find("#genel_toplam_tutar").val());
                        kdv_tutar = genel_toplam_tutar / (1 + kdv / 100);
                        toplam_tutar = genel_toplam_tutar - kdv_tutar;
                    } else {
                        toplam_tutar = parseFloat($(this).closest("tr").find("#toplam_tutar").val());
                        kdv_tutar = toplam_tutar * kdv / 100;
                        genel_toplam_tutar = toplam_tutar + kdv_tutar;
                    }
                } else {
                    toplam_tutar = adet * tutar;
                    kdv_tutar = toplam_tutar * kdv / 100;
                    genel_toplam_tutar = toplam_tutar + kdv_tutar;
                }

                toplam_tutar = toplam_tutar.toFixed(2);
                kdv_tutar = kdv_tutar.toFixed(2);
                genel_toplam_tutar = genel_toplam_tutar.toFixed(2);
                $(this).closest("tr").find("#toplam_tutar").val(toplam_tutar)
                $(this).closest("tr").find("#kdv_tutar").val(kdv_tutar)
                $(this).closest("tr").find("#genel_toplam_tutar").val(genel_toplam_tutar)
            }
            calc();
        })

        $("body").on("click", "#removeButton", function () {
            $(this).closest(".islem_field").remove();
            calc()
        })

        function calc() {
            let kdv_toplam = 0;
            let ara_toplam = 0;
            let genel_toplam = 0;

            $("[id=kdv_tutar]").each(function () {
                kdv_toplam = parseFloat(kdv_toplam) + parseFloat($(this).val());
            })

            $("[id=toplam_tutar]").each(function () {
                ara_toplam = parseFloat(ara_toplam) + parseFloat($(this).val());
            })

            $("[id=genel_toplam_tutar]").each(function () {
                genel_toplam = parseFloat(genel_toplam) + parseFloat($(this).val());
            })

            $('.ara_toplam').html(ara_toplam);
            $('.kdv_toplam').html(kdv_toplam);
            $('.genel_toplam').html(genel_toplam);
        }

    </script>
@endsection()
