@extends('layouts.app')

@section('content')
    @include('incomes.unloop')
    <div class="col-7" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
        <div class="card bg-warning-subtle">
            <div class="card-header" style="padding: 50px">
                <small class="card-title">Total Uang Kas yang belum dibayar</small>
                <h2 class="mt-5">{{ $outstandingPayment }}</h2>
            </div>
        </div>
    </div>
    <div class="col-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">
        <div class="card bg-success-subtle">
            <div class="card-header" style="padding: 50px">
                <small class="card-title">Total Uang Kas yang sudah Dibayar</small>
                <h2 class="mt-5">{{ 'Rp. ' . number_format($totalIncome) }}</h2>
            </div>
        </div>
    </div>

    <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">
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
                    @yield('btnStore')

                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table">
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
                            <th class="fw-bold"></th>
                            <th class="fw-bold">Status</th>
                            <th class="fw-bold"></th>
                        </tr>
                        {{-- </thead> --}}
                        <tbody class="table-border-bottom-0">

                            @forelse ($incomes as $index=>$income)
                                @include('incomes.loop')
                                <tr>
                                    <th scope="row">
                                        {{ $startingNumber - $index }} </th>
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
                                    <td colspan="2">{{ $income->description }}</td>
                                    <td>
                                        @if ($income->status === 'Pending')
                                            <span class="badge bg-label-warning w-100">{{ $income->status }}</span>
                                        @elseif($income->status === 'Diterima')
                                            <span class="badge bg-label-success w-100">{{ $income->status }}</span>
                                        @elseif($income->status === 'Ditolak')
                                            <span class="badge bg-danger  w-100">{{ $income->status }}</span>
                                        @endif
                                    </td>
                                    @hasrole('admin')
                                        @if ($income->status === 'Pending')
                                            @yield('acc')
                                        @else
                                            @yield('btnEditDelete')
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
    @yield('modalStore')
@endsection
