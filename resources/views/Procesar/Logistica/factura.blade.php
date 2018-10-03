<!DOCTYPE html>
<html lang="en">
  <head>
<title>Factura</title>
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   
     <style type="text/css" media="all">
     input, input:hover, input:focus, input:active {
      background: transparent;
      outline: none;
      border: 0;
      border-style: none;
      border-color: transparent;
      outline-offset: 0;
      box-shadow: none;
      font-size: 14px;
      }
      body{
        margin-left: 5px;
        font-weight: bold;
      }
      @media print{
        @page {
    size: 210mm 297mm; /* portrait */
    /* you can also specify margins here: */
    margin: 8mm;
    margin-bottom: 0mm;
  }
        #heather{
        width:1100px;
        height:155px;
        vertical-align: center;
      }
      #cabeza{
        border: 0;
        width:1030px;
        height:180px;
        float: left;
        margin-left: 50px;
        font-weight: bold;
        font-size: 16px;
      }
      #indi{
        float: left;
        font-weight: bold;
        font-size: 16px;
      }
      #indid{
        float: left;
        font-weight: bold;
        font-size: 16px;
      }
      #cabeza, #lado{
        display: inline-block;  
      }
      #registros_table{
        padding-top: 5px;
        float: left;
        font-family: "Arial", sans-serif;
        font-size: 16px;
        width:950px;
        height: 565px;
        padding-left: 50px;
      }
      #cantidad{
        width: 40px;
        text-align: left;
      }
      #producto{
        width: 600px;
      }
      #precio{
        width: 150px;
        text-align: left;
      }
      #importe{
        float: right;
      }
      #venta{
        display: none;
      }
      #divisorio{
        width: 1100px;
        height: 835px;
      }
      #cabezad{
        border: 0;
        width:1030px;
        height:180px;
        float: left;
        font-size: 16px;
        margin-left: 50px;
        font-weight: bold;
      }
      #ladod{
        text-align: left;
        width:100px;
        height:155px;
        float: left;
        font-weight: bold;
      }
      #cabezad, #ladod{
        display: inline-block;     
      }
      #registros_tabled{
        padding-top: 5px;
        float: left;
        font-family: "Arial", sans-serif;
        font-size: 16px;
        width:950px;
        height: 565px;
        padding-left: 55px;
      }
      }
      
      </style>

</head>
<body>


      @foreach($venta as $item)  
      <br><br><br><br><br>

<tr>
 <td  style="padding-left:5px; padding-top: 2px; font-size: 12px;" id="nom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->nombres}}</td>
<td  style="padding-left:5px; padding-top: 2px; font-size: 12px;"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X
</tr>
<tr>
  <td  style="padding-left:5px; padding-top: 2px; font-size: 12px;"  id="telefono">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->telefono}}</td>
  <td type="text" style="padding-top: 5px; font-size: 12px;" id="ruc" size="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->ruc_ci}}
   </td>
</tr>
<tr>
  <td style="padding-left:5px; padding-top: 5px; font-size: 12px;"  id="dir">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->direccion}}</td>
  <td></td>
</tr>
  </table>
  <br>
  @endforeach

{{--/////////////////////////////////////////////////////////////////////////////////////--}}



</body>

    

</html>