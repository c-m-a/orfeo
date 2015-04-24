<!doctype html>
<html>
  <head>
    <!--<script type="text/javascript" src="https://raw.github.com/mozilla/pdf.js/gh-pages/build/pdf.js"></script>-->
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
      <!--<button id="zoom_out" onclick="zoom_out()">-</button>
      <button id="zoom_in" onclick="zoom_in()">+</button>-->
        &nbsp; &nbsp;
      <span>Pagina: <span id="page_num"></span> / <span id="page_count"></span></span>
    </div>
    <div id="pdf">
      <!--<button id="prev" onclick="goPrevious()">&lt;</button>-->
      <!--<button id="next" onclick="goNext()" style="position: absolute; top: 100px; left: 100px; display : block; width:100px; height:40px;">&gt;</button>-->
      <a href="#" id="prev" onclick="goPrevious()" style="position: absolute; top: 30px; left: 10px; display : block; width:100px; height:1500px;" alt="Pagina Anterior"></a>
      <a href="#" id="next" onclick="goNext()" style="position: absolute; top: 30px; left: 980px; display : block; width:100px; height:1500px;" alt="Siguiente Pagina"></a>
      <canvas id="the-canvas" style="border:1px solid black;"/>
      </canvas>
    </div>
    <script type="text/javascript">
      //
      // NOTE: 
      // Modifying the URL below to another server will likely *NOT* work. Because of browser
      // security restrictions, we have to use a file server with special headers
      // (CORS) - most servers don't support cross-origin browser requests.
      //
      var url = '{$URL_PDF}';

      //
      // Disable workers to avoid yet another cross-origin issue (workers need the URL of
      // the script to be loaded, and currently do not allow cross-origin scripts)
      //
      PDFJS.disableWorker = true;

      var pdfDoc = null,
      pageNum = 1,
      scale = 1.75,
      viewport,
      canvas = document.getElementById('the-canvas'),
      ctx = canvas.getContext('2d');

      //
      // Get page info from document, resize canvas accordingly, and render page
      //
      function renderPage(num) {
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

        //
        // Page Zoom In
        //
        function zoom_in() {
          scale += 0.1;
          viewport = page.getViewport(scale);
          canvas.height = viewport.height;
          canvas.width = viewport.width;
          
          // Render PDF page into canvas context
          var renderContext = {
            canvasContext: ctx,
            viewport: viewport
          };
          page.render(renderContext);
        }
        
        //
        // Page Zoom Out
        //
        function zoom_out() {
          scale -= 0.1;
          viewport = page.getViewport(scale);
          canvas.height = viewport.height;
          canvas.width = viewport.width;
        }
        
        //
        // Go to previous page
        //
        function goPrevious() {
        if (pageNum <= 1)
          return;
          pageNum--;
          renderPage(pageNum);
        }

        //
        // Go to next page
        //
        function goNext() {
          if (pageNum >= pdfDoc.numPages)
            return;
          pageNum++;
          renderPage(pageNum);
        }

        //
        // Asynchronously download PDF as an ArrayBuffer
        //
        PDFJS.getDocument(url).then(function getPdfHelloWorld(_pdfDoc) {
        pdfDoc = _pdfDoc;
        renderPage(pageNum);
      });
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script> 
    <script src="./js/bootstrap/js/bootstrap.min.js"></script> 
    <script src="js/placeholder-shim.min.js"></script>        
    <script src="js/custom.js"></script>
  </body>
</html>
