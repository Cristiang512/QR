<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Equipment;
use App\Models\MovementType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $datos['equipment']=Equipment::leftJoin('marca', 'marca.id', '=', 'equipo.brand_id')
        ->select(
            'equipo.id',
            'equipo.type',
            'equipo.serial',
            'equipo.visitante_id',
            'marca.name AS brand'
            )
        ->where('equipo.id','=',$id)
        ->get();
        $datos['movement'] = Movement::leftJoin('tipo_movimiento', 'tipo_movimiento.id', '=', 'movimiento.tipo_movimiento_id')
        ->select(
        'movimiento.id',
        'tipo_movimiento.name AS movement',
        'movimiento.fecha_hora'
        )
        ->where('equipo_id','=',$id)
        ->orderBy('movimiento.id', 'DESC')
        ->get();
        $movementType = MovementType::all();
        $datos['equipment_id']=$id;
        return view('visitors.movement', $datos, compact('movementType'));
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
        // return $request;
        $tz = new \DateTime("America/Bogota");
        $registro = new Movement;
        $registro->tipo_movimiento_id=$request->tipo_movimiento_id;
        $registro->equipo_id=$request->equipment_id;
        $registro->fecha_hora=$tz->format('Y-m-d H:i:s');

        $registro->save();

        return redirect()->route('movementEquipment',['id'=>$registro['equipo_id']]);
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
        Movement::where('id',$id)->delete();
        return redirect()->back();
    }

    // public function qr_qenerate()
    // {
        //QrCode::format('svg')->size(700)->color(255,0,0)->generate('Desarrollo libre Andres', '../public/qrcodes/qrcode.svg');
 
        // QrCode::format('png')->size(700)->color(255, 0, 0)->merge('https://www.desarrollolibre.net/assets/img/logo.png', .3, true)->generate('Desarrollo libre Andres', '../public/qrcodes/qrcode.png');
    // }

    // public function download(Redirection $redirect)
    // {
    //     $fileDest = storage_path('app/qrcode.svg');
    //     $url = URL::to('/').'/'.$redirect->uuid;
    //     QrCode::size(400)->generate($url, $fileDest);
    //     return Storage::download($fileDest);
    // }
    

}

