# proyectofinalDAW
## 1. Despliegue
En esta sección se abordarán los planes de despliegue y pruebas de nuestro proyecto. En el desarrollo de software, es importante establecer un plan, tanto para las actividades llevadas a cabo durante el despliegue, como para las pruebas del software. 
Plan de despliegue
Vamos a poner a prueba el proyecto en el entorno de despliegue para asegurar su correcto funcionamiento. 
### 1.	Preparación del entorno de producción
1.1.	**Instalación y configuración de la distribución de Apache XAMPP**


1.1.1.	**Descarga, instalación y configuración de los programas**


1.1.1.1.	**Servidor web Apache**


Cuando ejecutamos el archivo .exe de XAMPP, seleccionamos durante la instalación el componente de Apache. Para nuestro proyecto, no hemos tenido que realizar cambios en la configuración preestablecida del servidor Apache para su correcto funcionamiento. 


1.1.1.2.	**Sistemas relacionales de administración de BBDD MySQL**


Al igual que en el caso anterior, se selecciona durante la instalación el componente MySQL. Tampoco hemos tenido que cambiar nada de la configuración preestablecida de MySQL, ni modificar su archivo my.ini.


1.1.1.3.	**Programa de administración de bases de datos phpMyAdmin**


En él se exportará la BBDD creada en el proyecto, llamada “proyecto_final_daw”. Se elegirá el formato del archivo a exportar, en este caso con extensión sql con nuestra BBDD. Este archivo nos ayudará a poner a prueba el proyecto en otros dispositivos.


1.1.1.4.	**Servidor de correo Mercury**


Durante el asistente de instalación de XAMPP, seleccionamos la herramienta Mercury. Dentro de este servidor de correo, lo configuramos para poder enviar correos electrónicos desde servidor local y poder recibirlos en una cuenta de correo con IP local. Así conseguiremos un simulador de emails. Esto se logrará:
-	Abrir mercury desde XAMPP con el botón de “start”, una vez iniciado le damos al botón “Admin”. Una vez dentro del programa, vamos a la pestaña configuración y nos dirigimos a “aliases”. Añadimos un nuevo alias para nuestro usuario, con la dirección de correo que queremos asociar al usuario (en este caso sería con el dominio de correo “@localhost.com” por querer configurar una cuenta de correo con IP local).
-	Después añadimos un nuevo dominio, dirigiéndonos a la pestaña de configuración y en “Mercury core module”. Agregamos dos dominios locales: localhost.com con el nombre de internet “localhost” y localhost.com con nombre de internet “[127.0.0.1]”.
-	Configuramos el SMTP server, en la pestaña general cambiamos la opción de “announce myself as” por 127.0.0.1, y le damos a aceptar.
-	Configuramos el POP3 server, en “IP Interface to use” escribimos 127.0.0.1 y aceptamos.
-	Nos dirigimos en configuración a “protocol modules” y seleccionamos para activar los protocolos.
-	Reiniciamos Mercury
-	Volvemos a la configuración, y añadimos nuestro usuario en “MercuryD POP3 Client”, con la IP del servidor local 127.0.0.1 y la contraseña que le queramos poner. Le damos al ok.
-	Tras la configuración del Mercury, ahora solo faltaría configurar el gestor de correos que vayamos a utilizar. En el proyecto hemos utilizado “Outlook”. Agregamos nuestro usuario, la contraseña y en la configuración del servidor: seleccionamos que el servidor de correo entrante es de tipo POP3 y con IP 127.0.0.1, y nuestro servidor SMTP de correo saliente en nuestro proyecto es también 127.0.0.1.


1.1.2.	**Configuración de entorno de seguridad introduciendo certificado “Secure Sockets Layer” (SSL) con el algoritmo hash criptográfico SHA-256.**


SSL es uno de los protocolos de cifrado más utilizado para garantizar la seguridad de las comunicaciones. En nuestro proyecto, crearemos un SSL local válido para XAMPP. Conseguiremos esto, primero creando dentro de la carpeta apache de XAMPP otra carpeta donde se localizará el certificado. En este caso se “crt”. Dentro de esta carpeta agregamos dos archivos: ”cert.conf ”, archivo que se utiliza como plantilla de configuración para generar certificados SSL con OpenSSL, y “make-cert.bat”, archivo por lotes de Windows que contiene un conjunto de comandos que automatizan la generación de certificados SSL utilizando OpenSSL.


Abrimos el archivo “cert.conf” con un editor de texto y modificamos “{{DOMAIN}}” por el dominio que vamos a utilizar, en este caso “site.test”. Tras esto, abrimos el otro archivo e ingresamos los datos que nos va pidiendo, siendo importante poner en el dominio el “site.test” que hemos cambiado.


