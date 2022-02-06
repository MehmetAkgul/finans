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
                                <h4>Markalar</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <form action="{{route('musteriler.store')}}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <div class="form-group">
                                        <label for="name"> Resmi </label>
                                        <input type="file" name="photo" class="form-control" id="photo">
                                    </div>


                                    <div class="row form-group">
                                        <label for="" class="col-form-label">Müşteri Tipi</label>
                                        <div class="col-md-12">
                                            <div>
                                                <input type="radio" class="  change-customer-type" name="musteriTipi" id="bireysel" checked value="0">
                                                <label for="bireysel" class="col-form-label">Bireysel</label>
                                            </div>
                                            <div>
                                                <input type="radio" class=" change-customer-type" name="musteriTipi" id="kurumsal" value="1">
                                                <label for="kurumsal" class="col-form-label">Kurumsal</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row firma-area" style="display: none;">
                                        <div class="form-group col-md-4">
                                            <label for="name">Firma Adı</label>
                                            <input type="text" name="firmaAdi" class="form-control" id="firmaAdi"
                                                   placeholder=" Firma Adı Giriniz.">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Vergi Numarası</label>
                                            <input type="text" name="vergiNumarasi" class="form-control" id="vergiNumarasi"
                                                   placeholder="Vergi Numarası Giriniz.">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Vergi Dairesi</label>
                                            <input type="text" name="vargiDairesi" class="form-control" id="vargiDairesi"
                                                   placeholder="Vergi Dairesi Giriniz.">
                                        </div>
                                    </div>

                                    <div class="col-md-12 row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Adı</label>
                                            <input type="text" name="ad" class="form-control" id="ad" placeholder="Müşteri Adını Giriniz.">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Soyad</label>
                                            <input type="text" name="soyad" class="form-control" id="soyad" placeholder="Müşteri Soyadını Giriniz.">
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Doğum Tarihi</label>
                                            <input type="date" name="dogumTarih" class="form-control" id="dogumTarih"
                                                   placeholder="Müşteri Doğum Tarihi Giriniz.">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Tc</label>
                                            <input type="text" name="tc" class="form-control" id="tc" placeholder="Müşteri TC Giriniz.">
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Adres</label>
                                            <textarea class="form-control" id="adres" name="adres" rows="3"> </textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Telefon</label>
                                            <input type="text" name="telefon" class="form-control" id="telefon"
                                                   placeholder="Müşteri Telefon Giriniz.">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">E-mail</label>
                                            <input type="text" name="email" class="form-control" id="email" placeholder="Müşteri Mail Giriniz.">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Marka Açıklaması</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                                  placeholder="Lütfen Ürün Hakkında Bilgi Giriniz."> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Web sitesi</label>
                                        <input type="text" name="website" class="form-control" id="website">
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Durum</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="published">Yayınlandı</option>
                                            <option value="draft">Taslak</option>
                                            <option value="pending">Bekliyor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="order">order</label>
                                        <input type="number" name="order" class="form-control" id="order" value="0" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_featured">Öne Çıkarılsın mı ?</label>
                                        <select name="is_featured" id="is_featured" class="form-control">
                                            <option value="1">Evet</option>
                                            <option value="0">Hayır</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
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
