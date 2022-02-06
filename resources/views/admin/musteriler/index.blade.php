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
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Marka</th>
                                        <th>Durum</th>
                                        <th>Sıra</th>
                                        <th>Öne Çıkarılsın mı?</th>
                                        <th>İşlem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=0)
                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$data->firstItem()+$i++}}</td>
                                            <td><img src="{{asset($value->logo)}}" class="thumb" style=" height: 30px" alt=""></td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->status}}</td>
                                            <td>{{$value->order}}</td>
                                            <td>{{$value->is_featured?"Evet":"Hayır"}}</td>
                                            <td>
                                                <div class="row">
                                                    <form method="POST" action="{{route('musteriler.destroy',$value->id)}}">
                                                        @method('DELETE')
                                                        @csrf

                                                        <button type="submit" class="btn btn-danger btn-sm deleteDialog mr-1"><i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{route('musteriler.edit',$value->id)}}">
                                                        @method('GET')
                                                        @csrf

                                                        <button type="submit" class="btn btn-info btn-sm "><i class="fa fa-edit"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                Toplam: <b>{{$data->total()}}</b> adet kayıt bulundu.
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {!! $data->links() !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Button trigger modal -->


    <form action="{{route('musteriler.store')}}"  method="POST" enctype='multipart/form-data' >
        @csrf
        <div class="form-group">
            <label for="name"> Marka Adı</label>
            <input type="text" name="name" class="form-control" id="name"  placeholder="Lütfen Ürün Adını Giriniz.">
        </div>
        <div class="form-group">
            <label for="name"> Logo</label>
            <input type="file" name="logo" class="form-control" id="logo" placeholder="Lütfen Ürün Logosu Yükleyiniz.">
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


@endsection()

@section('page-level-script')

   <script>

    </script>

    <script>

    </script>
@endsection()
