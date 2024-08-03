@extends('dashboard.layout')
@section('title', 'Voucher')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title font-weight-bold">Voucher Tersedia</h5>


            <form action="{{route('dashboard.voucher-store')}}" method="POST" class="mt-5">
                @csrf
                <h4 class="font-weight-bold">Tambah Voucher</h4>
                <div class="form-group">
                    <label for="my-input">Jumlah voucher (satuan)</label>
                    <input id="my-input" class="form-control" type="number" name="qty" required>
                </div>
                <div class="form-group">
                    <label for="my-input">Tanggal Kadaluarsa</label>
                    <input id="my-input" class="form-control" type="date" name="kadaluarsa">
                </div>
                <button class="btn btn-info" type="submit">Tambahakan</button>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-light align-middle">
                    <thead class="table-dark">
                        <caption>
                            Data Voucher
                        </caption>
                        <tr>
                            <th>#</th>
                            <th>Kode Voucher</th>
                            <th>Tanggal Kadaluarasa</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($data as $voucher)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{$voucher->code}}</td>
                            <td>{{$voucher->expires_at}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>


        </div>
    </div>


    <form action=""></form>
@endsection
