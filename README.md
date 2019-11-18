## Orfeo Plus

Bienvenido a la documentaci&oacute;n de Orfeo Plus Versi&oacute;n 4.0. Esta version ha sido creada con el afan de ofrecer un sistema mas facil de programar tratando de separar el codigo PHP y HTML en partes separadas usando el motor de plantillas Smarty, para una mayor flexibilidad al escribir codigo, guardando siempre la compatibilidad entre las bases de datos de las versiones previas a Orfeo+ 4.0.

La segunda parte que queremos ofrecer es un codigo mas libre de errores y de facil instalacion, con lo cual se pretende mejorar los tiempos de pre y pos instalacion y soporte, por lo tanto el codigo fuente se encuentra en constante modificacion.

Orfeo Plus Ver. 4.0 es una version plenamente mantenidad por la comunidad de desarrolladores que desean participar y mejorar el codigo fuente de la aplicacion. Esta version fue tomada apartir de la version de Orfeo 3.8.2 del repositorio central de la fundacion Corre Libre y se realizo varias modificaciones claves a los archivos que mas se usan, por lo tanto cualquier ajuste que tenga versiones anteriores u otras version aparte a Orfeo+ tendran que ser reescritas para mayor compatibilidad esta version.

Este software se entrega sin ninguna garantia de errores en el codigo fuente, bajo licencia GPL Ver. 3, ademas esta version no se encuentra soportada por la fundacion "Corre Libre" por lo tanto cualquier reporte o inconveniente debe ser realizado al grupo de desarrolladores responsables del proyecto.

## Tabla de contenido

* [Instalacion Servidor](#iniciando-la-instalacion-del-servidor)
* [Instalacion Base de Datos](#routing-engine)
* [Instalacion de la Aplicacion](#framework-variables)
* [Archivo de configuracion](#views-and-templates)
* [Reglas de Codificacion](#views-and-templates)
* [Soporte y Licencia](#databases)


Cualquier informacion pueden contactarme a mi cuenta de [![@Cma4c](ui/images/twitter.png)](https://twitter.com/cma4c)

### Version 4.0 Es Finalmente Liberada!

Esta es la &uacute;ltima versi&oacute;n de Orfeo Plus liberada, en la cual se desea realizar la separaci&oacute;n del codigo HTML del PHP y ofrecer estabilidad del producto, las personas que deseen arrancar a probar el proyecto, se recomienda revisarlo ya que por realizar este tipo de modificaciones ha causado que el software sea un poco menos estable, por lo tanto se estara revisando todos los errores que aparezcan en el transcurso para corregirlos y ofrecer un mejor producto m&aacute;s adelante.

## Iniciando la Instalacion del Servidor

La primera prueba de instalacion se realizo con un servidor Ubuntu 14.04 utilizando Virtual Box el cual solamente se dejo instalado el servidor SSH para realizar la conexion e instalar los demas componentes del software. 

Se recomienda que si va a realizar la instalacion del software para pruebas es recomendable 5GB de espacio en disco y 512 de RAM, ya que el sistema utiliza imagemagick es necesario incrementar la ram por lo menos a 1GB para hacer prueba o 2GB para produccion ya que el proceso de transformar una imagen en formato TIFF a PDF necesita muchos recursos de maquina.

### No m&aacute;s por decir!! A trabajar!!

Damos por hecho que la instalacion fue un exito y que en este momento se encuentra en bash para realizar la siguiente ejecucion de comandos para instalar los respectivos componentes.

### Revision de los Paquetes

```
sudo apt-get update
```

```
sudo apt-get upgrade
```

Modificacion de SSH para que solamente el usuario pueda realizar la conexion al servidor.

```
sudo vim /etc/ssh/sshd_config
```

```
Port 55000
Protocol 2
PermitRootLogin no
```

Al final del archivo adicionar las siguientes lineas la cual permite multiple conexiones entre el usuario de la maquina

```
UseDNS no
AllowUsers usuario_sistema
```

### Reiniciando y conectandose via SSH
```
sudo reload ssh
```
Para conectarse a la maquina SSH
```
ssh -p 55000 usuario_sistema@192.168.0.123
```
### Instalacion de Apache

```
sudo apt-get install apache2
```

### Instalacion de PHP

```
sudo apt-get install php5 libapache2-mod-php5 php5-mcrypt
```

Modificacion de los archivos

```
sudo vim /etc/apache2/mods-enabled/dir.conf
```

Mostrara lo siguiente
```
<IfModule mod_dir.c>
    DirectoryIndex index.html index.cgi index.pl index.php index.xhtml index.htm
</IfModule>
```

Cambiar por
```
<IfModule mod_dir.c>
    DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
</IfModule>
```

Reiniciar
```
sudo service apache2 restart
```

### Instalacion de Modulo Postgres PHP

```
sudo apt-get install php5-pgsql
```

### Instalacion de GIT

```
sudo apt-get install git
```

### Descarga de Orfeo Plus del repositorio

```
cd /var/www/html/
```

```
sudo git clone https://github.com/anicma/orfeo.git
```

Modificacion del php.ini

```
sudo vim /etc/php5/apache2/php.ini
```

Buscar las siguientes variables y cambiar por los valores que se muestran a continuacion:

```
error_reporting = E_ALL & ~E_NOTICE & ~E_DEPRECATE
```
```
display_errors = On
```
```
short_open_tag = On
```
guardar los cambios
```
sudo service apache2 restart
```
Entrar al directorio orfeo
```
cd orfeo/
```
```
sudo mkdir templates_c
```
cambiar de propietario.

```
sudo chown -R www-data:www-data *
```

Cambiar permisos.
```
sudo chmod 744 *
```
Crear una copia del archivo de configuracion
```
sudo cp config-ini.php config.php
```
Configurar las lineas de conexion y configuracion del servidor.
```
sudo vim config.php
```

Modificar las siguientes lineas

Linea 11.
```
 define('NOMBRE_SERVIDOR', 'localhost'); // Dejarlo localhost o el nombre que tenga asignado.
```
 Linea 15.
```
 define('DIRECTORIO_ORFEO', 'orfeo/'); // Cambiar por el nombre por de directorio actual de la aplicacion.
```
Verificar las lineas 95 hasta la 110 que tenga la configuracion respectiva para conectarse a la base de datos.

