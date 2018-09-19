<table class="table table-hover " id="sampleTable">
                <thead>
                  <tr>
                    <th width="20%">Proveedor</th>
                    <th width="15%">Teléfono</th>
                    <th width="15%">Email</th>
                    <th width="25%"> Dirección</th>
                    <th width="15%">País</th>
                    <th  width="15%" >RUC</th>
                    <th width="15%">Estatus</th>
                    <th  width="10%" class="text-center">Acciones</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($proveedor as $Item)    
                  
                     <tr id="cliente{{$Item->id}}">
                      <td width="20%" >{{$Item->proveedor}}</td>
                      <td width="15%" >{{$Item->telefono}}</td>
                      <td width="15%" >{{$Item->email}}</td>
                      <td width="25%" >{{$Item->direccion}}</td>
                      <td width="15%" >{{$Item->pais}}</td>       
                      <td width="15%" >{{$Item->ruc}}</td>
                       <?php if ($Item->id_estado==1){ ?>
                      <td width="15%"><?=  'Activo' ?></td>
                      <?php }else{ ?> 
                      <td width="15%"><?='Inactivo' ?></td>
                      <?php } ?> 
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <a data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary btn-sm m-0" href="proveedores/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $proveedor->render(); ?>
              </div>