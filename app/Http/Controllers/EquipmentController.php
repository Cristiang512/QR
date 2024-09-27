<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Visitors;
use App\Models\Brand;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $datos['visitante']=Visitors::where('id','=',$id)->get();

        $datos['equipment'] = Equipment::leftJoin('marca', 'marca.id', '=', 'equipo.brand_id')
        ->select(
        'equipo.id',
        'equipo.type',
        'marca.name AS brand',
        'equipo.serial'
        )
        ->where('visitante_id','=',$id)
        ->get();

        $brand = Brand::all();
        $datos['visitante_id']=$id;
        return view('visitors.equipment', $datos, compact('brand'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = Equipment::select('id')
        ->where([
            ['type', $request['type']],
            ['brand_id', $request['brand_id']],
            ['serial', $request['serial']]
        ])
        ->get()
        ->toArray();

        if(!empty($query)){
            return redirect()->back()->with('mensaje','Ya hay un Equipo Resgistrado con la Misma Información');
        }

        $registro = new Equipment;
        $registro->visitante_id=$request->visitante_id;
        $registro->type=$request->type;
        $registro->brand_id=$request->brand_id;
        $registro->serial=$request->serial;

        $registro->save();

        return redirect()->route('visitorsEquipment',['id'=>$registro['visitante_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        //
    }

    public function ocultar($id)
    {       
        Equipment::where('id',$id)->delete();
        return redirect()->back();
    }

    public function generateQR($id)
    {       
        $datos['equipment'] = $id;
        return view('visitors.qr', $datos);
    }
    
}