Gracias a lo anterior, dentro de la carpeta crt se habrá creado la carpeta “site.test”, donde se alojarán los archivos propios de nuestro certificado SSL, “server.crt” y “server.key”. Instalamos el certificado en Windows en equipo local, haciendo doble click en el archivo con extensión .crt, y alojándolo en entidades de certificación raíz de confianza. Al finalizar, el certificado ya estará instalado y de confianza en Windows.
Por último, agregamos el certificado a hosts, mediante la sentencia “127.0.0.1 site.test” en Windows, en la ruta: C:\Windows\System32\drivers\etc\hosts. Al igual, habilitamos el SSL en XAMPP, en el archivo localizado en esta ruta: C:\xampp\apache\conf\extra\httpd-xampp.conf.
Dentro de este archivo agregamos este código:
```bash
## site.test
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName site.test
</VirtualHost>

<VirtualHost *:443>
    DocumentRoot "C:/xampp/htdocs"
    ServerName site.test
    SSLEngine on
    SSLCertificateFile "crt/site.test/server.crt"
    SSLCertificateKeyFile "crt/site.test/server.key"
</VirtualHost>
```
Tras todo esto, se reinicia el navegador y al ir a nuestra página de XAMPP en el navegador ya aparecerá como sitio seguro por nuestro certificado, se muestra en la figura 58.
 

1.1.3.	**Implementación de sistemas de copias de seguridad y recuperación de datos**


Primero, para no perder los datos de la BBDD, se utilizará la herramienta phpMyAdmin. Utilizaremos el mismo paso realizado anteriormente, el de exportar la BBDD. Con ello, seleccionando la BBDD que se quiere realizar la copia de seguridad, la exportamos para generar un archivo SQL que contenga la estructura y los datos de la BBDD. Por último, guardamos este archivo en la ruta donde tengamos el proyecto.


Después, se realiza un archivo batch, archivo de procesamiento por lotes, para realizar una copia de seguridad de los archivos del proyecto. El archivo con extensión .bat copia todos los archivos y subdirectorios del proyecto a una carpeta de copia de seguridad, asegurándose de que solo se copien los archivos más recientes y de que se manejen los errores de manera adecuada. Para realizar la copia, solo hay que ejecutar el archivo mediante línea de comandos. El código se muestra a continuación:


*xcopy "ruta carpeta origen\*.*" "ruta carpeta destino(backup)\*.*" /d /e /c /y /f*


Dónde:


/d: Esta opción indica que solo se copiarán los archivos que tengan una fecha de modificación más reciente que los archivos existentes en el directorio de destino.


/e: Esta opción copia directorios y subdirectorios, incluyendo los vacíos.


/c: Esta opción indica que se debe continuar con la copia incluso si se producen errores.


/y: Esta opción indica que se debe confirmar de forma automática si se sobrescriben los archivos existentes en el directorio de destino sin preguntar al usuario.


/f: Esta opción muestra el nombre de los archivos al copiarlos. Esto es útil para ver el progreso de la copia.

### 2.	Despliegue de la aplicación 
2.1.	**Importación de BBDD desde el entorno de producción.**


Desde la herramienta de phpMyAdmin, importaremos el documento sql del proyecto. Así se creará en el servidor localhost la BBDD creada y utilizada en el proyecto. En archivo a importar se selecciona el archivo con extensión sql, llamado “proyecto_final_daw”.


2.2.	**Ajuste de las variables de entorno y configuración personalizada para el entorno de producción.**


En nuestra BBDD, trabajamos con un usuario creado con privilegios para la manipulación de datos, pero sin privilegios para la manipulación de la estructura, administración y límites de recursos de la BBDD.
En nuestra BBDD, se utilizará el usuario predefinido root de phpMyAdmin. Usuario que posee todos los privilegios, lo que le otorga pleno acceso para la manipulación de datos, la administración de la estructura y la configuración de límites de recursos de la base de datos. Este usuario no tiene contraseña, por lo que en la conexión en la parte de contraseña lo dejaremos vacío.
En el archivo de conexión_proyecto.php, encargado de crear la conexión con la BBDD, se reflejarán los datos de conexión. Si se colocan datos incorrectos, la conexión dará error. A continuación, se muestra el código que referencia a los parámetros de la conexión:
```bash
$host = "localhost";
$user = "root";
$pass = "";
$baseDatos = "proyecto_final_daw";
```
También es importante señalar donde van a estar ubicados los archivos del proyecto para que funcionen dentro de XAMPP. La ruta donde se van a alojar será: “C:\xampp\htdocs\PROYECTO_FINAL\PROYECTO_FINAL_DAW”. Para probar la aplicación, habría que crear esta ruta en el dispositivo local utilizado.


