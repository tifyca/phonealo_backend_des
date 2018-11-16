 <?php
 @session_start();
 $id_usuario= $_SESSION["user"];
?>

@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', '')
@section('titulo', 'Lista de Conversión')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back',url('procesar/conversiones'))
@section('display_new','d-none')  @section('link_new', '' ) 
@section('display_edit', 'd-none')    @section('link_edit', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')
              

<div class="row">
  <div class="col-12">
    <div class="tile">
      <h3 class="tile-title">Nombre de la Lista</h3>
      <div class="embed-responsive embed-responsive-21by9">
        <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="tile">
      <div class="row">
        <div class="col-6">
          <h3 class="tile-title text-center text-md-left">Productos de la Lista </h3>
        </div>
        <div class="col-6">
          <div class="row d-flex justify-content-end">
            <div class="form-group col-md-6">
              <input type="date" class="form-control" name="">
            </div>
            <div class="form-group col-md-6">
              <input type="date" class="form-control" name="">
            </div>
          </div>
        </div>
      </div>
        <div class="tile-body ">
          <div class="table-responisve">
            <table class="table">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Vendido (unit)</th>
                  <th>Total venta</th>
                  <th>Utilidad bruta</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($mlista as $item)
                <tr>
                  <td>{{$item->descripcion}}</td>
                  <td>5</td>
                  <td>50000</td>
                  <td>200000</td>
                  <td>
                    <div class="btn-group">
                      <button id=""  class="verGrafica btn btn-primary" title=""><i class="m-0 fa fa-lg fa-bar-chart"></i></button>
                     
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
 
    <div class="col-md-5 d-none" id="grafica">
      <div class="tile">
        <h3 class="tile-title">Comparativa de Ventas</h3>
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
        </div>
          <button class="btn-primary upGrafica">Cancelar</button>
      </div>
    </div>

    
</div>

  

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">

  $('.verGrafica').click(function(event){
    $('#grafica').removeClass('d-none');
 
      var data = {
        labels: ["7 Días", "15 Días", "Mes"],
        datasets: [
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40]
          }
        ]
      };

      

      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart.Line(ctxl,{
  data:data
});

      

 });


  $('.upGrafica').click(function(){
    $('#grafica').addClass('d-none');

  });

var lista=JSON.parse('{{$lista}}'.replace(/&quot;/g,'"'));

lista.forEach(function(e){
console.log(e.codigo_producto);
  



 var data = {
    labels: [e.codigo_producto], //["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
           label: "",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
             borderWidth: 2,
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [20, 09] //[65, 59, 20, 81, 56, 55, 40],
        }
    ]
};
var option = {
  scales: {
  
       
   
    xAxes:[{
     barPercentage: 0.1
       
    }]
  }
};

         var ctxb = $("#barChartDemo").get(0).getContext("2d");
var myBarChart = new  Chart.Bar(ctxb,{
  data:data,
  options:option
});



})

     // var barChart = new Chart(ctxb).Bar(data1);
  
    </script>
  
@endpush