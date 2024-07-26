@extends('dashboard.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title font-weight-bold">Biaya Photobooth sekarang</h5>
            <p class="card-text">
                <button class="btn btn-lg btn-primary">Rp. {{ number_format($biaya->biaya ?? 0, 0, ',', '.') }}</button>
            </p>
            <hr>

            <form action="{{route('dashboard.update-biaya-photobooth')}}" method="POST" class="mt-5">
                @csrf
                <h4 class="font-weight-bold">Edit Biaya Photobooth</h4>
                <input type="hidden" name="id" value="{{ $biaya->id ?? null }} ">
                <div class="form-group">
                    <label for="my-input">Jumlah Biaya</label>
                    <input id="my-input" class="form-control" type="number" name="biaya">
                </div>
                <button class="btn btn-info" type="submit">Perbarui</button>
            </form>
        </div>
    </div>


    <form action=""></form>
@endsection
