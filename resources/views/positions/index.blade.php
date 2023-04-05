@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Hai {{auth()->user()->name}}</strong>{{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="text-end mb-2">
  <a class="btn btn-success" href="{{ route('positions.create') }}"> Add Positions</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Alias</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
  @foreach ($positions as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->keterangan }}</td>
        <td>{{ $item->alias }}</td>
        <td>
            <form action="{{ route('positions.destroy',$item->id) }}" method="Post">
                <a class="btn btn-primary" href="{{ route('positions.edit',$item->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
 @endforeach
  </tbody>
</table>
@endsection