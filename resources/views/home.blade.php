@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <div id="chart" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>

                    {!! Form::model($budget, ['route' => ['budget.update', $budget], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            <!--{!! Form::label('academic_year', 'Chart:', ['class' => 'col-md-4 control-label']) !!}-->

                            <div class="col-md-12">
                                {!! Form::select('academic_year', $years, null, ['placeholder' => "Choose an Academic Year", 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <hr />

                        <div class="form-group{{ $errors->has('academic_year') ? ' has-error' : '' }}">
                            {!! Form::label('academic_year', 'Academic Year:', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::number('academic_year', null, ['disabled' => 'disabled', 'class' => 'form-control disabled']) !!}

                                @if ($errors->has('academic_year'))
                                    <span class="help-block">
                        				<strong>{{ $errors->first('academic_year') }}</strong>
                        			</span>
                        		@endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('budget') ? ' has-error' : '' }}">
                            {!! Form::label('budget', 'Budget:', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::number('budget', null, ['class' => 'form-control']) !!}

                                @if ($errors->has('budget'))
                                    <span class="help-block">
                        				<strong>{{ $errors->first('budget') }}</strong>
                        			</span>
                        		@endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                        <!--academic_year, budget, funding_source_id-->
					{!! Form::close() !!}
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

        // Change the form's action to direct to the correct budget academic_year
        $("form").attr("action", "/home/budget/" + year);

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

        $.ajax({
            type: "GET",
            url: "/home/budget/" + year,
            data: {year: year},
            success: function (data) {
                $("input[name=academic_year").val(data['budget']['academic_year']);
                $("input[name=budget").val(data['budget']['budget']);
            }
        }, 'json');
    }).change();

});
</script>
@endsection