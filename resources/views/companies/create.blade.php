@extends('app')
@section('content')
<form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Company :</strong>
                <input type="text" name="name" class="form-control" placeholder="Nama Company">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Department :</strong>
                <input type="text" name="departmenCompany" class="form-control" placeholder="Nama Department">
                @error('departmenCompany')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
        <div class="form-group col-10">
            <input type="text" name="search" id="search" class="form-control" placeholder="Masukkan Nama Company">
            @error('search')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-2">
            <button type="text" class="btn btn-secondary">Tambah</button>
        </div> -->
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name Company</th>
                    <th scope="col">Department Company</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="detail">

            </tbody>
        </table>
        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <input type="hidden" name="jml" class="form-control">
            <div class="form-group">
                <strong>Jumlah Penempatan:</strong>
                <input type="text" name="total" class="form-control" placeholder="0">
                @error('tgl_penempatan')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div> -->
    </div>



    <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
    var path = "{{ route('search.companies') }}";
  
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
                    id = $("input[name=companyId"+i+"]").val();
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

      function add(id){
        // console.log(id);
        const path = "{{ route('companies.index') }}/"+id;
        var html = "";
        var no=0;
        $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            
            success: function( data ) {
                if($('#detail tr').length > no){
                    html = $('#detail').html();
                    no = $('#detail tr').length;
                }
                no++;
                html+='<tr>'+
                        '<td>'+
                            '<input type="hidden" name="companyId'+no+'" class="form-control" value="'+data.id+'">'+
                            '<span>'+no+'</span>'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="companyName'+no+'" class="form-control" value="'+data.name+'" >'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="departmenCompany'+no+'" class="form-control" value="'+data.departmenCompany+'" >'+
                        '</td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-sm btn-danger">X</a>'+
                        '</td>'+
                    '</tr>';

                    $('#detail').html(html);
                    $("input[name=jml]").val(no);
            }
          });
    }
  
</script>
@endsection
