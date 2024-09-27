

@extends('adminlte/layout')

@section('links')
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
                    <div class="alert alert-info">
                        <p>Información:</p>
                        <ul>
                        {{Session::get('mensaje')}}
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="{{url('visitors/create')}}" class="btn btn-success">Agregar Visitante</a>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center"> <strong>Lista de Visitantes</strong> </p>
                                <div class="chart">
                                    <table class="table table-light" id="visitors">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Número de Documento</th>
                                                <th>Tipo</th>
                                                <th>Modificar</th>
                                                <th>Equipos</th>
                                                <?php if(auth()->user()->rol_id == 1): ?>
                                                    <th>Eliminar</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($visitors as $visitors)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$visitors->name}}</td>
                                                    <td>{{$visitors->last_name}}</td>  
                                                    <td>{{$visitors->document}}</td>  
                                                    <td>{{$visitors->type}}</td>                                                 
                                                    <td>
                                                        <a href="{{url('/visitors/'. $visitors->id.'/edit')}}">
                                                            <button class="btn btn-sm"><i class="fas fa-edit fa-1.5x fa-lg" style="color:blue"></i></button>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('/visitors/'. $visitors->id.'/index')}}">
                                                        <button class="btn btn-sm"><i class="fas fa-laptop fa-1.5x fa-lg" style="color:black"></i></button>
                                                        </a>
                                                    </td>
                                                    <?php if(auth()->user()->rol_id == 1): ?>
                                                        <td>
                                                            <form method="post" action="{{url('/visitors/'. $visitors->id)}}">
                                                                {{csrf_field()}}
                                                                {{ method_field('DELETE')}}
                                                                <button class="btn btn-sm" onclick="return confirm ('¿Borrar?');">
                                                                <i class="fas fa-trash-alt fa-1.5x fa-lg"  style="color:red"></i></button>
                                                            </form>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                              <br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script> $('#visitors').DataTable(); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
    @if (Session::has('info'))
        <script>
            toastr.success("{!! Session::get('info') !!}");
        </script>
    @endif
@endsection
