<?php $nombre = Auth::user()->name;?>
<div class="modal fade" id="mchat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="row">
        <div class="col-md-8">
          <div class="tile">
            <form action="{{ route('enviar_chat') }}" id="form1" method="post" accept-charset="utf-8">
            <h3 class="tile-title">Chat para la Venta: </h3>
            
                <div class="form-group col-md-6">
             <input type="text" class="form-control-plaintext" name="id_venta" id="id_venta">     
                   <input type="hidden" class="form-control" name="id_delivery" id="id_delivery">

                   <input type="hidden" class="form-control" name="id_remito" id="id_remito"><br>
                 </div>

            <div class="messanger">
              <div class="messages">
                <img src="{{asset('img/user.png')}}" width="10%">
                <input type="text" class="form-control-plaintext" name = "usuario" id="usuario" value="{{$nombre}}">
                <div class="message">
                  <p class="info"></p>
                </div>
                <div class="message me">
                  <img src="{{asset('img/user.png')}}" width="10%">
                  <input type="text" class="form-control-plaintext" name = "delivery" id="delivery"><br>
                  <p class="info"></p>
                </div>
              </div>
                 <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
              <div class="sender">
                
                <input type="text" placeholder="Enviar Mensaje" name="mensaje" id="mensaje">
                <button class="btn btn-primary" type="submit"><i class="fa fa-lg fa-fw fa-paper-plane"></i></button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
</div>
</div>
</div>