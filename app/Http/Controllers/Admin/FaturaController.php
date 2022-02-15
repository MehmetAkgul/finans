<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fatura;
use App\Models\FaturaIslem;
use App\Models\Kalem;
use App\Models\Musteriler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class FaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        return view('admin.fatura.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($type)
    {
        $musteriler = Musteriler::all();
        $kalem = Kalem::where('kalemTipi', $type)->get();
        if ($type == 0) {
            return view('admin.fatura.gelir.create', compact('musteriler', 'kalem'));
        } else {
            return view('admin.fatura.gider.create', compact('musteriler', 'kalem'));
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

        $create = false;

        $type = $request->route('type');
        $all = $request->except('_token');
        $islem = $all['islem'];
        unset($all['islem']);
        $all['faturaTipi'] = $type;

        $control = Fatura::where('faturaNo', $all['faturaNo'])->count();
        if ($control == 0) {
            $create = Fatura::create($all);
            if ($create) {
                if (count($islem) != 0) {
                    foreach ($islem as $k => $v) {
                        $islemArray = [
                            'faturaId' => $create->id,
                            'kalemId' => $v['kalemId'],
                            'gun_adet' => $v['gun_adet'],
                            'tutar' => $v['tutar'],
                            'kdv' => $v['kdv'],
                            'toplam_tutar' => $v['toplam_tutar'],
                            'kdv_tutar' => $v['kdv_tutar'],
                            'genel_toplam_tutar' => $v['genel_toplam_tutar'],
                            'description' => $v['description'],
                        ];
                        FaturaIslem::create($islemArray);
                    }
                }
            }
        } else {
            $notification = array('staus', 'Bu Fatura Mevcut');
            return redirect()->back()->with($notification)->header('Content-Type', 'text/html');
        }

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
        $c = Fatura::where('id', $id)->count();
        if ($c != 0) {

            $data = Fatura::where('id', $id)->first();

         //  dd($data);


            $dataIslem = FaturaIslem::where('faturaId', $id)->get();
            $musteriler = Musteriler::all();
            $kalem = Kalem::where('kalemTipi', $data->faturaTipi)->get();
            if ($data->faturaTipi == 0) {


                return view('admin.fatura.gelir.edit', compact('data', 'dataIslem', 'musteriler', 'kalem'));
            } else {
                return view('admin.fatura.gider.edit', compact('data', 'dataIslem', 'musteriler', 'kalem'));

            }

            return view('admin.fatura.gider.edit', compact('data', 'dataIslem'));
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


        $c = Fatura::where('id', $id)->count();
        if ($c != 0) {

            $all = $request->except('_token');
            $islem = $all['islem'];
            unset($all['islem']);

            if (count($islem) != 0) {
                FaturaIslem::where('faturaId', $id)->delete();
                foreach ($islem as $k => $v) {
                    $islemArray = [
                        'faturaId' => $id,
                        'kalemId' => $v['kalemId'],
                        'gun_adet' => $v['gun_adet'],
                        'tutar' => $v['tutar'],
                        'kdv' => $v['kdv'],
                        'toplam_tutar' => $v['toplam_tutar'],
                        'kdv_tutar' => $v['kdv_tutar'],
                        'genel_toplam_tutar' => $v['genel_toplam_tutar'],
                        'description' => $v['description'],
                    ];
                    FaturaIslem::create($islemArray);
                }
            }

            $update = Fatura::where('id', $id)->update($all);

            if ($update) {
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
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public
    function delete($id)
    {
        $c = Fatura::where('id', $id)->count();

        if ($c != 0) {

            $delete = Fatura::where('id', $id)->delete();
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
        $table = Fatura::query();
        $data = DataTables::of($table)
            ->addColumn('edit', function ($table) {
                return '<a href="' . route('fatura.edit', ['id' => $table->id]) . '">Düzenle</a>';
            })
            ->addColumn('delete', function ($table) {
                return '<a href="' . route('fatura.delete', ['id' => $table->id]) . '">Sil</a>';
            })
            ->addColumn('musteri', function ($table) {
                return Musteriler::getPublicName($table->musteriId);
            })
            ->editColumn('faturaTipi', function ($table) {
                if ($table->faturaTipi == 0) {
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
