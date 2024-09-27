<?php

namespace App\Http\Controllers;

use App\Models\Visitors;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\TypeVisitors;

class VisitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['visitors'] = Visitors::leftJoin('type_visitors', 'type_visitors.id', '=', 'visitante.tipo_visitante_id')
        ->select(
        'visitante.id',
        'visitante.name',
        'visitante.last_name',
        'visitante.document',
        'type_visitors.name AS type'
        )
        ->orderBy('visitante.id', 'DESC')
        ->get();
        

        return view('visitors.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $typeVisitors = TypeVisitors::all();
        return view('visitors.create', compact('typeVisitors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'document' => ['required', 'integer', 'unique:visitante'],
            'tipo_visitante_id'=>'required|integer',
        ];

        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);

        $dataVisitors=request()->except('_token');

        $dataVisitors = Visitors::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'document' => $request->document,
            'tipo_visitante_id' => $request->tipo_visitante_id,
            
        ]);


        return redirect('visitors')->with('mensaje','Visitante Agregado con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show($visitors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitors=Visitors::findOrFail($id);
        $typeVisitors = TypeVisitors::all();
        return view('visitors.edit',compact ('visitors', 'typeVisitors'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $documnetOld = Visitors::where('id','=',$id)
            ->select(
            'visitante.document'
            )
            ->get();
            
        if($request['document'] == $documnetOld[0]['document']){
            $campos = [
                'name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'document' => ['required', 'integer'],
                'tipo_visitante_id'=>'required|integer',
            ];
        } else {
            $campos = [
                'name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'document' => ['required', 'integer','unique:visitante'],
                'tipo_visitante_id'=>'required|integer',
            ];
        }

        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);
        $dataVisitors=request()->except(['_token','_method']);
        Visitors::where('id','=',$id)->update($dataVisitors);
        return redirect('visitors')->with('mensaje','Visitante Modificado con Éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Visitors::destroy($id);
        return redirect('visitors')->with('mensaje','Visitante Eliminado con Éxito');
    }
}
