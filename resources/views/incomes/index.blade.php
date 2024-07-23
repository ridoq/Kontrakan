@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kas</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between py-0 mb-4">
                    <form action="" method="GET" class="d-flex w-50 me-4">
                        @csrf
                        <div class="d-flex align-items-center border rounded px-3 w-100">
                            <input type="text" name="search" class="form-control border-none"
                                value="{{ request()->input('search') }}" placeholder="Cari data ...">
                            <a class="btn-close cursor-pointer" href="{{ route('members') }}"></a>
                        </div>
                    </form>
                    @hasrole('member')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data
                        </button>
                    @endhasrole
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bayar Kas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('incomes.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Bukti Pembayaran:</label>
                                        <input type="file" class="form-control" id="recipient-name" name="payment_proof">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama Pembayar:</label>
                                        <input type="text" disabled class="form-control" id="recipient-name"
                                            value="{{ Auth::user()->name }}">
                                        <input type="hidden" class="form-control" id="recipient-name" name="user_id"
                                            value="{{ Auth::user()->id }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Total Bayar:</label>
                                        <input type="number" class="form-control" id="recipient-name" name="amount">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Tanggal Pembayaran:</label>
                                        <input type="date" class="form-control" id="recipient-name" name="income_date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Description: (Optional)</label>
                                        <input type="text" class="form-control" id="recipient-name" name="description">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bukti Pembayaran</th>
                                <th>Nama Pembayar</th>
                                <th>Total</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Description</th>
                                @hasrole('admin')
                                    <th>Aksi</th>
                                @endhasrole
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @forelse ($incomes as $index=>$income)
                                <tr>
                                    <th scope="row">
                                        {{ $index + 1 + ($incomes->currentPage() - 1) * $incomes->perPage() }} </th>
                                    <td>
                                        <img style="width: 200px" src="{{ asset('storage/' . $income->payment_proof) }}"
                                            alt="error">
                                    </td>
                                    <td>{{ $income->users->name }}</td>
                                    <td>{{ $income->amount }}</td>
                                    <td>{{ $income->income_date }}</td>
                                    <td>{{ $income->description }}</td>
                                    @hasrole('admin')
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="ri-pencil-line me-2"></i> Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="ri-delete-bin-7-line me-2"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    @endhasrole
                                </tr>
                            @empty
                                <tr>
                                    <th class="row">Kosong</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $incomes->links() }}
            </div>
        </div>
    </div>
@endsection
