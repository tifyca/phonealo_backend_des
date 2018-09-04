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
                      <button class="btn btn-primary open_modal" value="{{$cargo->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button class="btn btn-primary confirm-delete" value="{{$cargo->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $cargos->render(); ?>
              </div>