@extends('layouts.admin')
@section('title', 'Penyewa')

@section('main-content')
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card card-primary">
                <div class="card-header">
                    <i class="fas fa-home"></i> Penyewa
                    <div class="float-right">
                        <a href="{{ route('penyewa.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
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
                                        <td>{{ $page->name }}</td>
                                        <td>{{ $page->address }}</td>
                                        <td>{{ $page->phone_number }}</td>

                                        <td>
                                            <a href="{{ route('penyewa.edit', $page) }}"
                                                class="btn btn-warning btn-sm mt-1 mr-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form class="d-inline" action="{{ route('penyewa.destroy', $page) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm mt-1 mr-1"
                                                    onclick="return confirm('Yakin ingin menjalankan aksi ini ? ketika aksi dijalankan data tidak akan bisa dikembalikan.')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
