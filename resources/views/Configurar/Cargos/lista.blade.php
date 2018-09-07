<table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="cargos-list" name="cargos-list">
                  @foreach($cargos as $cargo)           
                     <tr id="cargo{{$cargo->id}}">
                      <td width="45%">{{$cargo->cargo}}</td>
                <?php if ($cargo->status==1){ ?>
                      <td width="45%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="45%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="10%" class="text-right">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$cargo->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$cargo->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $cargos->render(); ?>
              </div>