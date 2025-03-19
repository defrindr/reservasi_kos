@extends('layouts.admin')
@section('title', 'Kamar Kos')

@section('main-content')
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card card-primary">
                <div class="card-header">
                    <i class="fas fa-home"></i> Kamar Kos
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            @if ($pages->count() == 0)
                                <div class="col-md-12 text-center">
                                    <h3>Data kosong</h3>
                                </div>
                            @endif
                            @foreach ($pages->items() as $page)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $page->name }}</h5>
                                            <p class="card-text">
                                                {{ $page->description }}
                                                <br>
                                                <b>Harga:</b> Rp. {{ number_format($page->price) }}
                                            </p>

                                            <form action="{{ route('transaksi.booking', $page) }}" method="post"
                                                onsubmit="return confirm('Apakah anda yakin?')">
                                                @csrf
                                                <button class="btn btn-primary"> Booking </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
