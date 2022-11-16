API REST para el recurso de shows


Importar la base de datos

importar desde PHPMyAdmin (o cualquiera) database/circus.sql


Pueba con postman
El endpoint de la API es:http://localhost/circus/api/shows


ENDPOINTS PARA UNA API RESTFUL

----Endpoint para mostrar todos los shows(GET)----

/shows

Ej: http://localhost/circus/api/shows


Para traer todos los shows se utiliza el metodo GET para RECUPERAR un recurso.
El código de respuesta es 200.

----Endpoint para mostrar un show en particular(GET)----

/shows/:id

Ej: http://localhost/circus/api/shows/111

Para traer un show en particular se utiliza el metodo GET para RECUPERAR, pero se debe especificar el id del show que se quiere traer en la ruta de la api.
 
El código de respuesta  es 200.

----Endpoint para crear un show(POST)---- 

/shows

Ej: http://localhost/circus/api/shows

Para agregar un show se utiliza el metodo POST para CREAR un nuevo recurso.

Para crear un show se debe escribir un JSON de esta forma en el BODY:
{
"name": "Laugh and love",
"id_artist": 77,
"date": "2022-10-21",
"price": 3000,
"artist": "krusty"
}
El id del show se creará automaticamente.

El código de respuesta es 201.

----Endpoint para eliminar un show en particular(DELETE)----

/shows/:id

Ej: http://localhost/circus/api/shows/111

Para borrar un show se utiliza el metodo DELETE para eliminar un recurso, pero se debe especificar el id del show que se quiere eliminar en la ruta de la api.

El código de respuesta  es 200.

----Endpoint para modificar  un show en particular(PUT)----

/shows/:id

Ej: http://localhost/circus/api/shows/111


Para modificar un show se utiliza el metodo PUT para EDITAR un recurso, pero se debe especificar el id del show que se quiere editar en la ruta de la api. 
En el cuerpo de la petición irá la representación completa del recurso.

Para editar un show se debe escribir un JSON de esta forma en el BODY:

{
"name": "The mysterious trip",
"id_artist": 78,
"date": "2022-10-13",
"price": 3450,
"artist": "Jack"
}

El código de respuesta  es 200.

----Endpoint para crear un token y obtener acceso(GET)----

/auth/token 

Este endpoint se utiliza para tener acceso a un token de seguridad y  de esta manera poder tener acceso a manipular los datos y realizar acciones como por ejemplo: eliminar, editar o crear un recurso.


----Endpoint para paginar----

Agregue parámetros de consulta a las solicitudes GET:

Ej: /shows?page=1&limit=10

Page se refiere a las páginas y limit refiere a que la pagina deben tener un límite de 10 elementos.

----Endpoint para clasificar----

Agregue parámetros de consulta a las solicitudes GET:

Ej: /shows?sortBy=price&order=desc

SortBy es para referir a el elemento mediante el cual se van a ordenar/clasificar los datos, y order se refiera a si el tipo de elemento se ordena de manera ascendente o descendente. Si se omite el parámetro de pedido, el orden predeterminado es ascendente.


----Endpoint para filtrar----

Agregue parámetros de consulta a las solicitudes GET:

Search refiere a una busqueda/filtro de los elementos establecidos en el sortBy.

Ej: /shows?sortBy=price&search=2020

Este ejemplo es una busqueda que filtra los precios de los shows que son igual a 2020.

Ej: /shows?sortBy=name&search=Crazy

Este ejemplo es una busqueda que filtra los nombres de los shows que sean igual a "Crazy".
