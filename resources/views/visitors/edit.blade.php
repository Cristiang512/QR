



<form action="{{url('/visitors/' . $visitors->id)}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
@include('visitors.form',['modo'=>'editar'])

</form>




