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
                                <h4>Bankalar</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">

                                <form action="{{route('banka.store')}}" method="POST" enctype='multipart/form-data'>
                                    @csrf


                                    <div class="col-md-12 row ">
                                        <div class="form-group col-md-4">
                                            <label for="name">Banka Adı</label>
                                            <input type="text" name="name" class="form-control" id="name" required
                                                   placeholder=" Firma Adı Giriniz.">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">İban</label>
                                            <input type="text" name="iban" class="form-control" id="iban" placeholder="İBAN Giriniz.">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Hesap No</label>
                                            <input type="text" name="hesapNo" class="form-control" id="hesapNo" placeholder="Hesap Numarası Giriniz.">
                                        </div>

                                    </div>


                                    <div class="form-group float-right">
                                        <button class="btn btn-success" type="submit"> Banka Kaydet</button>
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
