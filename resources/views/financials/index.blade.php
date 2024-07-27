@extends('layouts.app')

@section('content')



<div class="container d-flex gap-6" style="flex-wrap: wrap;">
    @forelse ($members as $member)
        @php
            $latestIncome = $member->incomes->where('status', 'Diterima')->sortByDesc('has_paid_until')->first();
            $hasPaidUntil = $latestIncome ? \Carbon\Carbon::parse($latestIncome->has_paid_until) : null;
        @endphp
        <div class="card" data-tilt style="width: 15rem; flex-shrink: 0">
            <img src="{{ asset('storage/' . $member->photo_profile) }}" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title">{{ $member->name }}</h5>
                <p class="card-text">
                    @if ($hasPaidUntil && $hasPaidUntil->isToday())
                        Telah membayar kas hari ini
                        <br>
                        <strong>{{ $hasPaidUntil->locale('id')->translatedFormat('l, d F Y') }}</strong>
                    @elseif ($hasPaidUntil && $hasPaidUntil->eq(today()->addDay()))
                        Telah membayar kas hari ini dan hari esok
                        <br>
                        <strong>{{ $hasPaidUntil->locale('id')->translatedFormat('l, d F Y') }}</strong>
                    @elseif ($hasPaidUntil && $hasPaidUntil->gte(today()->addDays(2)))
                        Telah membayar kas sampai hari
                        <br>
                        <strong>{{ $hasPaidUntil->locale('id')->translatedFormat('l, d F Y') }}</strong>
                    @else
                        <strong>Belum membayar kas hari ini</strong>
                    @endif
                </p>
                @if (
                    $hasPaidUntil &&
                        ($hasPaidUntil->isToday() || $hasPaidUntil->eq(today()->addDay()) || $hasPaidUntil->gte(today()->addDays(2))))
                    <span class="badge bg-success">Naisu Guachamole</span>
                @else
                    <span class="badge bg-danger">Dibayar dong Guachamole</span>
                @endif
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

    <script>
            
        document.addEventListener('DOMContentLoaded', function() {
            VanillaTilt.init(document.querySelectorAll(".card[data-tilt]"), {
                max: 25,
                speed: 400,
                glare: true,
                "max-glare": 0.5,
            });
        });
    </script>
    
    
@endsection
