
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
                                      <label for="name">Nombre y Apellido</label>
                                      <input type="text" name="name" id="name" class="form-control {{$errors->has('name')?'is-invalid' : ''}}"
                                       value="{{ isset($users->name)?$users->name:old('name')}}" required>
                                       {!! $errors->first('name','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                    <div class="form-group">
                                      <label for="document">Número de Documento</label>
                                      <input type="number" name="document" id="document" class="form-control {{$errors->has('document')?'is-invalid' : ''}}"
                                      value="{{ isset($users->document)?$users->document:old('document')}}" required>
                                      {!! $errors->first('document','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                    <div class="form-group">
                                      <label for="phone">Número Teléfonico</label>
                                      <input type="text" name="phone" id="phone" class="form-control {{$errors->has('phone')?'is-invalid' : ''}}"
                                      value="{{ isset($users->phone)?$users->phone:old('phone')}}" required>
                                      {!! $errors->first('phone','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Correo Electrónico</label>
                                      <input type="email" name="email" id="email" class="form-control {{$errors->has('email')?'is-invalid' : ''}}"
                                      value="{{ isset($users->email)?$users->email:old('email')}}" required>
                                      {!! $errors->first('email','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                    <div class="form-group">
                                      <label for="rol_id">Rol</label>
                                      <select name="rol_id" id="rol_id" class="form-control {{$errors->has('rol_id')?'is-invalid' : ''}}" required>
                                          <option
                                          value="" > Seleccione...
                                          </option>
                                          @foreach ($rol as $ro)
                                              <option <?php if(isset($users) && $ro->id==$users->rol_id){ echo "selected"; }?>
                                              value="{{ $ro ['id']}}" > {{ $ro ['name']}}
                                              </option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <?php if($modo == 'crear'): ?>
                                     <!-- Password -->
                                      <div class="form-group mt-4">
                                          <x-label for="password" :value="__('Contraseña')" />

                                          <x-input id="password" class="form-control block mt-1 w-full"
                                                          type="password"
                                                          name="password"
                                                          required autocomplete="new-password" />
                                      </div>

                                      <!-- Confirm Password -->
                                      <div class="form-group mt-4">
                                          <x-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                                          <x-input id="password_confirmation" class="form-control block mt-1 w-full"
                                                          type="password"
                                                          name="password_confirmation" required />
                                      </div>
                                      <?php endif; ?> 
                                  </div>
                                <br>
                              </div>
                          </div>
                      </div>
                      <div class="card-footer">
                        <input type="submit" class="btn btn-success btn-sm float-right" value="{{ $modo=='crear' ? 'Agregar Usuario':'Modificar Usuario'}}">
                        <a href="{{url('users')}}" class="btn btn-danger btn-sm float-left">Cancelar</a>
                    </div>
                  </div>
              </div>
      </section>
  </div>        
@endsection
