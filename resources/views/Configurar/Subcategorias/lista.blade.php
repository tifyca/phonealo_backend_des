  <table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th width="30%">Nombre</th>
                    <th width="30%">Tipo Categoria</th>
                    <th width="30%">Categoria</th>
                    <th width="25%">Estatus</th>
                    <th width="15%" class="text-center">Acciones</th>
                  </tr>
                </thead>
             
                  <tbody id="subcategorias-list" name="subcategorias-list"> 
                  @foreach($subcategorias as $subcategoria)           
                     <tr id="subcategoria{{$subcategoria->id}}">
                      <td width="30%">{{$subcategoria->sub_categoria}}</td>
                      <td width="30%">{{$subcategoria->tipo}}</td>
                      <td width="30%">{{$subcategoria->categoria}}</td>
                <?php if ($subcategoria->status==1){ ?>
                      <td width="25%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="25%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="15%" class="text-center">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$subcategoria->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-primary btn-sm confirm-delete" value="{{$subcategoria->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
                                 
                </tbody>
              </table>
            <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $subcategorias->render(); ?>
              </div>