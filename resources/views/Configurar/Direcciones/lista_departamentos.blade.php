<table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="dpto-list" name="dpto-list">
                @foreach ($departamentos as $item)
                 <tr id="dpto{{$item->id}}">
                  <td width="90%">{{ $item->nombre }}</td>
                  <td width="10%" class="text-center">
                    <div  class="btn-group">
                        <button class="btn btn-primary open_modal" value="{{$item->id}}"><i class="fa fa-lg fa-edit"  ></i></button>
                      <button class="btn btn-primary confirm-delete" value="{{$item->id}}"><i class="fa fa-lg fa-trash"></i></button> 
                      </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>    
              <div id="sampleTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <?php echo $departamentos->render(); ?>
              </div>