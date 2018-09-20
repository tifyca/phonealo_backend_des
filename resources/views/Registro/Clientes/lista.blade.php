<table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th  width="20%">Cliente</th>
                    <th  width="15%">Teléfonos</th>
                    <th  width="15%">Email</th>
                    <th  width="25%">Dirección</th>
                    <th  width="15%">Barrio</th>
                    <th  width="15%">Ciudad</th>
                    <th  width="15%">Estatus</th>

                    <th  width="10%"class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody id="clientes-list" name="clientes-list">
                  @foreach($clientes as $Item)           
                     <tr id="cliente{{$Item->id}}">
                      <td width="20%" >{{$Item->nombres}}</td>
                      <td width="15%" >{{$Item->telefono }} / {{ $Item->telefono2}}</td>
                      <td width="15%" >{{$Item->email}}</td>
                      <td width="25%" >{{$Item->direccion}}</td>
                      <td width="15%" >{{$Item->barrio}}</td>
                      <td width="15%" >{{$Item->ciudad}}</td>
                      <?php if ($Item->id_estado==1){ ?>
                      <td width="15%"><?=  'Activo' ?></td>
                      <?php }else{ ?> 
                      <td width="15%"><?='Inactivo' ?></td>
                      <?php } ?> 
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