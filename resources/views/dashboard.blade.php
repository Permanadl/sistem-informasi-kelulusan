@extends('layouts.app')

@section('content')
<div class="row mb-4">
    @foreach ($jurusan as $item)
    <div class="col-md-4">
        <div class="card">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="mb-0">{{ $item->siswa_count }}</h1>
                    <p class="text-muted font-small-1 mb-0">Siswa sudah lulus</p>
                </div>
                <div class="card-footer">
                    <h6>{{ $item->nama_jurusan }}</h6>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Grafik Kelulusan
            </div>
            <div class="card-body">
                <canvas height="150px" id="grafik-kelulusan"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                Grafik Siswa Mengecek Kelulusan
            </div>
            <div class="card-body">
                <canvas height="150px" id="grafik-dilihat"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('vendors')
<script src="{{ asset('') }}assets/vendor/libs/chartjs/chart.min.js"></script>
<script src="{{ asset('') }}assets/vendor/libs/chartjs/chartjs-plugin-datalabels.min.js"></script>
@endpush

@push('js')
<script>
    'use strict'

    var dashboardJs = function(){
        Chart.register(ChartDataLabels)

        $(document).ready(function(){
            handleAjax(`{{ route('dashboard.chart') }}`)
            .onSuccess((response)=>{
                var canvas = $('#grafik-kelulusan')
                const data_kelulusan = response.jumlah_lulusan

                var data = [], labels = []
                for (const [key, jumlah] of Object.entries(data_kelulusan)) {
                    data.push(jumlah)
                    labels.push(key)
                }
                renderLineChart(canvas, labels, data)

                var canvas = $('#grafik-dilihat')
                const data_dilihat = response.jumlah_dilihat

                var data = [], labels = []
                for (const [key, jumlah] of Object.entries(data_dilihat)) {
                    data.push(jumlah)
                    labels.push(key)
                }
                renderLineChart(canvas, labels, data)
            })
            .execute()
        })

        function renderLineChart(elem, labels, data){
            if (elem.length) {
                var lineChart = new Chart(elem, {
                    type: 'line',
                    options: {
                        interaction: {mode: 'index',intersect: false},
                        responsive: true,
                        scales: {
                            x: {grid: {display: false}, weight: 1},
                            y: {min: 0, ticks: {stepSize: 20}}
                        },
                        legend: {
                            position: 'top',
                            align: 'start',
                            labels: {usePointStyle: true, padding: 25, boxWidth: 9}
                        },
                        plugins: {
                            datalabels: {
                                backgroundColor: function(ctx){
                                    return ctx.active ? ctx.dataset.backgroundColor : 'white'
                                },
                                borderColor: function(ctx){
                                    return ctx.dataset.backgroundColor
                                },
                                borderRadius: function(ctx){
                                    return ctx.active ? 0 : 32
                                },
                                borderWidth: 3,
                                color: function(ctx){
                                    return ctx.active ? 'white' : ctx.dataset.backgroundColor
                                },
                                font: {weight: 'bold'},
                                offset: 8,
                                padding: 5,
                                textAlign: 'center'
                            }
                        }
                    },
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah',
                            data: data,
                            backgroundColor: '#7367F0',
                            borderColor: '#7367F0',
                            lineTension: 0,
                            pointStyle: 'circle',
                            pointRadius: 4,
                            pointHoverRadius: 5,
                            pointHoverBorderWidth: 5,
                            pointBorderColor: '#7367F0',
                            pointBackgroundColor: '#FFFFFF',
                            pointBorderWidth: 2,
                            pointHoverBorderColor: '#7367F0',
                            pointHoverBackgroundColor: '#7367F0',
                            pointShadowBlur: 5,
                        }]
                    }
                })
            }
        }
    }()
</script>
@endpush
