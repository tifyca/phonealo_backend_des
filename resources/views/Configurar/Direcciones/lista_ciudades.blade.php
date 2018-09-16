<table class="table table-hover" id="sampleTable">
              <thead>
                <tr>
                  <th width="45%">Nombre</th>
                  <th width="45%">Departamento</th>
                  <th width="10%" class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody id="ciudades-list" name="ciudades-list">
              @foreach ($ciudades as $item)
                 <tr id="ciudades{{$item->id}}"> 
                  <td width="45%">{{ $item->ciudad }}</td>
                  <td width="45%">{{ $item->nombre }}</td>
                  <td width="10%" class="text-center">
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
                    <?php echo $ciudades->render(); ?>
              </div>