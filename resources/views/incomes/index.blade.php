@extends('layouts.app')

@section('content')
    <div class="col-7">
        <div class="card bg-warning-subtle">
            <div class="card-header" style="padding: 50px">
                <small class="card-title">Total Uang Kas yang belum dibayar</small>
                <h2 class="mt-5">{{ $outstandingPayment }}</h2>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card bg-success-subtle">
            <div class="card-header" style="padding: 50px">
                <small class="card-title">Total Uang Kas yang sudah Dibayar</small>
                <h2 class="mt-5">{{ 'Rp. ' . number_format($totalIncome) }}</h2>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header" style="padding: 50px 50px 0px 50px">
                <h3 class="card-title">History pembayaran</h3>
            </div>
            <div class="card-body" style="padding: 50px">
                <div class="d-flex justify-content-between py-0 " style="margin-bottom: ">
                    <form action="" method="GET" class="d-flex w-50 me-4">
                        @csrf
                        <div class="d-flex align-items-center border rounded px-3 w-100 shadow-sm">
                            <input type="text" name="search" class="form-control border-none"
                                value="{{ request()->input('search') }}" placeholder="Cari data ...">
                            @if (request()->input('search'))
                                <a class="btn-close cursor-pointer" href="{{ route('incomes') }}"></a>
                            @endif
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Bayar Kas
                    </button>
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
                            <div class="modal-body">
                                <div class="row">
                                    <form action="{{ route('incomes.store') }}" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        @hasrole('member')
                                            <div class="col-12 mb-5 mt-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline " >
                                                        <input type="hidden" class="form-control" id="basic-addon11"
                                                            placeholder="Example: Jhon Doe" aria-label="Username"
                                                            aria-describedby="basic-addon11" name="user_id"
                                                            value="{{ Auth::user()->id }}" />
                                                        <input type="text" class=" form-control "  style="color: rgb(45, 45, 45)" id="basic-addon11"
                                                            placeholder="Example: Jhon Doe" aria-label="Username"
                                                            aria-describedby="basic-addon11" value="{{ Auth::user()->name }}"
                                                            disabled />
                                                        <label for="basic-addon11">Nama Pembayar:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endhasrole
                                        @hasrole('admin')
                                            <div class="col-12 mb-5 mt-3">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <select name="user_id" class="form-select">
                                                            <option hidden>Pilih Member</option>
                                                            @forelse ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @empty
                                                            <option>Tidak ada member</option>
                                                            @endforelse
                                                        </select>
                                                        <label for="basic-addon11">Nama Pembayar:</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endhasrole
                                        <div class="col-12 mb-5 mt-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="file" class="form-control" id="basic-addon11"
                                                        name="payment_proof" />
                                                    <label for="basic-addon11">Bukti Pembayaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-5 mt-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <select name="amount" id="" class="form-select">
                                                        <option value="15000" selected>Rp. 15,000</option>
                                                        <option value="30000">Rp. 30,000</option>
                                                        <option value="45000">Rp. 45,000</option>
                                                        <option value="60000">Rp. 60,000</option>
                                                        <option value="75000">Rp. 75,000</option>
                                                        <option value="90000">Rp. 90,000</option>
                                                        <option value="105000">Rp. 105,000</option>
                                                    </select>
                                                    <label for="basic-addon11">Total bayar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-5 mt-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="date" name="income_date"
                                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        class="form-control">
                                                    <label for="basic-addon11">Tanggal Pembayaran</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-5 mt-3">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea name="description" class="form-control" style="resize: none;height: 150px;" id=""
                                                        placeholder="Masukkan Deskripsi pembayaran"></textarea>
                                                    <label for="basic-addon11">Deskripsi (Opsional)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-5 d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary me-2"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap " style="padding-top: 40px">
                    <table class="table ">
                        {{-- <thead > --}}
                        <tr style="height: 70px;">
                            <th class="fw-bold">No</th>
                            <th class="fw-bold">Bukti Pembayaran</th>
                            @hasrole('admin')
                                <th class="fw-bold">Nama Pembayar</th>
                            @endhasrole
                            <th class="fw-bold">Total</th>
                            <th class="fw-bold">Tanggal Pembayaran</th>
                            <th class="fw-bold">Description</th>
                            <th class="fw-bold">Status</th>
                            <th class="fw-bold"></th>
                        </tr>
                        {{-- </thead> --}}
                        <tbody class="table-border-bottom-0">

                            @forelse ($incomes as $index=>$income)
                                <tr>
                                    <th scope="row">
                                        {{ $index + 1 + ($incomes->currentPage() - 1) * $incomes->perPage() }} </th>
                                    <td>
                                        <img style="width: 120px;box-shadow: 0px 0px 10px rgba(0,0,0,.2)"
                                            src="{{ asset('storage/' . $income->payment_proof) }}" alt="error">
                                    </td>
                                    @hasrole('admin')
                                        <td>{{ $income->users->name }}</td>
                                    @endhasrole
                                    <td>{{ 'Rp. ' . number_format($income->amount) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($income->income_date)->locale('id')->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td>{{ $income->description }}</td>
                                    <td>
                                        @if ($income->status === 'Pending')
                                            <span class="badge bg-warning w-100">{{ $income->status }}</span>
                                        @elseif($income->status === 'Diterima')
                                            <span class="badge bg-success w-100">{{ $income->status }}</span>
                                        @elseif($income->status === 'Ditolak')
                                            <span class="badge bg-danger  w-100">{{ $income->status }}</span>
                                        @endif
                                    </td>
                                    @hasrole('admin')
                                        @if ($income->status === 'Pending')
                                            <td>
                                                <form action="{{ route('incomes.accept', $income->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary"
                                                        type="button">Verifikasi</button>
                                                </form>
                                                <form action="{{ route('incomes.reject', $income->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"
                                                        type="button">Reject</button>
                                                </form>
                                            </td>
                                        @else
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
                                        @endif
                                    @endhasrole
                                    @hasrole('member')
                                        @if ($income->status === 'Pending')
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></button>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('incomes.cancel', $income->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item"><i
                                                                    class="ri-close-circle-line me-2"></i>Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                            </td>
                                        @endif
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
