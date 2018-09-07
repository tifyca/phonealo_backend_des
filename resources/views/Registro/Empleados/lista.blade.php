              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="empleados-list" name="empleados-list">
                  @foreach($empleados as $Item)    
                  
                     <tr id="empleado{{$Item->id}}">
                      <td width="20%" >{{$Item->nombres}}</td>
                      <td width="15%" >{{$Item->telefono}}</td>
                      <td width="25%" >{{$Item->email}}</td>
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <a class="btn btn-primary" href="empleados/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                 
                     <a class="btn btn-primary"  href="empleados/delete/{{$Item->id}}" ><i class="fa fa-lg fa-trash"></i></a>
                           
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $empleados->render(); ?>
              </div>