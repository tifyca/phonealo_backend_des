<table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Email</th>
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
                      <td width="15%" >{{$Item->email}}</td>
                      <td width="25%" >{{$Item->direccion}}</td>
                      <td width="15%" >{{$Item->barrio}}</td>
                      <td width="15%" >{{$Item->ciudad}}</td>
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-primary btn-sm m-0" href="clientes/editar/{{$Item->id}}"><i class="fa fa-lg fa-eye"></i></a>
                      @if(empty($Item->ubicacion)) 
                      <a data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm m-0 disabled-btn" ><i class="fa fa-lg fa-globe"></i></a>
                      @else
                      <a data-toggle="tooltip" data-placement="top" title="Mapa" class="btn btn-primary btn-sm m-0"  href="clientes/gmaps/{{$Item->ubicacion}}" ><i class="fa fa-lg fa-globe"></i></a>
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