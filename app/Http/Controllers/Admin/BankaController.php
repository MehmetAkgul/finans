<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use App\Models\Logger;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class BankaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = Banka::paginate(10);
        return view('admin.banka.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.banka.create');
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

        $create = Banka::create($all);
        if ($create) {
            Logger::Insert("Yeni Banka Bilgisi Eklendi", "Banka");
            $notification = array('status', 'Gelir $ Gider Bankai Eklendi');
        } else {
            $notification = array('status', 'Bir hata oluştu');
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
        $c = Banka::where('id', $id)->count();
        if ($c != 0) {
            $data = Banka::where('id', $id)->first();
            return  view('admin.banka.edit', compact('data'));
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
        $c = Banka::where('id', $id)->count();
        if ($c != 0) {

            $all = $request->except('_token');

            $update = Banka::where('id', $id)->update($all);
            if ($update) {
                Logger::Insert($all["name"]." Düzenlendi", "Banka");
                $notification = array('status', 'Gelir $ Gider Bankai Düzenlendi');
            } else {
                $notification = array('status', 'Bir hata oluştu');
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
        $c = Banka::where('id', $id)->count();

        if ($c != 0) {

            $banka = Banka::where('id', $id)->first();
            $delete = Banka::where('id', $id)->delete();
            if ($delete) {
                Logger::Insert($banka->name." Silindi", "Banka");
                $notification = array('status', 'Gelir $ Gider Bankai Düzenlendi');
            } else {
                $notification = array('status', 'Bir hata oluştu');
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
        $table = Banka::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('banka.edit', ['id' => $table->id]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('banka.delete', ['id' => $table->id]) . '">Sil</a>';
            })

            ->rawColumns(['edit', 'delete'])
            ->make(true);
        return $data;
    }

}
