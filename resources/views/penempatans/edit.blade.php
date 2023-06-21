@extends('app')
@section('content')
<form action="{{ route('penempatans.update',$penempatan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NO Penempatan :</strong>
                <input type="text" name="no_penempatan" class="form-control" placeholder="NO Penempatan" value="{{ $penempatan->no_penempatan }}">
                @error('no_penempatan')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Penempatan :</strong>
                <input type="date" name="tgl_penempatan" class="form-control" placeholder="Tanggal Penempatan" value="{{ $penempatan->tgl_penempatan }}">
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
                <option value="{{ $item->id }}" {{ ($item->id==$penempatan->id_hrd)? 'selected': ''}}>{{ $item->name }}</option>
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
        <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
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
                <?php $no=0; ?>
                @foreach($detail as $item)
                <?php $no++?>
                <tr>
                    <td>
                        <input type="hidden" name="companyId{{$no}}" class="form-control" value="{{$item->id_company}}">
                        <span>{{$no}}</span>
                    </td>
                    <td>
                        <input type="text" name="companyName{{$no}}" class="form-control" value="{{$item->getcompany->name}}">
                    </td>
                    <td>
                        <input type="text" name="departmenCompany{{$no}}" class="form-control" value="{{$item->departmenCompany}}" >
                    </td>
                    <td>
                        <input type="text" name="posisi{{$no}}" class="form-control" value="{{$item->posisi}}" >
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-danger">X</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
        </table>

        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
        <input type="hidden" name="jml" class="form-control" value="{{count($detail)}}" >
          <div class="form-group">
              <strong>Grand Total:</strong>
              <input type="text" name="total" class="form-control" placeholder="Rp. 0" value="{{$penempatan->total}}">
              @error('tgl_penempatan')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div> -->
      </div>
      <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
  </div>

</form>
@endsection