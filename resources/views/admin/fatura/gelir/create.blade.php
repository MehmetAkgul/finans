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
                                <h4>Fatura</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <form action="{{route('fatura.store',['type'=>0])}}" method="POST" enctype='multipart/form-data'>
                                    @csrf

                                    <div class="col-md-12 row fatura-area">
                                        <div class="form-group col-md-4">
                                            <label for="name">Fatura No</label>
                                            <input type="text" name="faturaNo" class="form-control" required placeholder=" Fatura No Giriniz.">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Müşteri Seçiniz</label>

                                            <select class="form-control select2">
                                                @foreach($musteriler as $k=>$v)
                                                    <option value="{{$v->id}}">{{\App\Models\Musteriler::getPublicName($v->id)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Fatura Tarihi</label>
                                            <input type="date" name="faturaTarihi" class="form-control" value="{{date("Y-m-d")}}">
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
                                            </table>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block" id="addRowBtn">EKLE</button>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="faturaData" class="table ">

                                                <tr>
                                                    <td class=" ">Ara Toplam</td>
                                                    <td class="  ara_toplam">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td class=" ">Kdv Toplam</td>
                                                    <td class="  kdv_toplam">0.00</td>
                                                </tr>
                                                <tr>
                                                    <td class=" ">Genel Toplam</td>
                                                    <td class="  genel_toplam">0.00</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <button class="btn btn-success" type="submit"> Kaydet</button>
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


        let i = $('.islem_field').length;
        $('#addRowBtn').click(function () {
            let newRow =
                '<tr class="islem_field">' +
                '<td> <select   name="islem[' + i + '][kalemId]" class="form-control kalem"> ' +
                '<option value="0"> Kalem Seçiniz </option>';
            @foreach($kalem as $k=>$v )
                newRow += '<option data-kdv="{{$v->kdv}}" value="{{$v->id}}">{{$v->ad}}</option>';
            @endforeach
                newRow += '</select></td>' +
                '<td> <input type="text"  class="form-control" name=" islem[' + i + '][gun_adet]" id="gun_adet"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem[' + i + '][tutar]" id="tutar"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem[' + i + '][toplam_tutar]" id="toplam_tutar"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem[' + i + '][kdv]" id="kdv"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem[' + i + '][kdv_tutar]" id="kdv_tutar"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem[' + i + '][genel_tutar]" id="genel_tutar"> </td>' +
                '<td> <input type="text"  class="form-control" name=" islem[' + i + '][description]" id="description"> </td>' +
                '<td> <button type="button" id="removeButton" class="btn btn-danger" > <i class="fa fa-trash"></i> </button> </td>' +
                '</tr>'

            $('#faturaData').append(newRow);
            i++;
        })

        $("body").on("change", ".kalem", function () {

            let kdv = $(this).find(":selected").data("kdv");
            console.log(kdv)
            $(this).closest(".islem_field").find("#kdv").val(kdv);
        })

        $("body").on("change", "#faturaData input", function () {

            console.log("deneme");


            if ($(this).is("#tutar", "#gun_adet", "#toplam_tutar", "#genel_tutar", "#kdv")) {
                let adet = $(this).closest("tr").find("#gun_adet").val();
                let tutar = $(this).closest("tr").find("#tutar").val();
                let kdv = $(this).closest("tr").find("#kdv").val();
                let toplam_tutar;
                let genel_tutar;
                let kdv_tutar;

                if (adet === "" && tutar === "") {
                    toplam_tutar = $(this).closest("tr").find("#toplam_tutar").val();
                    if (toplam_tutar === "") {
                        genel_tutar = parseFloat($(this).closest("tr").find("#genel_tutar").val());
                        kdv_tutar = genel_tutar / (1 + kdv / 100);
                        toplam_tutar = genel_tutar - kdv_tutar;
                    } else {
                        toplam_tutar = parseFloat($(this).closest("tr").find("#toplam_tutar").val());
                        kdv_tutar = toplam_tutar * kdv / 100;
                        genel_tutar = toplam_tutar + kdv_tutar;
                    }
                } else {
                    toplam_tutar = adet * tutar;
                    kdv_tutar = toplam_tutar * kdv / 100;
                    genel_tutar = toplam_tutar + kdv_tutar;
                }

                toplam_tutar = toplam_tutar.toFixed(2);
                kdv_tutar = kdv_tutar.toFixed(2);
                genel_tutar = genel_tutar.toFixed(2);
                $(this).closest("tr").find("#toplam_tutar").val(toplam_tutar)
                $(this).closest("tr").find("#kdv_tutar").val(kdv_tutar)
                $(this).closest("tr").find("#genel_tutar").val(genel_tutar)
            }
            calc();
        })

        $("body").on("click", "#removeButton", function () {
            $(this).closest(".islem_field").remove();
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

            $("[id=genel_tutar]").each(function () {
                genel_toplam = parseFloat(genel_toplam) + parseFloat($(this).val());
            })

            $('.ara_toplam').html(ara_toplam);
            $('.kdv_toplam').html(kdv_toplam);
            $('.genel_toplam').html(genel_toplam);
        }

    </script>
@endsection()
