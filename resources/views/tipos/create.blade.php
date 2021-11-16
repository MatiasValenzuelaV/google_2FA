@extends('home2')

@section('content')
<div class="br-pagebody mg-t-10 pd-t-50 pd-x-30">
  <div class="row">
    <div class="col-lg-12 margin-tb tx-black">
        <div class="pull-left">
            <h2>Nuevo Tipo</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tipos.index') }}"> Back</a>
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
  
  <form action="{{ route('tipos.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre tipo:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Enter Title">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Descripción:</strong>
                <textarea class="form-control" style="height:150px" name="descripcion" placeholder="Enter Description"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Crear</button>
        </div>
    </div>
  
  </form>
</div>
@endsection
