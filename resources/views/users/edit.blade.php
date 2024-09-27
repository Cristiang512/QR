



<form action="{{url('/users/' . $users->id)}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
@include('users.form',['modo'=>'editar'])

</form>




