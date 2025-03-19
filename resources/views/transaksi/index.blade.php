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
                    <div class="p-4">
                        <select name="status" id="status" class="form-control" onchange="onChangeStatus()">
                            <option @if (request('status') == '') selected @endif value="">Pilih Status</option>
                            <option @if (request('status') == 'pending') selected @endif value="pending">Pending</option>
                            <option @if (request('status') == 'menunggu pembayaran') selected @endif value="menunggu pembayaran">Menunggu
                                Pembayaran</option>
                            <option @if (request('status') == 'konfirmasi pembayaran') selected @endif value="konfirmasi pembayaran">Butuh
                                Validasi Pembayaran</option>
                            <option @if (request('status') == 'selesai') selected @endif value="selesai">Selesai</option>
                            <option @if (request('status') == 'dibatalkan') selected @endif value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>NO</th>
                                <th>Penyewa</th>
                                <th>Kamar</th>
                                <th>Status</th>
                                <th>ACTION</th>
                            </thead>
                            <tbody>
                                @if ($pages->count() == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">Data kosong</td>
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
                                        <td>
                                            @if ($page->status == 'pending')
                                                <form method="post" action="{{ route('transaksi.confirm', $page) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary btn-sm" name="confirm"
                                                        value="{{ $page->id }}">
                                                        <i class="fas fa-check"></i> Konfirmasi
                                                    </button>
                                                </form>
                                            @elseif($page->status == 'konfirmasi pembayaran')
                                                {{-- Modal Lihat Bukti TF --}}
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#konfirmasiPembayaran{{ $page->id }}">
                                                    <i class="fas fa-eye"></i>
                                                    Lihat Bukti TF
                                                </button>


                                                <!-- Modal -->
                                                <div class="modal fade" id="konfirmasiPembayaran{{ $page->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Bukti TF</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="{{ asset('storage/' . $page->transfer_photo) }}"
                                                                    alt="Bukti Transfer" class="img-fluid">
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{-- Tutup --}}
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-dismiss="modal">
                                                                    <i class="fas fa-times"></i> Tutup
                                                                </button>

                                                                {{-- Reject --}}
                                                                <form method="post"
                                                                    action="{{ route('transaksi.reject', $page) }}"
                                                                    onsubmit="return confirm('Apakah anda yakin ingin membatalkan transaksi ini?')">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-times"></i> Tolak
                                                                    </button>
                                                                </form>

                                                                {{-- Bayar --}}
                                                                <form method="post"
                                                                    action="{{ route('transaksi.confirmation-payment', $page) }}"
                                                                    onsubmit="return confirm('Apakah anda yakin ingin mengapprove pembayaran?')">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-success btn-sm">
                                                                        <i class="fas fa-check"></i> Approve
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
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
    <script>
        function onChangeStatus() {
            var status = document.getElementById('status').value;
            window.location.href = "{{ route('transaksi.index') }}?status=" + status;
        }
    </script>
@endsection
