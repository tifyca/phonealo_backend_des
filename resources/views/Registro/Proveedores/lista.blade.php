<table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Proveedor</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>País</th>
                    <th>Email</th>
                    <th>RUC</th>
                    <th>Acciones</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($proveedor as $Item)    
                  
                     <tr id="cliente{{$Item->id}}">
                      <td width="20%" >{{$Item->proveedor}}</td>
                      <td width="15%" >{{$Item->telefono}}</td>
                      <td width="25%" >{{$Item->direccion}}</td>
                      <td width="15%" >{{$Item->pais}}</td>
                      <td width="15%" >{{$Item->email}}</td>
                      <td width="15%" >{{$Item->ruc}}</td>
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm " href="Proveedores/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $proveedor->render(); ?>
              </div>