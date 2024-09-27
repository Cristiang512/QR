


<form action="{{url('/visitors')}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@include('visitors.form',['modo'=>'crear'])

</form>
