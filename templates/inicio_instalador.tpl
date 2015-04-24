<!DOCTYPE html>
<html>
	<head>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-wizard.css" rel="stylesheet" />
	  <link href="css/chosen.css" rel="stylesheet" />
		<style type="text/css">
      .wizard-modal p {
        margin: 0 0 10px;
        padding: 0;
      }
	        
			#wizard-ns-detail-servers, .wizard-additional-servers {
				font-size:12px;
				margin-top:10px;
				margin-left:15px;
			}

			#wizard-ns-detail-servers > li, .wizard-additional-servers li {
				line-height:20px;
				list-style-type:none;
			}

			#wizard-ns-detail-servers > li > img {
				padding-right:5px;
			}
			
			.wizard-modal .chzn-container .chzn-results {
				max-height:150px;
			}
			
      .wizard-addl-subsection {
				margin-bottom:40px;
			}

      body {
        padding: 30px;
      }
		</style>
	</head>
		
	<body>
		<div class="wizard" id="wizard-demo">
			<h1>Instalador {$NOMBRE_APP}. Version {$VERSION_APP}</h1>
		
			<div class="wizard-card" data-onValidated="setServerName" data-cardname="name">
				<h3>Inicio</h3>
		
				<div class="wizard-input-section">
					<p>
            Bienvenido al asistente de instalaci&oacute;n del Sistema de Gestion Documental <strong>{$NOMBRE_APP}</strong> Version <strong>4</strong>.
					</p>
          <p>
            El asistente lo llevara paso por paso para realizar el proceso de verificaci&oacute;n e instalacion de cada uno de los componentes del sistema.
          </p>
          <p>
						Para comenzar con la instalaci&oacute;n por favor dar click en el boton
            <strong>Siguiente</strong> para con.
          </p>
				</div>
			</div>
		
			<div class="wizard-card" data-cardname="group">
				<h3>Requerimientos</h3>
		
				<div id="requerimientos" class="wizard-input-section">
					<p>
						Where would you like server <strong class="create-server-name"></strong>
						to go?
					</p>
					<img class="wizard-group-list" src="groups.png" />
				</div>
			</div>
		
		
			<div class="wizard-card" data-cardname="services">
				<h3>Base de Datos</h3>
		
				<div class="wizard-input-section">
					<p>
						Digite el nombre del servidor o direcci&oacute;n IP, nombre de usuario, contrase&ntilde;a y tipo de base de datos.
					</p>

          <div class="control-group">
            <input id="new-server-fqdn" placeholder="Servidor o IP. ej: 127.0.0.1" type="text">
          </div>
          
          <div class="control-group">
            <input id="new-server-fqdn" placeholder="Usuario base de datos" type="text">
          </div>
          
          <div class="control-group">
            <input id="new-server-fqdn" placeholder="Contrase&ntilde;a" type="text">
          </div>

          <div class="control-group">
            <input id="new-server-fqdn" placeholder="login" type="text">
            <div class="wizard-input-section">
              <select data-placeholder="Tipo base de datos" style="width:220px;" class="chzn-select">
                <option value=""></option>
                <option value="0">Postgres</option>
                <option value="1">MySQL</option>
                <option value="2">Oracle</option>
                <option value="3">Ms SQL Server</option>
              </select>
            </div>
          </div>
				</div>
			</div>
		
		
			<div class="wizard-card" data-onload="" data-cardname="location">
				<h3>Instalaci&oacute;n</h3>
		
				<div class="wizard-input-section">
					<p>
						We determined <strong>Chicago</strong> to be
						the closest location to monitor
						<strong class="create-server-name"></strong>
						If you would like to change this, or you think this is
						incorrect, please select a different
						monitoring location.
					</p>
		
					<select data-placeholder="Monitor nodes" style="width:350px;" class="chzn-select">
                <option value=""></option>
                <optgroup label="North America">
                  <option>Atlanta</option>
                  <option selected>Chicago</option>
                  <option>Dallas</option>
                  <option>Denver</option>
                  <option>Fremont, CA</option>
                  <option>Los Angeles</option>
                  <option>Miami</option>
                  <option>Newark, NJ</option>
                  <option>Phoenix</option>
                  <option>Seattle</option>
                  <option>Washington, DC</option>
                </optgroup>

                <optgroup label="Europe">
                  <option>Amsterdam, NL</option>
                  <option>Berlin</option>
                  <option>London</option>
                  <option>Milan, Italy</option>
                  <option>Nurnberg, Germany</option>
                  <option>Paris</option>
                  <option>Stockholm</option>
                  <option>Vienna</option>
                </optgroup>

                <optgroup label="Asia/Africa">
                  <option>Cairo</option>
                  <option>Jakarta</option>
                  <option>Johannesburg</option>
                  <option>Hong Kong</option>
                  <option>Singapore</option>
                  <option>Sydney</option>
                  <option>Tokyo</option>
                </optgroup>

            </select>
		
				</div>
			</div>
		
			<div class="wizard-card">
				<h3>Configuraci&oacute;n</h3>
		
				<div class="wizard-input-section">
					<p>
						Select the notification schedule to be used for outages.
					</p>
		
					<select class="wizard-ns-select chzn-select" data-placeholder="Notification schedule" style="width:350px;">
						<option value=""></option>
						<option>ALIS Production</option>
						<option>ALIS Development &amp; Staging</option>
						<option>Panopta Development &amp; Staging</option>
						<option>Jira</option>
						<option>QSC Enterprise Production</option>
						<option>QSC Enterprise Development &amp; Staging</option>
						<option>Panopta Production</option>
						<option>Panopta Monitoring Nodes</option>
						<option>Common</option>
					</select>
				</div>
		
				<div class="wizard-ns-detail hide">
					Also using <strong>ALIS Production</strong>:
		
					<ul id="wizard-ns-detail-servers">
						<li><img src="folder.png" />Corporate sites</li>
						<li><img src="folder.png" />dt01.sat.medtelligent.com</li>
						<li><img src="server_new.png" />alisonline.com</li>
						<li><img src="server_new.png" />circa-db04.sat.medtelligent.com</li>
						<li><img src="server_new.png" />circa-services01.sat.medtelligent.com</li>
						<li><img src="server_new.png" />circa-web01.sat.medtelligent.com</li>
						<li><img src="server_new.png" />heartbeat.alisonline.com</li>
						<li><img src="server_new.png" />medtelligent.com</li>
						<li><img src="server_new.png" />dt02.fre.medtelligent.com</li>
						<li><img src="server_new.png" />dev03.lin.medtelligent.com</li>
					</ul>
		        </div>
			</div>
		
			<div class="wizard-card">
				<h3>Finalizaci&oacute;n</h3>
		
				<div class="wizard-input-section">
					<p>The <a target="_blank" href="http://www.panopta.com/support/knowledgebase/support-questions/how-do-i-install-the-panopta-monitoring-agent/">Panopta Agent</a> allows
						you to monitor local resources (disk usage, cpu usage, etc).
						If you would like to set that up now, please download
						and follow the <a target="_blank" href="http://www.panopta.com/support/knowledgebase/support-questions/how-do-i-install-the-panopta-monitoring-agent/">install instructions.</a>
					</p>
		
					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							Download
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#">.rpm</a></li>
							<li><a href="#">.deb</a></li>
							<li><a href="#">.tar.gz</a></li>
						</ul>
					</div>
				</div>
		
				<div class="wizard-input-section">
					<p>You will be given a server key after you install the Agent
						on <strong class="create-server-name"></strong>.
						If you know your server key now, please enter it
						below.</p>
		
					<div class="control-group">
						<input type="text" class="create-server-agent-key"
							placeholder="Server key (optional)" data-validate="" />
					</div>
				</div>
			</div>
		
			<div class="wizard-error">
				<div class="alert alert-error">
					<strong>There was a problem</strong> with your submission.
					Please correct the errors and re-submit.
				</div>
			</div>
		
			<div class="wizard-failure">
				<div class="alert alert-error">
					<strong>There was a problem</strong> submitting the form.
					Please try again in a minute.
				</div>
			</div>
		
			<div class="wizard-success">
				<div class="alert alert-success">
					<span class="create-server-name"></span>
					was created <strong>successfully.</strong>
				</div>
		
				<a class="btn create-another-server">Create another server</a>
				<span style="padding:0 10px">or</span>
				<a class="btn im-done">Done</a>
			</div>
		
		</div>
							
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/chosen.jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-wizard.js"></script>

    <script type="text/javascript">
      function setServerName(card) {
        var host = $("#new-server-fqdn").val();
        var name = $("#new-server-name").val();
        var displayName = host;

        if (name) {
          displayName = name + " ("+host+")";
        };

        card.wizard.setSubtitle(displayName);
        card.wizard.el.find(".create-server-name").text(displayName);
      }

      function validateIP(ipaddr) {
          //Remember, this function will validate only Class C IP.
          //change to other IP Classes as you need
          {literal}
          ipaddr = ipaddr.replace(/\s/g, "") //remove spaces for checking
          var re = /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/; //regex. check for digits and in
                                                //all 4 quadrants of the IP
          {/literal}
          if (re.test(ipaddr)) {
              //split into units with dots "."
              var parts = ipaddr.split(".");
              //if the first unit/quadrant of the IP is zero
              if (parseInt(parseFloat(parts[0])) == 0) {
                  return false;
              }
              //if the fourth unit/quadrant of the IP is zero
              if (parseInt(parseFloat(parts[3])) == 0) {
                  return false;
              }
              //if any part is greater than 255
              for (var i=0; i<parts.length; i++) {
                  if (parseInt(parseFloat(parts[i])) > 255){
                      return false;
                  }
              }
              return true;
          }
          else {
              return false;
          }
      }

      function validateFQDN(val) {
        {literal}
        return /^[a-z0-9-_]+(\.[a-z0-9-_]+)*\.([a-z]{2,4})$/.test(val);
        {/literal}
      }

      function fqdn_or_ip(el) {
        var val = el.val();
        ret = {
          status: true
        };
        if (!validateFQDN(val)) {
          if (!validateIP(val)) {
            ret.status = false;
            ret.msg = "Invalid IP address or FQDN";
          }
        }
        return ret;
      }

      $(function() {
        $.fn.wizard.logging = true;
        
        var wizard = $("#wizard-demo").wizard();

        $(".chzn-select").chosen();


        wizard.el.find(".wizard-ns-select").change(function() {
          wizard.el.find(".wizard-ns-detail").show();
        });

        wizard.el.find(".create-server-service-list").change(function() {
          var noOption = $(this).find("option:selected").length == 0;
          wizard.getCard(this).toggleAlert(null, noOption);
        });

        wizard.cards["name"].on("validated", function(card) {
          var hostname = card.el.find("#new-server-fqdn").val();
        });

        wizard.on("submit", function(wizard) {
          var submit = {
            "hostname": $("#new-server-fqdn").val()
          };

          setTimeout(function() {
            wizard.trigger("success");
            wizard.hideButtons();
            wizard._submitting = false;
            wizard.showSubmitCard("success");
            wizard._updateProgressBar(0);
          }, 2000);
        });

        wizard.on("reset", function(wizard) {
          wizard.setSubtitle("");
          wizard.el.find("#new-server-fqdn").val("");
          wizard.el.find("#new-server-name").val("");
        });

        wizard.el.find(".wizard-success .im-done").click(function() {
          wizard.reset().close();
        });

        wizard.el.find(".wizard-success .create-another-server").click(function() {
          wizard.reset();
        });
        
        $(".wizard-group-list").click(function() {
          alert("Disabled for demo.");
        });
        
        $("#open-wizard").click(function() {
          wizard.show();
        });

        $('#requerimientos').load('?estado=1');
        
        wizard.show();
      });
    </script>
	</body>
</html>
