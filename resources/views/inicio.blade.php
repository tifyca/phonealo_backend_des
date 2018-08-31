@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-home')
@section('titulo', 'Inicio')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', 'd-none') @section('link_back', '')
@section('display_new','d-none')  @section('link_edit', '')
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Ventas en los últimos meses</h3>
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Ventas en la semana</h3>
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="lineChartDemo2"></canvas>
        </div>
      </div>
    </div>

  </div>
   
  <div class="row">
    <div class="col-md-3">
      <div class="widget-small primary"><i class="icon fa fa-money fa-3x"></i>
        <div class="info">
          <h4>Cobrado</h4>
          <p><b>8.017.000 Gs.</b></p>
        </div>
      </div>
    </div>
     <div class="col-md-3">
      <div class="widget-small info"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
        <div class="info">
          <h4>Recibido:</h4>
          <p><b>0 Gs.</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="widget-small danger "><i class="icon fa fa-thumbs-o-down fa-3x"></i>
        <div class="info">
          <h4>Devuelto: </h4>
          <p><b>0 Gs.</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="widget-small warning "><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Gastos del día: .</h4>
          <p><b>0 Gs</b></p>
        </div>
      </div>
    </div>
    
    
    <div class="col-md-3">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-area-chart fa-3x"></i>
        <div class="info">
          <h4>Costos: </h4>
          <p><b>0 Gs.</b></p>
        </div>
      </div>
    </div>
        
        <div class="col-md-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-thumbs-down fa-3x"></i>
            <div class="info">
              <h4>Rechazado: </h4>
              <p><b>0 Gs.</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-dropbox fa-3x"></i>
            <div class="info">
              <h4>Delivery: </h4>
              <p><b>1.138.000 Gs.</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-question fa-3x"></i>
        <div class="info">
          <h4>Faltantes: </h4>
          <p><b>0</b></p>
        </div>
      </div>
    </div>
        
  </div>
  <div class="tile">
        <h3 class="tile-title">Listado de Remitos</h3>
        <div class="tile-body ">
          <div class="tile-body">
  <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Remito</th>
                    <th>Delivery</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0987</td>
                    <td>Nombres</td>
                    <td>9876234</td>
                    <td>00-00-0000</td>
                    <td>Confirmado</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-check"></i></a>
                        
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>0987</td>
                    <td>Nombres</td>
                    <td>9876234</td>
                    <td>00-00-0000</td>
                    <td>Confirmado</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-check"></i></a>
                        
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>0987</td>
                    <td>Nombres</td>
                    <td>9876234</td>
                    <td>00-00-0000</td>
                    <td>Confirmado</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-eye"></i></a>
                        <a class="btn btn-primary" href="#"><i class="m-0 fa fa-lg fa-check"></i></a>
                        
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div></div></div>
@endsection

@push('scripts')
 <script type="text/javascript">
      var data = {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo"],
        datasets: [
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86]
          }
        ]
      };

      var data2 = {
        labels: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"],
        datasets: [
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [70, 30, 10, 50, 100]
          }
        ]
      };

      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);

      var ctxl2 = $("#lineChartDemo2").get(0).getContext("2d");
      var lineChart2 = new Chart(ctxl2).Line(data2);
  
    </script>

@endpush
