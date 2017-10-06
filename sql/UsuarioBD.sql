Crear usuario de Base de datos.
===================================================================
1- CREATE USER 'artesanias'@'localhost' IDENTIFIED BY 'fllort2017';

Otorgar permisos a la Base de datos artesanias.
===================================================================
2- GRANT ALL PRIVILEGES ON artesanias . * TO 'artesanias'@'localhost';


**Reinician permisos en la base de datos.
===================================================================
3- FLUSH PRIVILEGES;