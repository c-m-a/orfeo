<!doctype html>
<html>
  <head>
    <!--<script type="text/javascript" src="https://raw.github.com/mozilla/pdf.js/gh-pages/build/pdf.js"></script>-->
    <title>Resultado Transacci&oacute;n - Orfeo+ </title>
    <base href="{$URL_BASE_ORFEO}">
    <link href="./js/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="./js/pdf.js"></script>
    <style>
      a:hover {
      background-color:#EEEEEE; opacity:0.8;
      }
    </style>
  </head>
  <body>
    <div>
      <!--<button id="zoom_in" onclick="zoom_in()">+</button>-->
        &nbsp;
      <button id="prev" onclick="$.goPrevious()">&lt; Atras</button>
      <span>Pagina: <span id="page_num"></span> / <span id="page_count"></span></span>
      <button id="next" onclick="$.goNext()">Siguiente &gt;</button>
      <strong>Radicado:</strong> {$RADI_NUME_RADI} -
      <strong>{$ASUNTO_RADICADO}</strong>
    </div>
    <div id="pdf">
      <canvas id="the-canvas" style="border:1px solid black;"/>
      </canvas>
    </div>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <!--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <script src="./js/jquery-1.11.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script> 
    <script src="./js/bootstrap/js/bootstrap.min.js"></script> 
    <script src="./js/placeholder-shim.min.js"></script>        
    <script src="./js/custom.js"></script>
    <script src="./js/bootbox.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
    <script type="text/javascript">
      function print() {
        var wnd = window.open('{$URL_PDF}');
        wnd.print();
      }

      $(document).ready(function() {
        var url = '{$URL_PDF}';

        PDFJS.disableWorker = true;

        var pdfDoc = null,
        pageNum = 1,
        scale = 1.75,
        viewport,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

        $.renderPage = function (num) {
          
          // Using promise to fetch the page
          pdfDoc.getPage(num).then(function(page) {
            viewport = page.getViewport(scale);
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            
            // Render PDF page into canvas context
            var renderContext = {
              canvasContext: ctx,
              viewport: viewport
              };
            page.render(renderContext);
          });

          // Update page counters
          document.getElementById('page_num').textContent = pageNum;
          document.getElementById('page_count').textContent = pdfDoc.numPages;
        }
        
        $.goPrevious = function () {
          if (pageNum <= 1)
            return;
          pageNum--;
          $.renderPage(pageNum);
        }

        $.goNext = function () {
          if (pageNum >= pdfDoc.numPages)
            return;
          pageNum++;
          $.renderPage(pageNum);
        }
        
        $.pdf_js = PDFJS.getDocument(url).then(function getPdfHelloWorld(_pdfDoc) {
          pdfDoc = _pdfDoc;
          $.renderPage(pageNum);
        });
      });

      // jQuery
      $(document).ready(function() {
        // Mensaje exitoso de asociacion de archivo
        bootbox.dialog({
        title: "Asociaci&oacute;n de Imagen Exitosa!!",
        message: 'La imagen TIF fue asociada con exito!! Al radicado: ' +
                  '<strong>{$RADI_NUME_RADI}</strong><br>' +
                  'Fecha transaccion: {$FECHA_TRANSACCION}',
        buttons: {
          success: {
          label: "Continuar",
            className: "btn-success",
              callback: function () {
              }
            }
          }
        }
        );

        $(document).keydown(function(e) {
          switch(e.which) {
            case 37: // left
              $.goPrevious();
            break;

            case 39: // right
              $.goNext();
            break;

            default: return; // exit this handler for other keys
          }
          e.preventDefault(); // prevent the default action (scroll / move caret)
        });
        
        $('#the-canvas').bind('swipeleft', function(event) {
          $.goNext();
        }); 
        
        $('#the-canvas').bind('swiperight', function(event) {
          $.goPrevious();
        }); 
      });
    </script>
  </body>
</html>
