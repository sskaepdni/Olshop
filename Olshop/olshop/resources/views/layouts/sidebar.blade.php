<div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{asset('bootshop/themes/images/ico-cart.png')}}" alt="cart">{{ count(Cart::content()) }} Items in your cart  <span class="badge badge-warning pull-right">Rp. {{ Cart::total() }}</span></a></div>
<ul id="sideManu" class="nav nav-tabs nav-stacked">
	<?php
		$kategoris = \DB::table('kategori')->orderBy('nama', 'asc')->get();
	?>
@foreach($kategoris as $kategori)
	<?php
		$jumlah = \DB::table('barang')->where('kategori_id', $kategori->kategori_id)->where('status_id', 1)->get();
	?>
	<li><a href="{{ url('barang/kategori/'.$kategori->kategori_id) }}">{{$kategori->nama}} [{{count($jumlah)}}]</a></li>
@endforeach
</ul>
<br/>
<?php $barangs = \DB::table('barang')->inRandomOrder()->limit(2)->get(); ?>
@foreach($barangs as $barang)
  <div class="thumbnail">
  	<?php
  		$gambar = \DB::table('base64')->where('barang_id', $barang->barang_id)->value('nama');
  		$photo = base64_decode($gambar);
  	?>
	<img style="height: 200px;" src="{{ $photo }}" alt="Bootshop panasonoc New camera"/>
	<div class="caption">
	  <h5>{{ $barang->nama }}</h5>
		<h4 style="text-align:center"><a class="btn" href="{{ url('barang/show/'.$barang->barang_id) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ url('add-to-cart/'.$barang->barang_id) }}">Add to <i class="icon-shopping-cart"></i></a>
			<div>
				<a class="btn btn-primary" href="#">Rp. {{ number_format($barang->harga, 0) }}</a>
			</div>
		</h4>
	</div>
  </div>
 @endforeach