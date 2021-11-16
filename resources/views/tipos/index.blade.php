@extends('home2')

@section('content')
<div class="pd-30">
    <h4 class="tx-gray-800 mg-b-5">Listado Tipos</h4>
    {{--    <p class="mg-b-0">Do big things with Bracket, the responsive bootstrap 4 admin template.</p> --}}
</div><!-- d-flex -->

<div class="br-pagebody mg-t-5 pd-x-30">
  

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="card col-12">
    <div class="card-header">
        <h5 class="card-title">
            <div class="pull-right">
                <a class="btn btn-success tx-10" href="{{ route('tipos.create') }}"> Nuevo Tipo</a>
            </div>
        </h5>
    </div>
    <div class="card-body">      
      <div class="table-responsive" style="margin-top:10px;color:black">
          <table class="table table-striped jambo_table bulk_action">
              <thead>
                  <tr>
                      <th>N°</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th width="280px"></th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $value->nombre }}</td>
                    <td>{{ \Str::limit($value->descripcion, 100) }}</td>
                    <td>
                        <form action="{{ route('tipos.destroy',$value->id) }}" method="POST">   
                            {{-- <a class="btn btn-info tx-10" href="{{ route('tipos.show',$value->id) }}">Ver</a>     --}}
                            <a class="btn btn-primary tx-10" href="{{ route('tipos.edit',$value->id) }}">Editar</a>   
                            @csrf
                            @method('DELETE')      
                            <button type="submit" style="font-size:10px" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>           
        </table>  
      </div>
    </div>
  </div>

{!! $data->links() !!}    
</div><!-- br-pagebody -->
@endsection
