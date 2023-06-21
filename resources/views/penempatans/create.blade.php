@extends('app')
@section('content')
<form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NO Penempatan :</strong>
                <input type="text" name="no_penempatan" class="form-control" placeholder="NO Penempatan">
                @error('no_penempatan')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Penempatan :</strong>
                <input type="date" name="tgl_penempatan" class="form-control" placeholder="Tanggal Penempatan">
                @error('tgl_penempatan')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>HRD :</strong>
              <select name="id_hrd" id="id_hrd" class="form-select">
                <option value="">Pilih</option>
                @foreach ($managers as $item)
                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                @endforeach
              </select>
              @error('id_hrd')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div>

      <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
          <div class="form-group col-10">
              <input type="text" name="search" id="search" class="form-control" placeholder="Masukan Nama Company">
              @error('search')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-group col-2">
              <button type="text" class="btn btn-secondary"> Tambah </button>
          </div>
      </div>


      <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name Company</th>
                <th scope="col">Departmen Company</th>
                <th scope="col">Posisi</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="detail">
                
            </tbody>
        </table>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <input type="hidden" name="jml" class="form-control" >
          <div class="form-group">
              <strong>Grand Total:</strong>
              <input type="text" name="total" class="form-control" placeholder="Rp. 0">
              @error('tgl_rab')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div>
      </div>



    <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
    var path = "{{ route('search.company') }}";
  
    $( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
        //    console.log($("input[name=jml]").val());
            if($("input[name=jml]").val() > 0){
                for (let i = 1; i <=  $("input[name=jml]").val(); i++) {
                    id = $("input[name=productId"+i+"]").val();
                    if(id==ui.item.id){
                        alert(ui.item.value+' sudah ada!');
                        break;
                    }else{
                        add(ui.item.id);
                    }
                }
            }else{
                add(ui.item.id);
            } 
           return false;
        }
      });
  
</script>
@endsection
