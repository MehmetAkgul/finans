<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Banka;
use App\Models\Fatura;
use App\Models\Islem;
use App\Models\Musteriler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class IslemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        return view('admin.islem.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($type)
    {
        $musteriler = Musteriler::all();
        $banka = Banka::all();
        if ($type == 0) {
            return view('admin.islem.odeme.create', compact('musteriler', 'banka'));
        } else {
            return view('admin.islem.tahsilat.create', compact('musteriler', 'banka'));
        }
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
    //    dd($all);
        $create = Islem::create($all);
        if ($create) {
            $notification = array('staus', 'Fatura Eklendi');
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
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public
    function edit($id)
    {
        $c = Islem::where('id', $id)->count();
        if ($c != 0) {
            $data = Islem::where('id', $id)->first();
            $musteriler = Musteriler::all();
            $banka = Banka::all();
            if ($data->islemTipi == 0) {
                return view('admin.islem.odeme.edit', compact('data', 'musteriler', 'banka'));
            } else {
                return view('admin.islem.tahsilat.edit', compact('data', 'musteriler', 'banka'));
            }
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
    public
    function update(Request $request, $id)
    {


        $c = Islem::where('id', $id)->count();
        if ($c != 0) {

            $all = $request->except('_token');

            $update = Islem::where('id', $id)->update($all);

            if ($update) {
                $notification = array('staus', 'İslem Düzenlendi');
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
    public
    function delete($id)
    {
        $c = Islem::where('id', $id)->count();

        if ($c != 0) {

            $delete = Islem::where('id', $id)->delete();
            if ($delete) {
                $notification = array('staus', 'Gelir $ Gider Faturai Düzenlendi');
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
    public
    function data(Request $request)
    {
        $table = Islem::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('islem.edit', ['id' => $table->id]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('islem.delete', ['id' => $table->id]) . '">Sil</a>';
            })
            ->addColumn('musteri', function ($table) {
                return Musteriler::getPublicName($table->musteriId);
            })
            ->addColumn('faturaNo', function ($table) {
                return Fatura::getNo($table->faturaId);
            })
            ->editColumn('type', function ($table) {
                if ($table->type == 0) {
                    return "Ödeme";
                } else {
                    return "Tahsilat";
                }
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }


}
