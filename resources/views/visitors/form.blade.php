
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
@if (count($errors)>0)
   <div class="alert alert-danger" role="alert">
     <ul>
        @foreach ($errors->all() as $error)
         <li>
         {{ $error}}
         </li>
        @endforeach
     </ul>
   </div>
@endif
<section class="content-header">
               <div class="container-fluid">
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-body">
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="chart">
                                          <div class="form-group">
                                             <label for="name">Nombres</label>
                                             <input type="text" name="name" id="name" class="form-control {{$errors->has('name')?'is-invalid' : ''}}"
                                              value="{{ isset($visitors->name)?$visitors->name:old('name')}}">
                                              {!! $errors->first('name','<div class="invalid-feedback">:message</div>')!!}
                                           </div>
                                           <div class="form-group">
                                             <label for="last_name">Apellidos</label>
                                             <input type="text" name="last_name" id="last_name" class="form-control {{$errors->has('last_name')?'is-invalid' : ''}}"
                                              value="{{ isset($visitors->last_name)?$visitors->last_name:old('last_name')}}">
                                              {!! $errors->first('last_name','<div class="invalid-feedback">:message</div>')!!}
                                           </div>
                                           <div class="form-group">
                                             <label for="document">Número de Documento</label>
                                             <input type="number" name="document" id="document" class="form-control {{$errors->has('document')?'is-invalid' : ''}}"
                                              value="{{ isset($visitors->document)?$visitors->document:old('document')}}">
                                              {!! $errors->first('document','<div class="invalid-feedback">:message</div>')!!}
                                           </div>
                                           <div class="form-group">
                                            <label for="tipo_visitante_id">Tipo</label>
                                                <select name="tipo_visitante_id" id="tipo_visitante_id" class="form-control {{$errors->has('tipo_visitante_id')?'is-invalid' : ''}}" required>
                                                    <option
                                                    value="" > Seleccione...
                                                    </option>
                                                    @foreach ($typeVisitors as $type)
                                                        <option <?php if(isset($visitors) && $type->id==$visitors->tipo_visitante_id){ echo "selected"; }?>
                                                        value="{{ $type ['id']}}" > {{ $type ['name']}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                       </div>
                                     <br>
                                   </div>
                               </div>
                           </div>
                           <div class="card-footer">
                              <input type="submit" class="btn btn-success btn-sm float-right" value="{{ $modo=='crear' ? 'Agregar Visitante':'Modificar Visitante'}}">
                              <a href="{{url('visitors')}}" class="btn btn-danger btn-sm float-left">Cancelar</a>
                         </div>
                       </div>
                   </div>
           </section>
       </div>            
@endsection
