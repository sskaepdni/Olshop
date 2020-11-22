@extends('layouts.master')

@section('content')

<table class="table table-bordered">
	<thead>
		<tr>
			<th class="text-center" colspan="4">INVOICE</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Nama</th>
			<th>Qty</th>
			<th>Subtotal</th>
		</tr>
		@foreach($barangs as $index=>$barang)
		<tr>
			<td>{{ $barang->name }}</td>
			<td>{{ $barang->qty }}</td>
			<td>Rp. {{ $barang->subtotal() }}</td>
		</tr>
		@endforeach
		<tr>
			<th colspan="2">Total</th>
			<th style="background: lime;">Rp. {{ $total }}</th>
		</tr>
		<tr>
			<th colspan="1">Transfer Ke :</th>
			<td colspan="2">BRI : Atas Nama <b><i>Fulan Bin Fulan</i></b><br>No. Rekening <b><i>123456789</i></b></td>
		</tr>
	</tbody>
</table>

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