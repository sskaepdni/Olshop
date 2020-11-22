@extends('layouts.master')

@section('content')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="example1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr></thead>
                <tbody>
                @foreach($barangs as $index=>$barang)
                <?php 
                    $warna = 'black';
                    $stock = $barang->stock;
                    if($stock == 0){
                      $warna = 'red';
                    }
                ?>
                <tr style="color: {{ $warna }}">
                  <td>{{ $index+1 }}</td>
                  <td>{{ $barang->nama }}</td>
                  <td>{{ $barang->harga }}</td>
                  <td>{{ $barang->kategori->nama }}</td>
                  <td>{{ $barang->stock }}</td>
                  <td><span class="badge bg-{{ ($barang->status_id) == 1 ? 'green' : 'red' }}">{{ $barang->statuss['nama'] }}</span></td>
                  <td>
                    <a href="{{ url('barang/edit/'.$barang->barang_id) }}"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="" class="hapusBarang" barang-id="{{ $barang->barang_id }}"><i class="fa fa-fw fa-trash"></i></a>
                    <a href="{{ url('barang/show/'.$barang->barang_id) }}"><i class="fa fa-fw fa-search"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

       <!-- /.modal -->

        <div class="modal modal-danger fade" id="modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirm Delete</h4>
              </div>
              <div class="modal-body">
                <p>Yakin Ingin Menghapus Barang Ini?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <a href="" class="btn btn-outline confirmDelete">Ya, Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

@endsection

@section('scripts')

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function(){
    var flash = "{{ Session::has('pesan') }}";
    if(flash){
      var pesan = "{{ Session::get('pesan') }}";
      swal('success', pesan, 'success');
    }

    // Ketika hapus barang
    $('body').on('click', '.hapusBarang', function(e){
      e.preventDefault();
      var barang_id = $(this).attr('barang-id');
      var url = "{{ url('delete/barang') }}"+'/'+barang_id;
      $('.confirmDelete').attr('href', url);
      
      $('#modal-danger').modal();
    });

  });
</script>

@endsection