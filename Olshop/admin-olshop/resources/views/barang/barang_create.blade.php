@extends('layouts.master')

@section('content')

<div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="{{ url('barang/store') }}" enctype="multipart/form-data">
    	{{csrf_field()}}
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Barang</label>
          <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="exampleInputEmail1">
          @if ($errors->has('nama'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Keterangan</label>
          <textarea name="keterangan" class="form-control" id="editor1" rows="10">{{ old('keterangan') }}</textarea>
          @if ($errors->has('keterangan'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('keterangan') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Kategori</label>
          <select class="form-control select2" name="kategori_id">
          	@foreach($kategoris as $kategori)
          	<option value="{{ $kategori->kategori_id }}">{{ $kategori->nama }}</option>
          	@endforeach
          </select>
          @if ($errors->has('kategori_id'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('kategori_id') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Harga Barang</label>
          <input type="number" name="harga" value="{{ old('harga') }}" class="form-control">
          @if ($errors->has('harga'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('harga') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Stock</label>
          <input type="number" name="stock" value="{{ old('stock') }}" class="form-control">
          @if ($errors->has('stock'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('stock') }}</strong>
                        </span>
                    @endif
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Status</label>
          <select name="status" class="form-control">
            <option value="1">Tampilkan</option>
            <option value="2">Sembunyikan</option>
          </select>
          @if ($errors->has('status'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
        </div>

        <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" name="photo" id="exampleInputFile">

          <p class="help-block">Example block-level help text here.</p>
          @if ($errors->has('photo'))
                <span class="help-block">
                    <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                </span>
            @endif
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Tambah</button>
        <span class="submitLoading" style="display: none;"><img src="{{ asset('loading.gif') }}"></span>
      </div>
    </form>
  </div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$("button[type='submit']").click(function(){
			$('.submitLoading').show();
		});
	});
</script>

@endsection