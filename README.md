# ProbeOne
Documentos para el procesamiento de datos de tipo .txt con php, MySQL y HTML.

En esta aplicación se desarrolla un simple análisis de archivos de texto, que contienen informacion (email, nombre, apellido y código) acerca de unas clientes y se debe determinar la cantidad de clientes por estado según sea su código y organizar eso en tablas en WEB y guardar esa información en una base de datos.

Para la base de datos se utiliza el motor MySQL, solo se necesitan 3 comandos para crear la base de datos, luego se ejecuta el archivo llamado form.php, el cual inicia pidiendo la subida del archivo .txt.

Luego la aplicación determina si es un formato válido o no, según las siguientes características:
  -Email: obligatorio.
  -Nombre y apellido: opcional.
  -Código: obligatorio. Escala: 1 = activo
                                2 = inactivo
                                3 = en espera.
Los campos de cada cliente estan separados por comas (,) y cada cliente separado por un salto de linea (\n).

Se adjuntan los .txt de prueba para facilitar la comprensión de la estructura de cada archivo de texto.
