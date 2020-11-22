@extends('layouts.master')

@section('content')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="row">
	<span><small style="color: red;">*Click nama penerima untuk detail</small></span>
	<table class="table table-bordered" id="myTable">
		<thead>
			<tr>
				<th>#</th>
				<th>Nama Penerima</th>
				<th>Alamat</th>
				<th>Total Bayar</th>
				<th>Tanggal</th>
				<th>Kode Pesanan</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($pesanans as $index=>$pesanan)
			<tr>
				<td>{{ $index+1 }}</td>
				<td class="penerima" style="cursor: pointer; color: blue;" pesanan-id="{{ $pesanan->pesanan_id }}"><span>{{ $pesanan->nama_penerima }}</span></td>
				<td>{{ $pesanan->alamat }}</td>
				<td>Rp. {{ number_format($pesanan->total_bayar,0) }}</td>
				<td>{{ $pesanan->tanggal }}</td>
				<th>{{ $pesanan->pesanan_id }}</th>
				<td><p>{{ $pesanan->status->nama }}</p></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Pesanan</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
        	<thead>
        		<tr>
	        		<th>
	        			#
	        		</th>
	        		<th>
	        			Nama Barang
	        		</th>
	        		<th>
	        			Qty
	        		</th>
	        		<th>
	        			SubTotal
	        		</th>
	        	</tr>
        	</thead>
        	<tbody id="detail-pesanan">
        		
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
@section('scripts')

<script type="text/javascript" src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
	$(document).ready(function(){
		$('#myTable').DataTable();

		$('body').on('click', '.penerima', function(){
			var pesanan_id = $(this).attr('pesanan-id');

			$.ajax({
				type: 'get',
				dataType: 'json',
				url: "{{ url('invoice/detail') }}"+'/'+pesanan_id,
				success: function(data){

					$.each(data.hasil, function(i,v){
						var pesanan = '<tr>';

						pesanan += '<td>';
						pesanan += i+1;
						pesanan += '</td>';

						pesanan += '<td>';
						pesanan += v.nama_barang;
						pesanan += '</td>';

						pesanan += '<td>';
						pesanan += v.qty;
						pesanan += '</td>';

						pesanan += '<td>';
						pesanan += v.subtotal;
						pesanan += '</td>';

						pesanan += '</tr>';

						$('#detail-pesanan').append(pesanan);
					});
				}
			});

			$('#myModal').modal();
		});
	});
</script>

@endsection