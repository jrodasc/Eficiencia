  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-uppercase" id="exampleModalLabel">Lista de archivos</h3>
               
              <input id="id_show" placeholder="Ingrese dato" class="form-control gray-input" name="id_show" type="hidden">
                <em class="cGray">Muestra el listado de archivos asignados en al seguimiento</em>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <table id="dtTalleres" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Archivo</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr>
                                        <td>01</td>
                                         <td>Archivo 1</td>
                                         <td>27/10/2017</td>
                                        <td>
                                            <a class="btn btn-info" href="#">Descargar</a>
                                            
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>02</td>
                                         <td>Archivo 2</td>
                                         <td>07/10/2017</td>
                                                                               
                                        <td>
                                            <a class="btn btn-info" href="#">Descargar</a>
                                            
                                        </td>
                                    </tr> <tr>
                                        <td>03</td>
                                         <td>Archivo 3</td>
                                         <td>10/10/2017</td>
                                                                               
                                        <td>
                                            <a class="btn btn-info" href="#">Descargar</a>
                                            
                                        </td>
                                    </tr> <tr>
                                        <td>04</td>
                                         <td>Archivo 4</td>
                                         <td>27/10/2017</td>
                                                                               
                                        <td>
                                            <a class="btn btn-info" href="#">Descargar</a>
                                            
                                        </td>
                                    </tr> <tr>
                                        <td>05</td>
                                         <td>Archivo 5</td>
                                         <td>16/10/2017</td>
                                                                               
                                        <td>
                                            <a class="btn btn-info" href="#">Descargar</a>
                                            
                                            
                                        </td>
                                    </tr>
                                    
                                
                            </tbody>
                        </table>
              </div>
              <div id="msg"></div>
              <div class="modal-footer">
                {!! Form::button('Cerrar', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
               
                
              </div>
            </div>
          </div>
        </div>