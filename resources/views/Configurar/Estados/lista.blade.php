<table class="table table-hover" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nombre</th>
		                <th>Acción</th>
                  </tr>
                </thead>
                <tbody id="estados-list" name="estados-list">
                  @foreach($estados as $item)           
                     <tr id="estado{{$item->id}}">
                      <td width="90%">{{$item->estado}}</td>
                
                      <td width="10%" class="text-center">
                      <div class="btn-group">
                      <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-primary btn-sm open_modal" value="{{$item->id}}"><i class="fa fa-lg fa-edit"  ></i></button>               
                      </div>
                      </td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
         
            <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $estados->render(); ?>
            </div>