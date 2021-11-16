@extends('home2')

@section('content')
<div class="pd-30">
    <h4 class="tx-gray-800 mg-b-5">Listado Tipos</h4>
    {{--    <p class="mg-b-0">Do big things with Bracket, the responsive bootstrap 4 admin template.</p> --}}
</div><!-- d-flex -->

<div class="br-pagebody mg-t-5 pd-x-30">
  <div class="row" style="margin-top: 5rem;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Laravel 8 CRUD Example from scratch - laravelcode.com</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('usuarios.create') }}"> Create New Post</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Details</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($data as $key => $value)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $value->title }}</td>
        <td>{{ \Str::limit($value->description, 100) }}</td>
        <td>
            <form action="{{ route('usuarios.destroy',$value->id) }}" method="POST">   
                <a class="btn btn-info" href="{{ route('usuarios.show',$value->id) }}">Show</a>    
                <a class="btn btn-primary" href="{{ route('usuarios.edit',$value->id) }}">Edit</a>   
                @csrf
                @method('DELETE')      
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>  
{!! $data->links() !!}    
</div><!-- br-pagebody -->
@endsection
