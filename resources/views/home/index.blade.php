@extends('layout.app_layout')


@section("content")

    <div id="piechart_3d" style="width: 1200px; height: 700px;"></div>





@endsection

@section('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                  @foreach($data as $key => $value)
                    @php
                    if($value->quantity < 0){$value->quantity = 0;}
                    @endphp
                ['{{$value->title}}',     {{$value->quantity}}],
                  @endforeach
            ]);

            var options = {
                title: 'Total Available Stocks',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>


@endsection