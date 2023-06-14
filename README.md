# CRUD-php-simple (PROYECTO NO COMPLETO)

Version php: 8.2.4

Para el desarrollo de este proyecto se utilizó la aplicación XAMPP para crear un servidor Web de forma local (Servidor Apache, utilizando el puerto 80), también se utilizo el gestor de bases de datos phpmyadmin (Inyecciones SQL por el puerto 3306) para almacenar la información del sistema.

El modelo de la base de datos para este proyecto está compuesto por tres tablas principales: bodegas, productos y productosbodegas. La tabla bodegas contiene la información básica de cada bodega, incluyendo su identificador único (id_bodega) y su nombre (nombre_bodega). La tabla productos, por su parte, almacena la información de los productos que pueden ser almacenados en las bodegas. Cada producto tiene un identificador único (id_producto), su nombre (nombre_producto) y una descripción detallada (detalle_producto).
Finalmente, la tabla productosbodegas establece la relación entre los productos y las bodegas. Para ello, cada fila de la tabla contiene un identificador único del producto (id_producto) y de la bodega (id_bodega) a la que pertenece, así como la cantidad de stock disponible (stock) para ese producto en esa bodega en particular.

El archivo creacion_BD permite crear la BD y sus tablas junto con sus atributos y claves.
