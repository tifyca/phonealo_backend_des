<table class="table table-hover" id="sampleTable">
          <thead>
            <tr>
              <th width="30%">Id</th>
              <th width="30%">Monto</th>
              <th width="15%" class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody id="categorias-list" name="categorias-list"> 
            @foreach($montos_delivery as $montos)           
            <tr id="categoria{{$montos->id}}">
              <td width="30%">{{$montos->id}}</td>
              <td width="30%">{{$montos->monto}}</td>
            </tr>
            @endforeach

          </tbody>
        </table>       

        <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
          <?php echo $montos_delivery->render(); ?>
        </div>