<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Kalem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class KalemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = Kalem::paginate(10);
        return view('admin.kalem.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.kalem.create');
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

        $create = Kalem::create($all);
        if ($create) {
            $notification = array('staus', 'Gelir $ Gider Kalemi Eklendi');
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
        $c = Kalem::where('id', $id)->count();
        if ($c != 0) {
            $data = Kalem::where('id', $id)->first();
            return  view('admin.kalem.edit', compact('data'));
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
        $c = Kalem::where('id', $id)->count();
        if ($c != 0) {

            $all = $request->except('_token');

            $update = Kalem::where('id', $id)->update($all);
            if ($update) {
                $notification = array('staus', 'Gelir $ Gider Kalemi Düzenlendi');
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
        $c = Kalem::where('id', $id)->count();

        if ($c != 0) {

            $delete = Kalem::where('id', $id)->delete();
            if ($delete) {
                $notification = array('staus', 'Gelir $ Gider Kalemi Düzenlendi');
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
        $table = Kalem::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('kalem.edit', ['id' => $table->id]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('kalem.delete', ['id' => $table->id]) . '">Sil</a>';
            })
            ->editColumn('kalemTipi', function ($table) {
                if ($table->kalemTipi == 0) {
                    return "Gelir";
                } else {
                    return "Gider";
                }
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }


}
