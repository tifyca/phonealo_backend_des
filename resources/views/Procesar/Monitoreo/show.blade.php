@extends ('layouts.header')
{{-- CABECERA DE SECCION --}}
@section('icono_titulo', 'fa-circle')
@section('titulo', 'Lista de Monitoreo')
@section('descripcion', '')

{{-- ACCIONES --}}
@section('display_back', '') @section('link_back', url('procesar/monitoreo'))
@section('display_new','d-none')  @section('link_edit', '') 
@section('display_edit', 'd-none')    @section('link_new', '')
@section('display_trash','d-none')    @section('link_trash')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="tile">
        <h3 class="tile-title">Listado de Monitoreo: Nombre Lista</h3>
        <div class="tile-body ">
          <div class="tile-body">
            <div class="table-responsive">
             <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>                          
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Categoría </th>
                    <th>Subcategoria</th>
                    <th>Stock</th>
                    <th>MesA</th>
                    <th>Mes</th>
                    <th>Sem</th>
                    <th>Ju16</th>
                    <th>Vi17</th>
                    <th>Sa18</th>
                    <th>Do19</th>
                    <th>Lu20</th>
                    <th>Ma21</th>
                    <th>Mi22</th>
                    <th>Ju23</th>
                    <th>Vi24</th>
                    <th>Sa25</th>
                    <th>Do26</th>
                    <th>Lu27</th>
                    <th>Ma28</th>
                    <th>Mi29</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td>Stock</td>
                    <td>MesA</td>
                    <td>Mes</td>
                    <td>Sem</td>
                    <td>Ju16</td>
                    <td>Vi17</td>
                    <td>Sa18</td>
                    <td>Do19</td>
                    <td>Lu20</td>
                    <td>Ma21</td>
                    <td>Mi22</td>
                    <td>Ju23</td>
                    <td>Vi24</td>
                    <td>Sa25</td>
                    <td>Do26</td>
                    <td>Lu27</td>
                    <td>Ma28</td>
                    <td>Mi29</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-times m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td>Stock</td>
                    <td>MesA</td>
                    <td>Mes</td>
                    <td>Sem</td>
                    <td>Ju16</td>
                    <td>Vi17</td>
                    <td>Sa18</td>
                    <td>Do19</td>
                    <td>Lu20</td>
                    <td>Ma21</td>
                    <td>Mi22</td>
                    <td>Ju23</td>
                    <td>Vi24</td>
                    <td>Sa25</td>
                    <td>Do26</td>
                    <td>Lu27</td>
                    <td>Ma28</td>
                    <td>Mi29</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-times m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td>Stock</td>
                    <td>MesA</td>
                    <td>Mes</td>
                    <td>Sem</td>
                    <td>Ju16</td>
                    <td>Vi17</td>
                    <td>Sa18</td>
                    <td>Do19</td>
                    <td>Lu20</td>
                    <td>Ma21</td>
                    <td>Mi22</td>
                    <td>Ju23</td>
                    <td>Vi24</td>
                    <td>Sa25</td>
                    <td>Do26</td>
                    <td>Lu27</td>
                    <td>Ma28</td>
                    <td>Mi29</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-times m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td>Stock</td>
                    <td>MesA</td>
                    <td>Mes</td>
                    <td>Sem</td>
                    <td>Ju16</td>
                    <td>Vi17</td>
                    <td>Sa18</td>
                    <td>Do19</td>
                    <td>Lu20</td>
                    <td>Ma21</td>
                    <td>Mi22</td>
                    <td>Ju23</td>
                    <td>Vi24</td>
                    <td>Sa25</td>
                    <td>Do26</td>
                    <td>Lu27</td>
                    <td>Ma28</td>
                    <td>Mi29</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-times m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Código</td>
                    <td>Producto</td>
                    <td>Categoría </td>
                    <td>Subcategoria</td>
                    <td>Stock</td>
                    <td>MesA</td>
                    <td>Mes</td>
                    <td>Sem</td>
                    <td>Ju16</td>
                    <td>Vi17</td>
                    <td>Sa18</td>
                    <td>Do19</td>
                    <td>Lu20</td>
                    <td>Ma21</td>
                    <td>Mi22</td>
                    <td>Ju23</td>
                    <td>Vi24</td>
                    <td>Sa25</td>
                    <td>Do26</td>
                    <td>Lu27</td>
                    <td>Ma28</td>
                    <td>Mi29</td>
                    <td width="10%" class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="fa fa-lg fa-times m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  
                  
                </tbody>
              </table>       
            </div>
            </div>
        </div>
    </div>
  </div>
</div>

  

@endsection

@push('scripts')

@endpush