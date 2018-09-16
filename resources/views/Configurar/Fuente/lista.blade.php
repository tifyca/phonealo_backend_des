 <table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th width="45%">Nombre</th>
                    <th width="45%">Estatus</th>
                    <th width="10%" class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody id="fuentes-list" name="fuentes-list">
                   @foreach($fuentes as $fuente)           
                     <tr id="fuente{{$fuente->id}}">
                      <td width="45%">{{$fuente->fuente}}</td>
                <?php if ($fuente->status==1){ ?>
                      <td width="45%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="45%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$fuente->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$fuente->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
              </table>       
               <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $fuentes->render(); ?>
              </div>