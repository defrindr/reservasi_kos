@extends('layouts.admin')
@section('title', 'Daftar Transaksi')

@section('main-content')
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card card-primary">
                <div class="card-header">
                    <i class="fas fa-home"></i> Daftar Transaksi
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>NO</th>
                                <th>Penyewa</th>
                                <th>Kamar</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>ACTION</th>
                            </thead>
                            <tbody>
                                @if ($pages->count() == 0)
                                    <tr>
                                        <td colspan="8" class="text-center">Data kosong</td>
                                    </tr>
                                @endif
                                @foreach ($pages->items() as $page)
                                    <tr>
                                        <td>
                                            {{ $loop->index + 1 + ($pages->currentPage() - 1) * $pages->perPage() }}
                                        </td>
                                        <td>{{ $page->penyewa->name }}</td>
                                        <td>{{ $page->kamar->name }}</td>
                                        <td>{{ $page->status }}</td>
                                        <td>{{ $page->created_at }}</td>
                                        <td>
                                            @if ($page->status == 'pending')
                                                <form class="d-inline"
                                                    action="{{ route('transaksi.cancel-booking', $page) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm mt-1 mr-1"
                                                        onclick="return confirm('Yakin ingin menjalankan aksi ini ? ketika aksi dijalankan data tidak akan bisa dikembalikan.')">
                                                        <i class="fas fa-times"></i> Batalkan
                                                    </button>
                                                </form>
                                            @elseif($page->status == 'menunggu pembayaran')
                                                <div class="modal fade" id="modalUploadBuktiPembayaran{{ $page->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="modalUploadBuktiPembayaran{{ $page->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modalUploadBuktiPembayaran{{ $page->id }}">
                                                                    Upload Bukti Pembayaran
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="d-inline"
                                                                    action="{{ route('transaksi.submit-bukti-tf', $page) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <input type="file" class="form-control"
                                                                            name="bukti_pembayaran" required>
                                                                    </div>


                                                                    <button class="btn btn-primary btn-sm mt-1 mr-1"
                                                                        onclick="return confirm('Yakin ingin menjalankan aksi ini ? ketika aksi dijalankan data tidak akan bisa dikembalikan.')">
                                                                        <i class="fas fa-check"></i> Konfirmasi
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- open modal --}}
                                                <button type="button" class="btn btn-primary btn-sm mt-1 mr-1"
                                                    data-toggle="modal"
                                                    data-target="#modalUploadBuktiPembayaran{{ $page->id }}">
                                                    <i class="fas fa-money-bill-wave"></i> Bayar
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
