@extends('layouts.admin')
@section('title', 'Kamar Kos')

@section('main-content')
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card card-primary">
                <div class="card-header">
                    <i class="fas fa-home"></i> Create Kamar Kos
                    <div class="float-right">
                        <a href="{{ route('kamar-kos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('kamar-kos.store') }}" method="post">
                        @csrf
                        @include('kamar-kos.form')
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
