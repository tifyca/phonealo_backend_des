<table class="table table-hover" id="sampleTable">
              <thead>
                <tr>
                  <th width="35%">Nombre</th>
                  <th width="25%">Departamento</th>
                  <th width="25%">Ciudad</th>
                  <th width="15%" class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody id="barrios-list" name="barrios-list">
             @foreach ($barrios as $item)
                 <tr id="barrios{{$item->id}}"> 
                  <td width="35%">{{ $item->barrio }}</td>
                  <td width="25%">{{ $item->nombre }}</td>
                  <td width="25%">{{ $item->ciudad }}</td>
                  <td width="15%" class="text-center">
                    <div class="btn-group">
                        <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$item->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$item->id}}"><i class="fa fa-lg fa-trash"></i></button> 
                      </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $barrios->render(); ?>
              </div>