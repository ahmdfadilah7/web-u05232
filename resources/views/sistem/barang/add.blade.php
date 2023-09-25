@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Barang</h5>
            {!! Form::open(['method' => 'post', 'route' => ['sistem.barang.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group mb-3">
                    <label for="" class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-control">
                        <option value="0">- Pilih -</option>
                        @foreach($kategori as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}">
                    <i class="text-danger">{{ $errors->first('nama_barang') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Foto Barang</label>
                    <input type="file" name="foto_barang" class="form-control">
                    <i class="text-danger">{{ $errors->first('foto_barang') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Harga Barang</label>
                    <input type="number" name="harga_barang" class="form-control" value="{{ old('harga_barang') }}">
                    <i class="text-danger">{{ $errors->first('harga_barang') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Stok Barang</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok') }}">
                    <i class="text-danger">{{ $errors->first('stok') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.barang') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection