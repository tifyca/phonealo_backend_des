              <table class="table table-hover " id="sampleTable">
                <thead>
                  <tr>
                    <th width="30%">Nombre</th>
                    <th width="20%">Teléfono</th>
                    <th width="30%">Email</th>
                    <th width="20%">Estatus</th>
                    <th width="10%" class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody id="empleados-list" name="empleados-list">
                  @foreach($empleados as $Item)    
                  
                     <tr id="empleado{{$Item->id}}">
                      <td width="30%" >{{$Item->nombres}}</td>
                      <td width="20%" >{{$Item->telefono}}</td>
                      <td width="30%" >{{$Item->email}}</td>
                      <?php if ($Item->id_estado==1){ ?>
                      <td width="20%"><?=  'Activo' ?></td>
                      <?php }else{ ?> 
                      <td width="20%"><?='Inactivo' ?></td>
                      <?php } ?> 
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                       <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm" href="empleados/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                         <!--button  data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$Item->id}}"  type="button"><i class="fa fa-lg fa-trash"></i></button-->   
                           
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $empleados->render(); ?>
              </div>