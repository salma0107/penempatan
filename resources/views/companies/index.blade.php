@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif

<div class="text-end mb-2">
  <a class="btn btn-light" href="{{ route('exportpdf') }}"> Export</a>
  <a class="btn btn-success" href="{{ route('companies.create') }}"> Add Company</a>
</div>
<table class="table" id="example" style="width:100%">
  
  <thead>
    <tr>
      <th scope="col">No</th>        
      <th scope="col">Nama Company</th>
      <th scope="col">Nama Department</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($companies as $data)
    <tr>,
      <td>{{ $data->id }}</td>
      <td>{{ $data->name }}</td>
      <td>{{ $data->departmenCompany }}</td>
      <!-- <td>{{ $data->detail->count() }}</td>
      <td>{{ $data->total }}</td> -->

      <td>
        <form action="{{ route('companies.destroy',$data->id) }}" method="Post">
          <a class="btn btn-primary" href="{{ route('companies.edit',$data->id) }}">Edit</a>
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
@section('js')
<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
@endsection

