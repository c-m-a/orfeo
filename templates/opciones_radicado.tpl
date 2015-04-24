      <div class="row">
        <div class="col-md-1">
          <a href="#" class="button">
            <span>
               <input name="checkAll" value="checkAll" id="select_all" type="checkbox">
            </span>
          </a>
        </div>
        <div class="col-md-8">
          <!-- dropdown opciones button -->
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Opciones<span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a id="mover" href="#">Mover</a></li>
              <li><a id="reasignar" href="#">Reasignar</a></li>
              <li><a id="informar" href="#">Informar</a></li>
              <li><a id="devolver" href="#">Devolver</a></li>
              <li><a id="vobo" href="#">VoBo</a></li>
              <li><a id="agendar" href="#">Agendar</a></li>
              <li><a id="archivar" href="#">Archivar</a></li>
              <li><a id="trd" href="#">TRD</a>
              </li>
            </ul>
          </div>
          <!-- end dropdown opciones button -->
          <div id="opciones_mover" style="display: none;">
            <table>
              <tr>
                <td>
                  <span class="leidos">Seleccione la bandeja destino: &nbsp;</span>
                  {$MENU_CARPETAS_PERSONALES}
                </td>
                <td>
                  <div class="buttons">
                    <button class="action blue" id="boton_mover"><span>Mover</span></button>
                  </div> <!-- /.buttons -->
                </td>
              </tr>
            </table>
          </div>
          
          <div id="opciones_reasignar" style="display: none;">
            <table>
              <tr>
                <td>
                  <span class="leidos">Seleccione la dependencia destino: &nbsp;</span>
                  {$MENU_DEPENDENCIA}
                </td>
                <td>
                  <div class="buttons">
                    <button class="action blue" id="boton_reasignar"><span>Reasignar</span></button>
                  </div> <!-- /.buttons -->
                </td>
              </tr>
            </table>
          </div>
          
          <div id="opciones_informar" style="display: none;">
            <table>
              <tr>
                <td>
                  <span class="leidos">Seleccione la(s) dependencia(s) destino(s): &nbsp;</span>
                  {$MENU_DEPENDENCIAS_INFORMAR}
                </td>
                <td>
                  <div class="buttons">
                    <button class="action blue" id="boton_informar"><span>Informar</span></button>
                  </div> <!-- /.buttons -->
                </td>
              </tr>
            </table>
          </div>
          
          <div id="opciones_devolver" style="display: none;">
            <table>
              <tr>
                <td>
                  <span class="leidos">Seleccione la dependencia destino a devolver: &nbsp;</span>
                  {$MENU_DEPENDENCIA}
                </td>
                <td>
                  <div class="buttons">
                    <button class="action blue" id="boton_devolver"><span>Devolver</span></button>
                  </div> <!-- /.buttons -->
                </td>
              </tr>
            </table>
          </div>

          <div id="opciones_vobo" style="display: none;">
            <table>
              <tr>
                <td>
                  <span class="leidos">Seleccione la dependencia destino para visto bueno: &nbsp;</span>
                  {$MENU_DEPENDENCIA}
                </td>
                <td>
                  <div class="buttons">
                    <button class="action blue" id="boton_vobo"><span>Vo.Bo.</span></button>
                  </div> <!-- /.buttons -->
                </td>
              </tr>
            </table>
          </div>

          <div id="opciones_agendar" style="display: none;">
            <table>
              <tr>
                <td>
                  <select style="" name="carpSel" id="carpper" class="select">
                    <option value="110009"> (Personal)prueba -- </option>
                  </select>
                </td>
                <td>
                  <div class="buttons">
                    <button class="action blue" id="boton_agendar"><span>Agendar</span></button>
                  </div> <!-- /.buttons -->
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-3 text-right">
          {$PAGINADOR}
        </div>
      </div>
      
