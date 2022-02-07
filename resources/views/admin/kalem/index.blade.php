@extends('admin.body.master')
@section('page-level-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
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
                                <h4>Kalem Listesi</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body ">
                                <div class="float-left">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                               placeholder="Ara">
                                        <div class="input-group-append">
                                            <button class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="float-right mb-1">
                                    <a href="" class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#newAddModal"> <i
                                                class="fa fa-plus"></i> Ekle</a>
                                    <a href="" class="btn btn-info btn-sm" type="button"> <i class="fa fa-file-excel"></i> Excel</a>
                                    <a href="" class="btn btn-default  btn-sm" type="button"> <i class="fa fa-file-pdf"></i> Pdf</a>
                                </div>
                                <table class="table table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>Ad</th>
                                        <th>Kalem Tipi</th>
                                        <th>Düzenle</th>
                                        <th>Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {

            let table = $('#example').DataTable({
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
                    url: '{{route('kalem.data')}}',

                },
                columns: [
                    {data: 'ad', name: 'ad'},
                    {data: 'kalemTipi', name: 'kalemTipi'},
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
