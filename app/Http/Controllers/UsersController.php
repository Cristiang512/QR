<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $datos['users']=User::paginate(5);
        $datos['users'] = User::leftJoin('rol', 'rol.id', '=', 'users.rol_id')
        ->select(
        'users.id',
        'users.name',
        'users.document',
        'users.phone',
        'users.email',
        'rol.name AS rol'
        )
        ->get();
        // $datos['users']=User::where('rol_id','=','2')->get();

        return view('users.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = Rol::all();
        return view('users.create',compact('rol'));
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
        'document' => ['required', 'string','unique:users'],
        'phone' => ['string', 'max:255'],
        'email' => ['string', 'max:255', 'unique:users'],
        'rol_id'=>'required|integer',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);

        $dataUsers=request()->except('_token');

        $dataUsers = User::create([
            'name' => $request->name,
            'document' => $request->document,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
        ]);


        return redirect('users')->with('mensaje','Usuario Agregado con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show($patient)
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
        //
        $rol = Rol::all();
        $users=User::findOrFail($id);
        return view('users.edit',compact ('users','rol'));
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
        $documnetOld = User::where('id','=',$id)
            ->select(
            'users.document'
            )
            ->get();
            
        if($request['document'] == $documnetOld[0]['document']){
            $campos = [
                'name' => ['required', 'string', 'max:255'],
                'document' => ['required', 'integer'],
                'phone' => ['string', 'max:255'],
                'email' => ['string', 'max:255'],
                'rol_id'=>'required|integer',
            ];
        } else {
            $campos = [
                'name' => ['required', 'string', 'max:255'],
                'document' => ['required', 'string','unique:users'],
                'phone' => ['string', 'max:255'],
                'email' => ['string', 'max:255'],
                'rol_id'=>'required|integer',
            ];
        }
        $mensaje=["required" => ' :attributo es requerido'];
        $this ->validate ($request,$campos,$mensaje);
        $dataUsers=request()->except(['_token','_method']);
        User::where('id','=',$id)->update($dataUsers);
        return redirect('users')->with('mensaje','Usuario Modificado con Éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('users')->with('mensaje','Usuario Eliminado con Éxito');
    }
}
