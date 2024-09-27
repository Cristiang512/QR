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
                                    @foreach ($visitante as $visit)
                                     {{ $visit->name }} {{ $visit->last_name }}  -
                                       {{'C.C.'}} {{ $visit->document }}
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
                                                    <th>Tipo de Equipo</th>
                                                    <th>Marca</th>
                                                    <th>Serial</th>
                                                    <?php if($visit->tipo_visitante_id == 1 || $visit->tipo_visitante_id == 2): ?>
                                                        <th>Ver QR</th>
                                                    <?php endif; ?>
                                                    <th>Movimientos</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($equipment as $equip)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $equip->type}}</td>
                                                        <td>{{ $equip->brand}}</td>
                                                        <td>{{ $equip->serial}}</td>
                                                        <?php if($visit->tipo_visitante_id == 1 || $visit->tipo_visitante_id == 2): ?>
                                                            <td>
                                                                <a href="{{ url('equipment/QR',$equip->id)}}" target="_blank">
                                                                    <button class="btn btn-sm"><i class="fas fa-qrcode fa-2x fa-lg" style="color:black"></i></button>
                                                                </a>
                                                            </td>
                                                        <?php endif; ?>
                                                        <td>
                                                            <a href="{{url('/visitors/'. $equip->id.'/equipment')}}">
                                                                <button class="btn btn-sm"><i class="fas fa-arrows-alt-h fa-2x fa-lg" style="color:blue"></i></button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('visitors/ocultar',$equip->id)}}" onclick="return confirm('¿Esta seguro de eliminar este Equipo?')" data-toggle="tooltip" data-placement="right" title="Eliminar">
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
<form action="{{route('saveEquipment',$visitante_id)}}" method="POST" enctype="multipart/form-data" >
{{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title" style="text-align: center"><strong>Agregar Equipo</strong></h1>
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
                                            <input type="hidden" name="visitante_id" id="visitante_id" value="{{$visitante_id}}">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="type">Tipo</label>
                                                    <select name="type" id="type" class="form-control {{$errors->has('type')?'is-invalid' : ''}}" required>
                                                        <option
                                                        value="" > Seleccione...
                                                        </option>
                                                        <option value="Computador Portátil">Computador Pórtatil</option>
                                                        <option value="Computador de Escritorio">Computador de Escritorio</option>
                                                        <option value="Tablet">Tablet</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="brand">Marca</label>
                                                    <select name="brand_id" id="brand_id" class="form-control {{$errors->has('brand_id')?'is-invalid' : ''}}" required>
                                                        <option
                                                        value="" > Seleccione...
                                                        </option>
                                                        @foreach ($brand as $bran)
                                                            <option value="{{ $bran ['id']}}" > {{ $bran ['name']}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="serial">Serial</label>
                                                    <input type="text" name="serial" id="serial" class="form-control" required>
                                                </div>
                                            </div>
                                </div>
                        </div>
                    </div>
                    <!-- /.card -->
                                <br>
                            </div>
                                {{-- col-3 --}}
                        </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">Cargar</button>
                        <a href="{{url('visitors')}}" class="btn btn-danger btn-sm float-left">Regresar</a>
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


