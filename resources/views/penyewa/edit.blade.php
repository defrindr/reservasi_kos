@extends('layouts.admin')
@section('title', 'Penyewa')

@section('main-content')
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card card-primary">
                <div class="card-header">
                    <i class="fas fa-home"></i> Create Penyewa
                    <div class="float-right">
                        <a href="{{ route('penyewa.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('penyewa.update', $page) }}" method="post">
                        @csrf
                        @method('PUT')
                        @include('penyewa.form')
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
