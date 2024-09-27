@extends('adminlte/layout')


@section('links')
    <link href="public/css/multiselect.css" media="screen" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endsection
@section('app')
<form action="{{route('saveMovement',$equipment_id)}}" method="POST" enctype="multipart/form-data" >
{{ csrf_field() }}
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="col-md-12">
                    
                @if(Session::has('mensaje'))
                    <div class="alert alert-danger">
                        <p>Corrige los siguientes errores:</p>
                        <ul>
                        {{Session::get('mensaje')}}
                        </ul>
                    </div>
                @endif
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title" style="color: black"><strong>
                                    @foreach ($equipment as $equip)
                                     {{ $equip->type }} - {{ $equip->brand }} - {{ $equip->serial }}
                                    @endforeach
                                </strong></h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="chart">
                                        <table class="table table-light" id="historial">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tipo de Movimiento</th>
                                                    <th>Fecha y Hora del Movimiento</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($movement as $mov)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>
                                                            <?php if($mov->movement == 'Entrada'): ?>
                                                                <a style="color:green">
                                                                    <b>
                                                                        {{ $mov->movement}}
                                                                    </b>
                                                                </a>
                                                            <?php endif; ?> 
                                                            <?php if($mov->movement == 'Salida'): ?>
                                                                <a style="color:crimson">
                                                                    <b>
                                                                        {{ $mov->movement}}
                                                                    </b>
                                                                </a>
                                                            <?php endif; ?> 
                                                        </td>
                                                        <td>{{ $mov->fecha_hora}}</td>
                                                        <td>
                                                            <a href="{{ url('movement/ocultar',$mov->id)}}" onclick="return confirm('¿Esta seguro de eliminar este Movimiento?')" data-toggle="tooltip" data-placement="right" title="Eliminar">
                                                                <i class="fas fa-trash-alt fa-1.5x fa-lg" style="color:red" aria-hidden="true"></i>
                                                            </a>
                                                        </td> 
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                </div>
                                {{-- col-3 --}}
                            </div>
                        </div>
                    </div>
                    {{-- Segunda card --}}
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title" style="text-align: center"><strong>Agregar Movimiento</strong></h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <p class="text-center"><strong></strong></p>
                                    --}}
                                    <div class="chart">
                                    </div>
                                    <!-- right column -->
                        <!--/.col (left) -->
                        <div class="col-md-12">
                                    <!-- general form elements -->
                                <div class="card card-primary">
                                    

                                    </div>
                                    <div role="form">
                                        <div class="card-body">

                                        <div class="row">
                                            <input type="hidden" name="equipment_id" id="equipment_id" value="{{$equipment_id}}">
                                            
                                            <!-- <fieldset class="pregunta uno"> -->

                                            <input name="tipo_movimiento_id" type="radio" id="input_1" class="esconder" value="1" required>
                                            <input name="tipo_movimiento_id" type="radio" id="input_2" class="esconder" value="2" required>

                                            <div>
                                                <label class="fas fa-share fa-1.5x fa-lg" style="font-size:35px;color:green" for="input_1">Entrada</label>
                                                <label class="fas fa-reply-all fa-1.5x fa-lg"  style="font-size:35px;color:red" for="input_2">Salida</label>
                                            </div>
                                            
                                            </fieldset>
                                                                                
                                        </div>
                                    </div>
                                </div>
                    <!-- /.card -->
                                <br>
                            </div>
                                {{-- col-3 --}}
                        </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">Agregar</button>
                        <a href="{{ url('visitors/'.$equip->visitante_id.'/index')}}" class="btn btn-danger btn-sm float-left col-md-1">Atrás</a>
                        <a href="{{ url('visitors/')}}" class="btn btn-warning btn-sm float-left col-md-2">Página Principal</a>
                </form>
                    </div>
                </div>
        </section>
    </div>
 </form>
@endsection

@section('javascript')
    <script src="public/js/jquery.multi-select.js" type="text/javascript"></script>
    <script> $('#my-select').multiSelect()</script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#historial').DataTable();
    </script>
    <script src="{{ asset('dist/js/dependents.js') }}"></script>
@endsection

<style >
.pregunta{
  padding: 1em;
}

input.esconder{
  position: fixed;
  opacity: 0;
}

/*Esto es para crear una excepción en el label que tenga la clase group*/ 
/*Podría haber colocado los estilos del 3er ejemplo aquí, pero para que no te confundas, los separe más abajo*/
label:not(.grupo){
  background: whitesmoke;
  padding: 0.5em 1em;
  cursor: pointer;
  border-radius: 3em;
}

label:not(.grupo):hover{
  background: gray;
  color: white;
}

/*Estilos para estructura 1*/
#input_1:checked ~ div label[for="input_1"],
#input_2:checked ~ div label[for="input_2"],
#input_3:checked ~ div label[for="input_3"],
/*Estilos para estructura 2*/
#input_4:checked + label[for="input_4"],
#input_5:checked + label[for="input_5"]{
  background: black;
  color: white;
}

</style>
