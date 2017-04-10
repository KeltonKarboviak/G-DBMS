@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#chart" data-toggle="tab">Chart</a></li>
                        <li><a href="#table" data-toggle="tab">Table</a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- Chart tab contents -->
                        <div id="chart" class="tab-pane fade in active">
                            <div id="chart" style="min-width: 310px; height: 400px; max-width: 800px; margin: 0 auto"></div>
                        </div>

                        <!-- Table tab contents -->
                        <div id="table" class="tab-pane fade">
                            <div class="table-responsive">
                                <table id="budget_table" class="table table-hover">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Source</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="remaining" class="info" data-toggle="collapse" data-target=".collapse_remaining">
                                            <td>Remaining</td><td></td>
                                        </tr>

                                        <tr id="assistantships" class="info" data-toggle="collapse" data-target=".collapse_assistantships">
                                            <td>Assistantships</td><td></td>
                                        </tr>

                                        <tr id="waivers" class="info" data-toggle="collapse" data-target=".collapse_waivers">
                                            <td>Tuition Waivers</td><td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-primary">
                                            <th>Total</th><th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {!! Form::model($budget, ['route' => ['budget.update', $budget], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
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
$(function () {

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

                        function addDrilldownToChart(data) {
                            chart.addSeriesAsDrilldown(e.point, data['drilldowns']);
                            chart.hideLoading();
                        }

                        getDrilldownData(year, e.point.drilldown, addDrilldownToChart);
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
                    format: "{point.name}:<br/>${y:.2f}"
                },
                showInLegend: true
            }
        }
    });

    $("select[name=academic_year]").change(function () {
        var chart = $("#chart").highcharts();
        chart.showLoading('Loading ...');
        chart.setTitle(null, {text: $('select[name=academic_year] option:selected').text()});

        while (chart.series.length > 0)
            chart.series[0].remove(true);

        // Get the budget table's major row elements
        var $major_rows = $('#budget_table > tbody > tr[id]');

        // Empty each of the dollar amounts <td>'s from the major rows
        $major_rows.children('td:last-child').html('');

        // Detach all the collapsible <tr>'s
        $major_rows.nextUntil('tr[id]').detach();

        // Empty the total amount in the table footer
        var $td_total = $('#budget_table > tfoot > tr > th:last-child').html('');

        var year = $(this).val();

        // Change the form's action to direct to the correct budget academic_year
        $("form").attr("action", "/home/budget/" + year);

        // AJAX call to get pie chart data
        $.ajax({
            dataType: "json",
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
                        drilldown: 'assistantships'
                    }, {
                        name: 'Tuition Waivers',
                        y: data['waivers'],
                        drilldown: 'waivers'
                    }, {
                        name: 'Remaining',
                        y: data['remaining']
                    }]
                });

                chart.hideLoading();

                $major_rows.each(function (idx) {
                    // Change the major_row's total
                    var $row = $(this);
                    $row.children('td:last-child').html(data[this.id].formatMoney(2));

                    function addDrilldownToTable(students_data) {
                        var $sub_rows = students_data['drilldowns']['data'].map(function (datum) {
                            // datum == [student_name, dollar_amount]
                            return $('<tr/>', {
                                'class': 'panel-collapse collapse collapse_' + $row.attr('id'),
                                html: '<td>' + datum[0] + '</td><td>' + datum[1].formatMoney(2) + '</td>'
                            });
                        });

                        $row.after($sub_rows);
                    }

                    getDrilldownData(year, this.id, addDrilldownToTable);
                });

                // Change total amount
                $td_total.html(data['budget'].formatMoney(2));
            }
        });

        // AJAX call to fill-in the input fields with the selected budget information
        $.ajax({
            dataType: "json",
            type: "GET",
            url: "/home/budget/" + year,
            data: {year: year},
            success: function (data) {
                $("input[name=academic_year").val(data['budget']['academic_year']);
                $("input[name=budget").val(data['budget']['budget']);
            }
        });
    }).change();

});

function getDrilldownData(year, drilldown_name, success_callback) {
    $.ajax({
        dataType: "json",
        type: "GET",
        url: "{{ url('/home/drilldown') }}",
        data: {year: year, name: drilldown_name},
        success: success_callback
    });
}
</script>
@endsection