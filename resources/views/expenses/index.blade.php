@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            <div class="card-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                <h3 class="card-title">Data Pengeluaran</h3>
            </div>
            <div class="card-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
                <div class="d-flex justify-content-between py-0 mb-4">
                    <form action="" method="GET" class="d-flex w-50 me-4">
                        @csrf
                        <div class="d-flex align-items-center border rounded px-3 w-100" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">
                            <input type="text" name="search" class="form-control border-none" 
                                value="{{ request()->input('search') }}" placeholder="Cari data ...">
                            <a class="btn-close cursor-pointer" href="{{ route('members') }}"></a>
                        </div>
                    </form>
                    @hasrole('admin')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">
                            Buat Pengeluaran
                        </button>
                    @endhasrole
                </div>
               
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengguna</th>
                                <th>Nominal</th>
                                <th>Tanggal Pengeluaran</th>
                                <th>Description</th>
                                @hasrole('admin')
                                    <th>Aksi</th>
                                @endhasrole
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @forelse ($expenses as $index=>$expense)
                                <tr>
                                    <th scope="row">
                                        {{ $index + 1 + ($expenses->currentPage() - 1) * $expenses->perPage() }} </th>
                                    <td>{{ $expense->users->name }}</td>
                                    <td>{{ 'Rp. ' . number_format($expense->amount) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($expense->expense_date)->locale('id')->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td>{{ $expense->description }}</td>
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
                {{ $expenses->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nama Pengguna:</label>
                        <input type="text" disabled class="form-control" id="recipient-name"
                            value="{{ Auth::user()->name }}">
                        <input type="hidden" class="form-control" id="recipient-name" name="user_id"
                            value="{{ Auth::user()->id }}">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nominal Pengeluaran:</label>
                        <input type="number" class="form-control" id="recipient-name" name="amount">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tanggal Pengeluaran:</label>
                        <input type="date" class="form-control" id="recipient-name" name="expense_date">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Description: (Optional)</label>
                        <input type="text" class="form-control" id="recipient-name" name="description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Data Pengeluaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
