<table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="clientes-list" name="clientes-list">
                  @foreach($clientes as $Item)           
                     <tr id="cliente{{$Item->id}}">
                      <td width="20%" >{{$Item->nombres}}</td>
                      <td width="15%" >{{$Item->telefono}}</td>
                      <td width="25%" >{{$Item->direccion}}</td>
                      <td width="15%" >{{$Item->barrio}}</td>
                      <td width="15%" >{{$Item->ciudad}}</td>
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="clientes/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                      @if(empty($Item->ubicacion)) 
                      <a class="btn btn-primary"  style="pointer-events: none; cursor: default; opacity: .6"  ><i class="fa fa-lg fa-globe"></i></a>
                      @else
                      <a class="btn btn-primary"  href="clientes/gmaps/{{$Item->ubicacion}}" ><i class="fa fa-lg fa-globe"></i></a>
                      @endif                     
                      </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $clientes->render(); ?>
              </div>