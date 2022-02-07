<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Musteriler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class MusteriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = Musteriler::paginate(10);
        return view('admin.musteriler.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.musteriler.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $all = $request->except('_token');
        $all['photo'] = FileUpload::newUpload('musteriler', $request->file('photo'), 0);

        $create = Musteriler::create($all);
        if ($create) {
            $notification = array('staus', 'Müsteri Eklendi');
        } else {
            $notification = array('staus', 'Bir hata oluştu');
        }

        return redirect()->back()->with($notification)->header('Content-Type', 'text/html');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $c = Musteriler::where('id', $id)->count();
        if ($c != 0) {
            $data = Musteriler::where('id', $id)->first();
            return  view('admin.musteriler.edit', compact('data'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $c = Musteriler::where('id', $id)->count();
        if ($c != 0) {
            $data = Musteriler::where('id', $id)->first();

            $all = $request->except('_token');
            $all['photo'] = FileUpload::changeUpload('musteriler', $request->file('photo'), 0, $data, "photo");

            $update = Musteriler::where('id', $id)->update($all);
            if ($update) {
                $notification = array('staus', 'Müsteri Düzenlendi');
            } else {
                $notification = array('staus', 'Bir hata oluştu');
            }

            return redirect()->back()->with($notification)->header('Content-Type', 'text/html');


        } else {
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $c = Musteriler::where('id', $id)->count();

        if ($c != 0) {
            $data = Musteriler::where('id', $id)->first();
            if ($data->photo != "")
                File::delete(public_path() . '/' . $data->photo);

            $delete = Musteriler::where('id', $id)->delete();
            if ($delete) {
                $notification = array('staus', 'Müsteri Düzenlendi');
            } else {
                $notification = array('staus', 'Bir hata oluştu');
            }

            return redirect()->back()->with($notification)->header('Content-Type', 'text/html');


        } else {
            return redirect('/');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function data(Request $request)
    {
        $table = Musteriler::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('musteriler.edit', ['id' => $table->id]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('musteriler.delete', ['id' => $table->id]) . '">Sil</a>';
            })
            ->editColumn('musteriTipi', function ($table) {
                if ($table->musteriTipi == 0) {
                    return "Bireysel";
                } else {
                    return "Kurumsal";
                }
            })
            ->addColumn('publicName', function ($table) {
                return Musteriler::getPublicName($table->id);
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }


}