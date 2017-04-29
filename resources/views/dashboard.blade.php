@extends('layouts.template')
@section('ext-css')
  <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Participant Answer Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        @foreach ($data as $key)
          <div class="col-md-4">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Pertanyaan No {{$key->number}}</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart{{$key->id}}" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="fa fa-circle-o text-red"></i> Sangat Tidak Setuju</li>
                      <li><i class="fa fa-circle-o text-yellow"></i> Tidak Setuju</li>
                      <li><i class="fa fa-circle-o text-green"></i> Setuju</li>
                      <li><i class="fa fa-circle-o text-aqua"></i> Sangat Setuju</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li>
                    <a href="#"
                    <span class="text-center">{{$key->question}}</span></a>
                  </li>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
          </div>
        @endforeach

      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('ext-js')
  <script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script>
@endsection
@section('js')
  $('#menu-dashboard').addClass('active');
  $(function(){
    var pieOptions = {
      segmentShowStroke: true,
      segmentStrokeColor: "#fff",
      segmentStrokeWidth: 1,
      percentageInnerCutout: 50, // This is 0 for Pie charts
      animationSteps: 100,
      animationEasing: "easeOutBounce",
      animateRotate: true,
      animateScale: false,
      responsive: true,
      maintainAspectRatio: false,
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
      tooltipTemplate: "<%=value %> Orang <%=label%>"
    };

    @foreach ($data as $key)
      @php
        $sts = 0;
        $ts = 0;
        $s = 0;
        $ss = 0;

        foreach ($key->Answer as $row ) {
          if ($row->answer == 1) {
            $sts++;
          }else if ($row->answer == 2) {
            $ts++;
          }else if ($row->answer == 3) {
            $s++;
          }else if ($row->answer == 4) {
            $ss++;
          }
        }

      @endphp
      var pieChartCanvas{{$key->id}} = $("#pieChart{{$key->id}}").get(0).getContext("2d");
      var pieChart{{$key->id}} = new Chart(pieChartCanvas{{$key->id}});
      var PieData{{$key->id}} = [
        {
          value: {{$sts}},
          color: "#f56954",
          highlight: "#f56954",
          label: "Sangat Tidak Setuju"
        },
        {
          value: {{$ts}},
          color: "#f39c12",
          highlight: "#f39c12",
          label: "Tidak Setuju"
        },
        {
          value: {{$s}},
          color: "#00a65a",
          highlight: "#00a65a",
          label: "Setuju"
        },
        {
          value: {{$ss}},
          color: "#00c0ef",
          highlight: "#00c0ef",
          label: "Sangat Setuju"
        }
      ];
      pieChart{{$key->id}}.Doughnut(PieData{{$key->id}}, pieOptions);
    @endforeach
  });
@endsection
