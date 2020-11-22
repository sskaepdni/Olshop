@extends('layouts.master')

@section('content')

<ul class="thumbnails">
@foreach($barangs->chunk(3) as $barangChunk)
<div class="row">
	@foreach($barangChunk as $barang)
	<li class="span3">
	  <div class="thumbnail">
	  	<?php
	  		$gambar = \DB::table('base64')->where('barang_id', $barang->barang_id)->value('nama');
	  		$photo = base64_decode($gambar);
	  	?>
		<a  href="{{ url('barang/show/'.$barang->barang_id) }}"><img style="height: 200px;" src="{{ $photo }}" alt=""/></a>
		<div class="caption">
		  <h5>{{ $barang->nama }}</h5>
		 
		  <h4 style="text-align:center"><a class="btn" href="{{ url('barang/show/'.$barang->barang_id) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ url('add-to-cart/'.$barang->barang_id) }}">Add to <i class="icon-shopping-cart"></i></a>
		  	<div>
		  		<a class="btn btn-primary" href="#">Rp. {{ number_format($barang->harga, 0) }}</a>
		  	</div>
		  </h4>
		</div>
	  </div>
	</li>
	@endforeach
</div>
@endforeach
</ul>


@endsection

@section('scripts')
	
	<script>
		$(document).ready(function(){
			var flash = "{{ Session::has('pesan') }}";
			if(flash){
				var pesan = "{{ Session::get('pesan') }}";
				swal('success', pesan, 'success');
			}
		});
	</script>

@endsection