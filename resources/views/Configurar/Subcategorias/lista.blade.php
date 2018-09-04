  <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
             
                  <tbody id="subcategorias-list" name="subcategorias-list"> 
                  @foreach($subcategorias as $subcategoria)           
                     <tr id="subcategoria{{$subcategoria->id}}">
                      <td width="30%">{{$subcategoria->sub_categoria}}</td>
                      <td width="30%">{{$subcategoria->categoria}}</td>
                <?php if ($subcategoria->status==1){ ?>
                      <td width="25%"><?=  'Activo' ?></td>
                <?php }else{ ?> 
                      <td width="25%"><?='Inactivo' ?></td>
                <?php } ?> 
                      <td width="15%" class="text-center">
                      <div class="btn-group">
                      <button class="btn btn-primary open_modal" value="{{$subcategoria->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button class="btn btn-primary confirm-delete" value="{{$subcategoria->id}}"><i class="fa fa-lg fa-trash"></i></button>                   
                      </div>
                      </td>
                    </tr>
                    @endforeach
                                 
                </tbody>
              </table>
            <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $subcategorias->render(); ?>
              </div>