### 3.	Verificación después del despliegue:
3.1.1.	 **Confirmación de la Operatividad de los Servicios.**


En este apartado, verificaremos que todos los servicios necesarios para el funcionamiento de la aplicación estén en línea y operativos. Se van a incluir los servicios y herramientas de XAMPP, conexión con la BBDD y servicio de correo electrónico local.
Primero, arrancamos las herramientas de XAMPP y comprobamos que todas lo hagan de forma correcta, sin aparición de errores.
 
Al haber arrancado de forma correcta MySQL, al darle al botón Admin se abrirá la herramienta phpMyAdmin con nuestra BBDD.
 Por último, comprobamos el funcionamiento de Mercury. En la figura 62(véase Anexo 12.2.12) se puede observar como los servicios están activados y funcionando. Se hace la prueba enviando un correo electrónico y se puede observar en la ventana del cliente POP3 como se recibe el correo y en la ventana de “core process” como da el OK al envío.

## 2.	Manual de Usuario
Aplicación de adopción de perros: Adogtion
### -	Preparación previa
o	Tener instalado XAMPP, con las herramientas de Apache, MySQL y Mercury, en el dispositivo donde vamos a utilizar la aplicación.
o	Tener configurado Mercury como se explica en el apartado de despliegue.
o	Tener los archivos de la Carpeta “PROYECTO_FINAL_DAW” en la siguiente ruta: C:\xampp\htdocs\PROYECTO_FINAL\PROYECTO_FINAL_DAW.
-	Guía de uso
1.	Abrir aplicación XAMPP.
2.	Arrancar programas Apache, MySQL y Mercury dando a l botón “Start”.
3.	Si no tenemos el certificado SSL, nos dirigimos al navegador web y en la barra de direcciones escribimos: http://localhost/PROYECTO_FINAL/
4.	Pinchamos en la carpeta PROYECTO_FINAL_DAW. Ya estaremos en la página de inicio de la aplicación web.
5.	Podremos navegar por las diferentes páginas a través de los enlaces que se encuentran en el encabezado. En el ejemplo se ha pasado el ratón por encima de la sección de contacto.
6.	Si queremos enviar una consulta o un mensaje de contacto, dentro de la página de contacto rellenamos el formulario y le damos a “enviar”.
a.	Tras el envío, aparecerá un cuadro de texto de éxito con el nombre que has introducido y un enlace a la página de inicio.
7.	Para poder adoptar un perro tendremos que registrarnos o iniciar sesión, ya que al acceder a la página de adoptar con aparecerá el mensaje de “Para poder adoptar hay que iniciar sesión”. 
8.	Si es la primera vez que se utiliza tendrá que ser obligatoriamente en registrarse. El botón aparece en el encabezado, en la esquina superior derecha.
9.	En el formulario de registro, rellenamos los campos con: Nuestro nombre de usuario, correo electrónico y contraseña. Al finalizar, le damos al botón de “Registrarse”. 
10.	Si el registro ha sido correcto, nos redirigirá a la página de inicio y nos preguntará el navegador si queremos guardar la contraseña introducida. Ya en el cuadro superior derecho del encabezado no nos saldrán los botones de “iniciar sesión” y “registrarse”, si no que solo nos aparecerá el de “cerrar sesión”.
11.	Ahora ya podemos elegir un perro para adoptar. Lo haremos accediendo a la página de “Adoptar” que aparece en el menú de navegación. Al haber realizado el registro, ya no aparecerá el mensaje de “Para poder adoptar hay que iniciar sesión”.
12.	Aparecerá una lista con los perros disponibles y no disponibles, que aparecerán en color gris y sin botón de adoptar.
13.	Elegimos un perro disponible, por ejemplo, Lisa, y le damos al botón de “¡Adoptar!”.
14.	Nos aparece un formulario, ya rellenadas las secciones de email y nombre de perro de forma automática, el cual debemos rellenar con los datos que nos piden y darle al botón de “Enviar”.
15.	Al rellenar el formulario y enviarlo, nos saldrá un cuadro de texto de confirmación del envío y de que la adopción del perro escogido está en curso. También aparecerá un enlace para volver a la página de inicio.
16.	Al volver a la página de adoptar, veremos a Lisa ya no disponible.
17.	Por último, cerramos sesión dándole al botón “cerrar sesión” desde cualquier página de la aplicación.
18.	Al cerrar sesión, permaneceremos en la misma página, pero ya aparecerán los botones de iniciar sesión y registrarse.
