        <table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Estatus Venta</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
             
                  <tbody id="horas-list" name="horas-list"> 
                 @foreach($horarios as $horario)           
                     <tr id="hora{{$horario->id}}">
                      <td width="30%">{{$horario->horario}}</td>
                <?php if ($horario->status_v==1){ ?>
                      <td width="25%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="25%"><?='Espera' ?></td>
                <?php } ?> 
                <?php if ($horario->status==1){ ?>
                      <td width="25%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="25%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="15%" class="text-center">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$horario->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$horario->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
            <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                     <?php echo $horarios->render(); ?>
              </div>