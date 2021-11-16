@extends('home2')

@section('content')
<div class="br-pagebody mg-t-10 pd-t-50 pd-x-30">
  <div class="row">
    <div class="col-lg-12 margin-tb tx-black">
        <div class="pull-left">
            <h2>Edit tipo</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tipos.index') }}"> Volver</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tipos.update',1) }}" method="POST">
    @csrf
    @method('PUT')

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="title" value="{{ $tipos->nombre }}" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Descripción:</strong>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Detail">{{ $tipos->descripcion }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>

</form>
</div>
@endsection
