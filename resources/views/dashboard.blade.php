@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-8 ">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mb-6">
        <div class="card">
            <div class="card-header header-elements">
                <div>
                    <h5 class="card-title mb-0">Info Kas</h5>
                    <small class="text-muted">Data Pemasukan dan Pengeluaran</small>
                </div>
                <div class="card-header-elements ms-auto py-0">
                    <h5 class="mb-0 me-4">Rp.{{ number_format($totalIncome, 2) }}</h5>
                    <span class="badge bg-label-secondary rounded-pill">
                        <i class='ri-arrow-up-line ri-14px text-success'></i>
                        <span class="align-middle">{{ number_format($percentageChange, 2) }}%</span>
                    </span>
                </div>
            </div>
            <div class="card-body pt-2">
                <canvas id="lineChart" class="chartjs" data-height="500"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Pemasukan',
                    data: @json($incomes),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Pengeluaran',
                    data: @json($expenses),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Nominal'
                    }
                }
            }
        }
    });
});
</script>
@endsection
