@extends('admin.body.master')
@section('page-level-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection()

@section('master')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset(\App\Models\Musteriler::getPhoto($data->id))}}"
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{\App\Models\Musteriler::getPublicName($data->id)}}</h3>

                                <p class="text-muted text-center">{{$data->musteriTipi==0?"Bireysel":"Kurumsal"}}</p>
                                <p class="text-muted text-center">{{$data->telefon}}</p>


                                <a href="{{route('musteriler.edit',$data->id)}}" class="btn btn-primary btn-block"><b>Düzenle</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                Extre Listesi
                            </div><!-- /.card-header -->
                            <div class="card-body">

                                <table class="table table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>İşlem</th>
                                        <th>Fiyat</th>
                                        <th>Tarih</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($viewTablo as $k=>$v)
                                        <tr>
                                            <td>
                                                @if($v['uType']=="fatura")
                                                    @if($v['type']==FATURA_GELIR)
                                                        Gelir Faturası
                                                    @else
                                                        Gider Faturası
                                                    @endif
                                                @else
                                                    @if($v['type']==ISLEM_ODEME)
                                                        Ödeme
                                                    @else
                                                        Tahsilat
                                                    @endif
                                                @endif
                                            </td>
                                            <td> {{$v['fiyat']}}</td>
                                            <td> {{$v['tarih']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {

            let table = $('#example1').DataTable({
                lengthMenu: [[25, 100, -1], [25, 100, "All"]],
                /*
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                */
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'POST',
                    url: '{{route('musteriler.data')}}',

                },
                columns: [
                    {data: 'publicName', name: 'publicName'},
                    {data: 'musteriTipi', name: 'musteriTipi'},
                    {data: 'bakiye', name: 'bakiye'},
                    {data: 'extre', name: 'extre'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false}

                ]
            });
            jQuery.fn.DataTable.ext.type.search.string = function (data) {
                var testd = !data ?
                    '' :
                    typeof data === 'string' ?
                        data
                            .replace(/i/g, 'İ')
                            .replace(/ı/g, 'I') :
                        data;
                return testd;
            };
            $('#example_filter input').keyup(function () {
                table
                    .search(
                        jQuery.fn.DataTable.ext.type.search.string(this.value)
                    )
                    .draw();
            });


        });
    </script>
    <script>

    </script>
@endsection()
