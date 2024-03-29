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
  <a class="btn btn-success" href="{{ route('penempatans.create') }}"> Add Penempatan</a>
</div>
<table class="table" id="example" style="width:100%">
  
  <thead>
    <tr>
      <th scope="col">No</th>        
      <th scope="col">No Penempatan</th>
      <th scope="col">Tanggal Penempatan</th>
      <th scope="col">Manager Name</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

  <tbody>
  @php $no = 1; @endphp
    @foreach ($penempatans as $data)
    <tr>
      <td>{{ $no++ }}</td>
      <!-- <td>{{ $data->id }}</td> -->
      <td>{{ $data->no_penempatan }}</td>
      <td>{{ $data->tgl_penempatan }}</td>
      <td>{{ 
          (isset($data->getManager->name)) ? 
          $data->getManager->name : 
          'Tidak Ada'
          }}
      </td>
      <td>{{ $data->detail->count() }}</td>
      <!-- <td>{{ $data->total }}</td> -->

      <td>
        <form action="{{ route('penempatans.destroy',$data->id) }}" method="Post">
          <a class="btn btn-primary" href="{{ route('penempatans.edit',$data->id) }}">Edit</a>
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

