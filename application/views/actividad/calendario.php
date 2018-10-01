<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-calendar"></i> Calendario</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Calendario</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile row">
            <div class="col-md-12">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
 </main>



<!-- Modal to Event Details -->

  <div class="modal fade" id="calendarModal" >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 id="modalTitle" class="modal-title">Modal title</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div id="modalBody" class="modal-body">
                      <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <div id="botonfinalizar" class="modal-body">
                      <p></p>
                    </div>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>


<!--Modal-->



<!-- Modal to Event Movement -->
<div id="modal_confirm_yes_no" title="Motivo del Movimiento">
    
          
                  <select id="motivo" name="id_cliente" id="primary" class="form-control" >
                            <option value="cliente">Problema del Cliente</option>
                            <option value="operador">Problema del Operador</option>
                        </select>
                   
</div>


<!--Modal-->

