<table class="table table-hover" id="sampleTable">
          <thead>
            <tr>
              <th width="30%">Nombre</th>
              <th width="30%">Tipo</th>
              <th width="25%">Estatus</th>
              <th width="15%" class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody id="categorias-list" name="categorias-list"> 
            @foreach($categorias as $categoria)           
            <tr id="categoria{{$categoria->id}}">
              <td width="30%">{{$categoria->categoria}}</td>
              <td width="30%">{{$categoria->tipo}}</td>
              <?php if ($categoria->status==1){ ?>
              <td width="25%"><?=  'Activo' ?></td>
              <?php }else{ ?> 
              <td width="25%"><?='Inactivo' ?></td>
              <?php } ?> 
              <td width="15%" class="text-center">
                <div class="btn-group">
                  <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$categoria->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                  <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$categoria->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                </div>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>       

        <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
          <?php echo $categorias->render(); ?>
        </div>