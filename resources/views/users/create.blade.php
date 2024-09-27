



<form action="{{url('/users')}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@include('users.form',['modo'=>'crear'])



</form>
