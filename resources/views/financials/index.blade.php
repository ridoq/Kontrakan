@extends('layouts.app')

<style>
    .swiper-slide {
        width: auto;
        max-width: 300px;
        margin: 0 10px;
    }

    .swiper-container {
        margin-top: 20px;
        width: 1405px;
        overflow: hidden;
        position: relative;
        /* Tambahkan ini untuk memastikan tombol navigasi berada di posisi yang benar */
    }

    .card {
        width: 100%;
        max-width: none;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #000;
        /* Sesuaikan warna tombol navigasi jika diperlukan */
    }

    .swiper-pagination {
        position: absolute;
        bottom: 10px;
        /* Sesuaikan posisi pagination */
        width: 100%;
        text-align: center;
    }

    .swiper-button-next,
    .swiper-button-prev {
        top: 50%;
        /* Posisi vertikal tombol navigasi di tengah swiper */
        transform: translateY(-50%);
    }
</style>

@section('content')
    <div class="container" style="margin-bottom: 30px;">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @forelse ($members as $index => $member)
                    @php
                        $latestIncome = $member->incomes
                            ->where('status', 'Diterima')
                            ->sortByDesc('has_paid_until')
                            ->first();
                        $hasPaidUntil = $latestIncome ? \Carbon\Carbon::parse($latestIncome->has_paid_until) : null;
                    @endphp
                    <div class="swiper-slide" style="">
                        <div class="card" style="width: 15rem; flex-shrink: 0; margin-bottom:20px;" data-aos="fade-up"
                            data-aos-duration="1000" data-aos-delay="{{ $index * 200 }}" data-tilt>
                            <img src="{{ asset('storage/' . $member->photo_profile) }}" class="card-img-top" alt="..."
                                style="width: 240px; height: 250px;">
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
                    </div>
                @empty
                    <div class="swiper-slide">No data</div>
                @endforelse
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="card m-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1100">
        <div class="card-header" style="padding: 50px 50px 0px 50px">
            <h3 class="card-title">Info Kas</h3>
        </div>

        <div class="card-body" style="padding: 30px">
            <div class="table-responsive text-nowrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1200">
                <table class="table">
                    <thead>
                        <tr style="height: 70px;">
                            <th class="fw-bold">No</th>
                            <th class="fw-bold">Total Kas</th>
                            <th class="fw-bold">Tipe Transaksi</th>
                            <th class="fw-bold">Nominal</th>
                            <th class="fw-bold">Tanggal Perubahan</th>
                            @hasrole('admin')
                                <th class="fw-bold">Aksi</th>
                            @endhasrole
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($financials as $index => $financial)
                            <tr>
                                <th scope="row">
                                    {{ $startingNumber - $index }}</th>
                                <td>{{ 'Rp. ' . number_format($financial->amount) }}</td>
                                <td>
                                    <span
                                        class="badge {{ $financial->transaction_type === 'Pemasukan' ? 'bg-label-success' : 'bg-label-danger' }}">{{ $financial->transaction_type }}</span>
                                </td>
                                <td>{{ 'Rp. ' . number_format($financial->nominal) }}</td>
                                <td>{{ $financial->created_at->locale('id')->translatedFormat('l, d F Y | H:i') }}</td>
                                {{-- @hasrole('admin')
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ri-more-2-line"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="ri-pencil-line me-2"></i>Edit
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="ri-delete-bin-7-line me-2"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                @endhasrole --}}
                            </tr>
                        @empty
                            <tr>
                                <th class="row fw-bold">Kosong</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $financials->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true
            });

            VanillaTilt.init(document.querySelectorAll(".card[data-tilt]"), {
                max: 25,
                speed: 400,
                glare: true,
                "max-glare": 0.5,
            });

            const swiper = new Swiper('.swiper-container', {
                loop: false,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 1000,
                    disableOnInteraction: false,
                },
                slidesPerView: 5,
                spaceBetween: 10,

            });

            document.querySelector('.swiper-container').addEventListener('mouseenter', function() {
                swiper.autoplay.stop();
            });

            document.querySelector('.swiper-container').addEventListener('mouseleave', function() {
                swiper.autoplay.start();
            });

        });
    </script>
@endsection
