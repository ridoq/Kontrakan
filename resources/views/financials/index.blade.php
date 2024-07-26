@extends('layouts.app')

@section('content')
    <div class="container d-flex gap-6" style="flex-wrap: wrap;">
        @forelse ($members as $member)
            @php
                $latestIncome = $member->incomes->sortByDesc('has_paid_until')->first(); // Mendapatkan income terbaru
                $hasPaidUntil = $latestIncome
                    ? \Carbon\Carbon::parse($latestIncome->has_paid_until)->format('d F Y')
                    : 'Belum ada data';
            @endphp
            <div class="card" style="width: 15rem; flex-shrink: 0">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $member->name }}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <a href="#" class="btn btn-primary">{{ $hasPaidUntil }}</a>
                </div>
            </div>
        @empty
            <div class="">no</div>
        @endforelse
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Total Kas</th>
                    <th>Tipe Transaksi</th>
                    <th>Nominal</th>
                    <th>Tanggal Perubahan</th>
                    @hasrole('admin')
                        <th>Aksi</th>
                    @endhasrole
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @forelse ($financials as $index=>$financial)
                    <tr>
                        <th scope="row">
                            {{ $index + 1 + ($financials->currentPage() - 1) * $financials->perPage() }} </th>
                        <td>{{ 'Rp. ' . number_format($financial->amount) }}</td>
                        <td>
                            <span
                                class="badge {{ $financial->transaction_type === 'Pemasukan' ? 'bg-success' : 'bg-warning' }}">{{ $financial->transaction_type }}</span>
                        </td>
                        <td>{{ 'Rp. ' . number_format($financial->nominal) }}</td>
                        <td>{{ $financial->created_at->locale('id')->translatedFormat('l, d F Y | H:i') }}
                        </td>
                        {{-- @hasrole('admin')
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                                            class="ri-more-2-line"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-line me-2"></i>
                                            Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="ri-delete-bin-7-line me-2"></i> Delete</a>
                                    </div>s
                            </td>
                        @endhasrole --}}
                    </tr>
                @empty
                    <tr>
                        <th class="row">Kosong</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
