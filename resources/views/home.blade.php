@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    {!! Form::select('academic_year', $years, null, ['placeholder' => "Choose an Academic Year", 'class' => 'form-control']) !!}

                    <div id="chart" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script>
$(document).ready(function () {

    // Build the chart
    Highcharts.chart('chart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            events: {
                drilldown: function (e) {
                    if (!e.seriesOptions) {
                        var chart = this;
                        var year = $("select[name=academic_year]").val();

                        chart.showLoading('Loading ...');

                        $.ajax({
                            type: "GET",
                            url: "{{ url('/home/drilldown') }}",
                            data: {year: year, name: e.point.name},
                            success: function (data) {
                                chart.addSeriesAsDrilldown(e.point, data['drilldowns']);
                                chart.hideLoading();
                            }
                        }, 'json');
                    }
                }
            }
        },
        title: {
            text: 'Yearly Budget'
        },
        tooltip: {
            pointFormat: '{point.y}: <b>{point.percentage:.1f}%</b>',
            valueDecimals: 2,
            valuePrefix: '$'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: "{point.name}:<br/>${y:,.2f}"
                },
                showInLegend: true
            }
        }
    });


    $("select[name=academic_year]").change(function () {
        var chart = $("#chart").highcharts();

        chart.showLoading('Loading ...');

        chart.setTitle(null, {text: $('select[name=academic_year] option:selected').text()});

        if (chart.series.length > 0)
            chart.series[0].remove(true);

        var year = $(this).val();

        // AJAX call to get pie chart data
        $.ajax({
            type: "GET",
            url: "{{ url('/home/chart') }}",
            data: {year: year},
            success: function (data) {
                chart.addSeries({
                  name: 'Source',
                  colorByPoint: true,
                  data: [{
                      name: 'Assistantships',
                      y: data['assistantships'],
                      drilldown: 'Assistantships'
                  }, {
                      name: 'Tuition Waivers',
                      y: data['waivers'],
                      drilldown: 'Tuition Waivers'
                  }, {
                      name: 'Remaining',
                      y: data['remaining']
                  }]
                });

                chart.hideLoading();
            }
        }, 'json');
    });

});
</script>
@endsection