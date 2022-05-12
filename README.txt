

Pasos para implementar este "sistema" en Docker:

1. Verificamos las imágenes existentes:
C:\desarrollo\docker-curriculum\flask-app>docker images
REPOSITORY                     TAG         IMAGE ID       CREATED        SIZE
sbeltran2006/catnip            latest      25d692d6c07a   46 hours ago   931MB
<none>                         <none>      68ca6c967f3c   47 hours ago   931MB
getting-started                latest      33ced2f05da3   5 days ago     179MB
<none>                         <none>      19d24d3c33c9   5 days ago     179MB
<none>                         <none>      f786d53fce52   8 days ago     452MB
mysql                          5.7         05311a87aeb4   2 weeks ago    450MB
ubuntu                         latest      ff0fea8310f3   2 weeks ago    72.8MB
ubuntu                         18.04       b67d6ac264e4   2 weeks ago    63.2MB
busybox                        latest      2fb6fc2d97e1   3 weeks ago    1.24MB
empezando2                     v1.1.0      dfabe86d4174   3 weeks ago    401MB
empezando                      latest      dfabe86d4174   3 weeks ago    401MB
sbeltran2006/empezando2        v1.1.0      dfabe86d4174   3 weeks ago    401MB
sbeltran2006/getting-started   latest      dfabe86d4174   3 weeks ago    401MB
<none>                         <none>      1727d01b5778   3 weeks ago    401MB
node                           12-alpine   1b156b4c3ee8   2 months ago   91MB
docker101tutorial              latest      6b15ae3e878d   2 months ago   28.8MB
quay.io/keycloak/keycloak      16.1.1      011a708d97bf   2 months ago   759MB
alpine/git                     latest      c6b70534b534   4 months ago   27.4MB
nicolaka/netshoot              latest      f4c8dceca780   4 months ago   432MB
hello-world                    latest      feb5d9fea6a5   6 months ago   13.3kB
prakhar1989/static-site        latest      f01030e1dcf3   6 years ago    134MB

2. Si no existe, descargar imagen php apache, en este caso la versión 8.0.12 de php
docker pull php:8.0.12-apache

3. imagen ahora existe en nuestra local:
C:\desarrollo\docker-curriculum\flask-app>docker images
REPOSITORY                     TAG             IMAGE ID       CREATED        SIZE
sbeltran2006/catnip            latest          25d692d6c07a   46 hours ago   931MB
<none>                         <none>          68ca6c967f3c   47 hours ago   931MB
getting-started                latest          33ced2f05da3   5 days ago     179MB
<none>                         <none>          19d24d3c33c9   5 days ago     179MB
<none>                         <none>          f786d53fce52   8 days ago     452MB
mysql                          5.7             05311a87aeb4   2 weeks ago    450MB
ubuntu                         latest          ff0fea8310f3   2 weeks ago    72.8MB
ubuntu                         18.04           b67d6ac264e4   2 weeks ago    63.2MB
busybox                        latest          2fb6fc2d97e1   3 weeks ago    1.24MB
empezando                      latest          dfabe86d4174   3 weeks ago    401MB
sbeltran2006/empezando2        v1.1.0          dfabe86d4174   3 weeks ago    401MB
sbeltran2006/getting-started   latest          dfabe86d4174   3 weeks ago    401MB
empezando2                     v1.1.0          dfabe86d4174   3 weeks ago    401MB
<none>                         <none>          1727d01b5778   3 weeks ago    401MB
node                           12-alpine       1b156b4c3ee8   2 months ago   91MB
docker101tutorial              latest          6b15ae3e878d   2 months ago   28.8MB
quay.io/keycloak/keycloak      16.1.1          011a708d97bf   2 months ago   759MB
alpine/git                     latest          c6b70534b534   4 months ago   27.4MB
nicolaka/netshoot              latest          f4c8dceca780   4 months ago   432MB
php                            8.0.12-apache   4dddd776d2b7   4 months ago   472MB  ******** IMAGEN PHP **********
hello-world                    latest          feb5d9fea6a5   6 months ago   13.3kB
prakhar1989/static-site        latest          f01030e1dcf3   6 years ago    134MB


4. Crear archivo Dockerfile en la raíz de este proyecto

5. Agregarle la imagen base:
FROM php:8.0.12-apache

6. Setear directorio de trabajo:
WORKDIR /usr/src/app

7. Probar creación de imagen empleando Dockerfile:
docker build -t sbeltran2006/phpsimple .


C:\desarrollo\docker-curriculum\flask-app>docker build -t sbeltran2006/phpsimple .
[+] Building 3.0s (10/10) FINISHED
 => [internal] load build definition from Dockerfile                                                               0.1s
 => => transferring dockerfile: 32B                                                                                0.0s
 => [internal] load .dockerignore                                                                                  0.0s
 => => transferring context: 2B                                                                                    0.0s
 => [internal] load metadata for docker.io/library/python:3                                                        2.7s
 => [auth] library/python:pull token for registry-1.docker.io                                                      0.0s
 => [1/4] FROM docker.io/library/python:3@sha256:555f5affd32250ca74758b297f262fa8f421eb0102877596b48c0b8b464606ea  0.0s
 => [internal] load build context                                                                                  0.0s
 => => transferring context: 200B                                                                                  0.0s
 => CACHED [2/4] WORKDIR /usr/src/app                                                                              0.0s
 => CACHED [3/4] COPY . .                                                                                          0.0s
 => CACHED [4/4] RUN pip install --no-cache-dir -r requirements.txt                                                0.0s
 => exporting to image                                                                                             0.0s
 => => exporting layers                                                                                            0.0s
 => => writing image sha256:25d692d6c07a313738b41fc9341382e5369613b2f2db6df629c9acedc2bda7a4                       0.0s
 => => naming to docker.io/sbeltran2006/phpsimple                                                                  0.0s

8. Agregar a Dockerfile la copia de archivos php:
COPY . .

9. Probar la creación de imagen:
docker build -t sbeltran2006/phpsimple .
(funciona)

10. Verificar el contenido de la imagen.
docker run -it sbeltran2006/phpsimple sh
(hallé que el contenido no es el correcto. Directorio actual equivocado)

11. Al cambiar en CMD al directorio para este proyecto, se corrige el problema.

12. Probamos a crear el container, y probamos accesar desde el browser:
docker run -d --name phpsimple --rm sbeltran2006/phpsimple
(se crea container, pero no es accesible desde el browser)

13. Abrimos puerto 80 en Dockerfile:
EXPOSE 80

14. Probamos a ejecutar container, mapeando puerto 5000 al puerto 80 del container:
docker run -d --name phpsimple --rm -p 5000:80 sbeltran2006/phpsimple

15. Verificamos servidor en browser. Al ingresar a http://localhost:5000/ obtenemos:
********************************
Forbidden

You don't have permission to access this resource.
Apache/2.4.51 (Debian) Server at localhost Port 5000
********************************

16. Al ingresar a http://localhost:5000/index.php obtenemos:

********************************
Not Found

The requested URL was not found on this server.
Apache/2.4.51 (Debian) Server at localhost Port 5000
********************************

17. Revisamos contenido del container:
docker run -it --name phpsimple --rm sbeltran2006/phpsimple sh
(contenido php se copió a carpeta default ls /usr/src/app )

18. Corregimos path de copia de archivos php a la imagen:
COPY . /var/www/html
en vez de: COPY . .

19. Regeneramos imagen:
docker build -t sbeltran2006/phpsimple .

20. Revisamos contenido de imagen:
docker run -it --rm --name phpsimple sbeltran2006/phpsimple sh
ls /var/www/html
(contenido aparece en la carpeta correcta)

21. Creamos container 
docker run -d --rm --name phpsimple -p 5000:80 sbeltran2006/phpsimple

22. Al probar en el browser con url: 
http://localhost:5000/
obtenemos:
hola todos 
(que es la salida esperada, funciona el contenedor)

23. Tratamos de crear un bind mount, pero no funciona:
docker run -d --rm --name phpsimple -p 5000:80 --mount type=bind,source="$(pwd)",target=/var/www/html,readonly sbeltran2006/phpsimple
Error: 
docker: Error response from daemon: invalid mount config for type "bind": invalid mount path: '$(pwd)' mount path must be absolute.

24. El problema es el comando para obtener directorio actual en Windows:
docker run -d --rm --name phpsimple -p 5000:80 --mount type=bind,source=%cd%,target=/var/www/html,readonly sbeltran2006/phpsimple
Funciona, y podemos cambiar el código fuente, y los cambios se reflejan en el contenedor al instante.

25. Crear archivo docker-compose.yml, empleando datos del Dockerfile:
 version: "3.7"

 services:
   app:
     image: php:8.0.12-apache
     ports:
       - 5000:80
     working_dir: /usr/src/app
     volumes:
       - ./:/var/www/html

26. Probamos a crear el contenedor usando:
docker-compose up -d
(funciona, y muestra al instante cambios realizados en el código)

27. Agregamos la opción build al archivo docker-compose.yml, para que se reconstruya la imagen al crear el contenedor:
 version: "3.7"

 services:
   app:
     image: php:8.0.12-apache
     ports:
       - 5000:80
     working_dir: /usr/src/app
     volumes:
       - ./:/var/www/html
     build: .

28. Al crear el contenedor con:
docker-compose up -d
obtenemos:
C:\desarrollo\pruebasDocker\phpsimple>docker-compose up -d
Creating network "phpsimple_default" with the default driver
Creating phpsimple_app_1 ... done

si no se está ejecutando el contenedor,
y obtenemos:
C:\desarrollo\pruebasDocker\phpsimple>docker-compose up -d
Recreating phpsimple_app_1 ... done

si contenedor ya existe (se está ejecutando)

29. Se quiere subir contenedor a Docker Hub. Para esto nos logueamos:
docker login -u sbeltran2006

30. Revisamos que la imagen que queremos subir exista:
docker image ls

C:\desarrollo\pruebasDocker\phpsimple>docker image ls
REPOSITORY                     TAG             IMAGE ID       CREATED        SIZE
sbeltran2006/phpsimple         latest          ebec8ab7d4d6   2 weeks ago    472MB  ***** esta es la imagen que deseamos subir *****
<none>                         <none>          b114e479bcaa   2 weeks ago    472MB
<none>                         <none>          a464ee6df0a3   2 weeks ago    472MB
sbeltran2006/catnip            latest          25d692d6c07a   2 weeks ago    931MB
<none>                         <none>          68ca6c967f3c   2 weeks ago    931MB
getting-started                latest          33ced2f05da3   2 weeks ago    179MB
<none>                         <none>          19d24d3c33c9   2 weeks ago    179MB
<none>                         <none>          f786d53fce52   3 weeks ago    452MB
mysql                          5.7             05311a87aeb4   5 weeks ago    450MB
ubuntu                         latest          ff0fea8310f3   5 weeks ago    72.8MB
ubuntu                         18.04           b67d6ac264e4   5 weeks ago    63.2MB
busybox                        latest          2fb6fc2d97e1   5 weeks ago    1.24MB
empezando                      latest          dfabe86d4174   6 weeks ago    401MB
sbeltran2006/empezando2        v1.1.0          dfabe86d4174   6 weeks ago    401MB
sbeltran2006/getting-started   latest          dfabe86d4174   6 weeks ago    401MB
empezando2                     v1.1.0          dfabe86d4174   6 weeks ago    401MB
<none>                         <none>          1727d01b5778   6 weeks ago    401MB
node                           12-alpine       1b156b4c3ee8   2 months ago   91MB
docker101tutorial              latest          6b15ae3e878d   2 months ago   28.8MB
quay.io/keycloak/keycloak      16.1.1          011a708d97bf   2 months ago   759MB
alpine/git                     latest          c6b70534b534   5 months ago   27.4MB
nicolaka/netshoot              latest          f4c8dceca780   5 months ago   432MB
php                            8.0.12-apache   4dddd776d2b7   5 months ago   472MB
hello-world                    latest          feb5d9fea6a5   7 months ago   13.3kB
prakhar1989/static-site        latest          f01030e1dcf3   6 years ago    134MB

31. Subimos imagen al repositorio:
docker push sbeltran2006/phpsimple

C:\desarrollo\pruebasDocker\phpsimple>docker push sbeltran2006/phpsimple
Using default tag: latest
The push refers to repository [docker.io/sbeltran2006/phpsimple]
a4140bb59f0a: Pushed
4be644658cc9: Pushed
7b5eb093b035: Mounted from library/php
3d86bd5a0419: Mounted from library/php
67713fca8afe: Mounted from library/php
8e85e636e3ec: Mounted from library/php
09e526f92ecf: Mounted from library/php
54fb4943fe5f: Mounted from library/php
17398fc120fa: Mounted from library/php
cfa11f06a213: Mounted from library/php
8f477d20e632: Mounted from library/php
658dc28b7c93: Mounted from library/php
89a3f58688e1: Mounted from library/php
3af749400b4a: Mounted from library/php
e1bbcf243d0e: Mounted from library/php
latest: digest: sha256:79cb139247b2139b6e84edd47f0f11ad0e17d1b945accd59f83fd848de351e39 size: 3451

32. En https://labs.play-with-docker.com, probamos a ejecutar proyecto usando docker-compose, pero no funciona:
docker-compose up -d
Error: can´t find any configuration file in this directory or any parent. Are you in the right directory?

33. Probamos a ejecutarlo de la manera tradicional:
docker run -d --rm --name phpsimple -p 5000:80 sbeltran2006/phpsimple
(funciona, pero Play with Docker no permite copiar salida)

Al abrir página en puerto 5000 en Play with Docker, obtenemos:
hola todos 
que no es la salida esperada (pues el código cambió). Esto indica que los pasos anteriores no re-crearon la imagen.

34. Procedemos a re-construir la imagen:
docker build -t sbeltran2006/phpsimple .

35. La subimos a Docker Hub:
docker push sbeltran2006/phpsimple

36. Al volver a ejecutar el comando para crear el container
docker run -d --rm --name phpsimple -p 5000:80 sbeltran2006/phpsimple

obtenemos que ya existe el contenedor (porque ya lo habíamos ejecutado antes)

37. Verificamos que el contenedor ya existe:
docker ps

Al volver a ejecutar el contenedor, hallamos que no se ha actualizado. Tal vez hay que descargar la imagen de nuevo en el Play with Docker.

38. Al retirar de docker-compose.yml las líneas:

     volumes:
       - ./:/var/www/html
       
y ejecutar el contenedor usando:
docker-compose up -d

obtenemos error Forbidden You don't have permission to access this resource.
debido a que no existe el archivo index (nunca se copió, porque quitamos el mapeo del volumen)


39. Retiramos imagen de docker-compose:
     image: php:8.0.12-apache

y ejecutamos comando:
docker-compose up -d

C:\desarrollo\pruebasDocker\phpsimple>docker-compose up -d
Building app
[+] Building 0.6s (8/8) FINISHED
 => [internal] load build definition from Dockerfile                                                               0.1s
 => => transferring dockerfile: 277B                                                                               0.0s
 => [internal] load .dockerignore                                                                                  0.1s
 => => transferring context: 2B                                                                                    0.0s
 => [internal] load metadata for docker.io/library/php:8.0.12-apache                                               0.0s
 => [1/3] FROM docker.io/library/php:8.0.12-apache                                                                 0.0s
 => [internal] load build context                                                                                  0.2s
 => => transferring context: 121.13kB                                                                              0.1s
 => CACHED [2/3] WORKDIR /usr/src/app                                                                              0.0s
 => [3/3] COPY . /var/www/html                                                                                     0.1s
 => exporting to image                                                                                             0.1s
 => => exporting layers                                                                                            0.1s
 => => writing image sha256:4cf524f6586cd6c0a23fa85790f7d3a05d3e6fa266d2f5a9abbf3b9ea02cc549                       0.0s
 => => naming to docker.io/library/phpsimple_app                                                                   0.0s
WARNING: Image for service app was built because it did not already exist. To rebuild this image you must use `docker-compose build` or `docker-compose up --build`.
Recreating phpsimple_app_1 ... done

Al probar este container en el browser hallamos que sigue funcionando como bind mount (cambios locales se reflejan inmediatamente)

40. Revisamos contenido de imagen:
docker run -it --rm --name phpsimple sbeltran2006/phpsimple sh

en el shell que se abre, mostramos el contenido del archivo index.php:
cat /var/www/html/index.php

# cat /var/www/html/index.php
<html>
    <body>
        <? echo "hola todos con bind mount, y docker compose"; ?>

    </body>
</html>

y vemos que no tiene ninguno de los cambios recientes. Debería obtener:

<? echo "hola todos con bind mount, y docker compose 4"; ?>

41. Al probar el comando:
docker-compose up --build -d

que debe hacer build de la imagen, obtenemos:

C:\desarrollo\pruebasDocker\phpsimple>docker-compose up --build -d
Creating network "phpsimple_default" with the default driver
Building app
[+] Building 0.4s (8/8) FINISHED
 => [internal] load build definition from Dockerfile                                                               0.0s
 => => transferring dockerfile: 32B                                                                                0.0s
 => [internal] load .dockerignore                                                                                  0.0s
 => => transferring context: 2B                                                                                    0.0s
 => [internal] load metadata for docker.io/library/php:8.0.12-apache                                               0.0s
 => [1/3] FROM docker.io/library/php:8.0.12-apache                                                                 0.0s
 => [internal] load build context                                                                                  0.1s
 => => transferring context: 27.87kB                                                                               0.1s
 => CACHED [2/3] WORKDIR /usr/src/app                                                                              0.0s
 => [3/3] COPY . /var/www/html                                                                                     0.1s
 => exporting to image                                                                                             0.1s
 => => exporting layers                                                                                            0.1s
 => => writing image sha256:433776aab465d9f2f6630c06047def5b065f9e434b9afdc8996e099c06648102                       0.0s
 => => naming to docker.io/library/phpsimple_app                                                                   0.0s
Creating phpsimple_app_1 ... done

La línea: 
 => [3/3] COPY . /var/www/html         
indica que sí se realizó la copia de archivos


42. Revisamos contenido de imagen:
docker run -it --rm --name phpsimple sbeltran2006/phpsimple sh

en el shell que se abre, mostramos el contenido del archivo index.php:
cat /var/www/html/index.php

# cat /var/www/html/index.php
<html>
    <body>
        <? echo "hola todos con bind mount, y docker compose"; ?>

    </body>
</html>

Vemos que el código aún no se ha actualizado. 
Tal vez estamos revisando la imagen equivocada.

Efectivamente, el nombre de la imagen es incorrecto. Al revisar las imagenes creadas usando el comando:
docker image list

obtenemos:

C:\desarrollo\pruebasDocker\phpsimple>docker image list
REPOSITORY                     TAG             IMAGE ID       CREATED          SIZE
phpsimple_app                  latest          433776aab465   34 minutes ago   472MB
<none>                         <none>          4cf524f6586c   44 minutes ago   472MB
sbeltran2006/phpsimple         latest          1183216fcfc9   2 weeks ago      472MB
sbeltran2006/phpsimple         <none>          ebec8ab7d4d6   4 weeks ago      472MB
<none>                         <none>          b114e479bcaa   4 weeks ago      472MB
<none>                         <none>          a464ee6df0a3   4 weeks ago      472MB
sbeltran2006/catnip            latest          25d692d6c07a   5 weeks ago      931MB
<none>                         <none>          68ca6c967f3c   5 weeks ago      931MB
getting-started                latest          33ced2f05da3   5 weeks ago      179MB
<none>                         <none>          19d24d3c33c9   5 weeks ago      179MB
<none>                         <none>          f786d53fce52   6 weeks ago      452MB
mysql                          5.7             05311a87aeb4   7 weeks ago      450MB
ubuntu                         latest          ff0fea8310f3   7 weeks ago      72.8MB
ubuntu                         18.04           b67d6ac264e4   7 weeks ago      63.2MB
busybox                        latest          2fb6fc2d97e1   8 weeks ago      1.24MB
empezando2                     v1.1.0          dfabe86d4174   2 months ago     401MB
empezando                      latest          dfabe86d4174   2 months ago     401MB
sbeltran2006/empezando2        v1.1.0          dfabe86d4174   2 months ago     401MB
sbeltran2006/getting-started   latest          dfabe86d4174   2 months ago     401MB
<none>                         <none>          1727d01b5778   2 months ago     401MB
node                           12-alpine       1b156b4c3ee8   3 months ago     91MB
docker101tutorial              latest          6b15ae3e878d   3 months ago     28.8MB
quay.io/keycloak/keycloak      16.1.1          011a708d97bf   3 months ago     759MB
alpine/git                     latest          c6b70534b534   5 months ago     27.4MB
nicolaka/netshoot              latest          f4c8dceca780   5 months ago     432MB
php                            8.0.12-apache   4dddd776d2b7   5 months ago     472MB
hello-world                    latest          feb5d9fea6a5   7 months ago     13.3kB
prakhar1989/static-site        latest          f01030e1dcf3   6 years ago      134MB


Al ejecutar el comando corregido:
docker run -it --rm --name phpsimple phpsimple_app sh

obtenemos:
C:\desarrollo\pruebasDocker\phpsimple>docker run -it --rm --name phpsimple phpsimple_app sh
# cat /var/www/html/index.php
<html>
    <body>
        <? echo "hola todos con bind mount, y docker compose 4"; ?>

    </body>
</html>

donde vemos que el código sí está actualizado:
<? echo "hola todos con bind mount, y docker compose 4"; ?>

Puesto que el nombre de la imagen no era el esperado, eso nos lleva a revisar si hay forma de indicar el nombre de la imagen requerido

43. Agregamos la línea:

     image: sbeltran2006/phpsimple
al docker-compose.yml

44. Al ejecutar el comando:
docker-compose up -d
notamos que la imagen no se ha actualizado (aparece creada hace 55 min)

45. Al ejecutar el comando:
docker-compose up --build -d
notamos que sí se realiza la regeneració de la imagen:

C:\desarrollo\pruebasDocker\phpsimple>docker-compose up --build -d
Building app
[+] Building 0.5s (8/8) FINISHED
 => [internal] load build definition from Dockerfile                                                               0.0s
 => => transferring dockerfile: 32B                                                                                0.0s
 => [internal] load .dockerignore                                                                                  0.0s
 => => transferring context: 2B                                                                                    0.0s
 => [internal] load metadata for docker.io/library/php:8.0.12-apache                                               0.0s
 => [1/3] FROM docker.io/library/php:8.0.12-apache                                                                 0.0s
 => [internal] load build context                                                                                  0.1s
 => => transferring context: 52.68kB                                                                               0.1s
 => CACHED [2/3] WORKDIR /usr/src/app                                                                              0.0s
 => [3/3] COPY . /var/www/html                                                                                     0.1s
 => exporting to image                                                                                             0.1s
 => => exporting layers                                                                                            0.1s
 => => writing image sha256:e961aa14be1e8164b0831f1cd09ea619808c195d2a18733fc2c46b3ec6b97f2c                       0.0s
 => => naming to docker.io/sbeltran2006/phpsimple                                                                  0.0s
Recreating phpsimple_app_1 ... done

C:\desarrollo\pruebasDocker\phpsimple>docker image list
REPOSITORY                     TAG             IMAGE ID       CREATED              SIZE
sbeltran2006/phpsimple         latest          e961aa14be1e   About a minute ago   472MB
phpsimple_app                  latest          433776aab465   57 minutes ago       472MB

46. Al revisar el contenido de la imagen:
docker run -it --rm --name phpsimple sbeltran2006/phpsimple sh
cat /var/www/html/index.php

obtenemos:

# cat /var/www/html/index.php
<html>
    <body>
        <? echo "hola todos con bind mount, y docker compose 5"; ?>

    </body>
</html>

lo que muestra el contenido actualizado.

47. El comando:
docker inspect af0992e0a4df
obtiene información sobre el contenedor indicado por su ID:

C:\desarrollo\pruebasDocker\phpsimple>docker inspect af0992e0a4df
[
    {
        "Id": "af0992e0a4df7a855c32559cc6e04823e106cb4dade94051f712268c0436d74d",
        "Created": "2022-05-10T15:02:52.758318939Z",
        "Path": "docker-php-entrypoint",
        "Args": [
            "apache2-foreground"
        ],
        "State": {
            "Status": "running",
            "Running": true,
            "Paused": false,
            "Restarting": false,

... (salida recortada)

48. Ahora nos logueamos en Docker Hub para subir la imagen recien creada:
docker login -u sbeltran2006

y subimos imagen al repositorio:
docker push sbeltran2006/phpsimple

49. En https://labs.play-with-docker.com probamos a ejecutar el contenedor:
docker run -d --rm --name phpsimple -p 5000:80 sbeltran2006/phpsimple

y al ejecutar el contenedor en el browser obtenemos la salida actualizada:
hola todos con bind mount, y docker compose 5 

Con eso confirmamos que el contenedor se ejecuta igual en ambientes distintos.

50. Al volver la imagen a su valor anterior:

     image: php:8.0.12-apache

observamos que ese valor no influye en si se guarda o no el código actualizado. Sin embargo, conviene usar el tag imagen 
para darle nombre a la imagen generada


51. Al cambiarle el valor al tag image:
image: sbeltran2006/phpsimple22
noto que siempre se trata de un nombre que se le da a esta imagen. No tiene nada que ver con el nombre de la imagen inicial 
presente en el Dockerfile.

52. Al comentar la línea:
COPY . /var/www/html
en el Dockerfile, y haciendo:
docker-compose up --build -d
y revisando el contenedor:
docker run -it sbeltran2006/phpsimple sh
verificamos que el código no se ha actualizado. Esto indica que el Dockerfile influye en la creación de la imagen.
docker-compose.yml no reemplaza al Dockerfile.

53. Comandos:
-Get bash interactive shell for a running container (ejecutar shell en container dado):
docker exec -it <container> bash

-Crear referencia a imagen existente (crear un tag):
docker tag sbeltran2006/phpsimple22 sbeltran2006/phpsimple33
docker tag source target

-Loguearse en Docker Hub:
docker login -u sbeltran2006

C:\desarrollo\pruebasDocker\phpsimple>docker login -u sbeltran2006
Password:
Login Succeeded

Logging in with your password grants your terminal complete access to your account.
For better security, log in with a limited-privilege personal access token. Learn more at https://docs.docker.com/go/access-tokens/

-Eliminar un contenedor:
docker rm 37047e7bab6d
C:\desarrollo\pruebasDocker\phpsimple>docker rm 37047e7bab6d
Error response from daemon: You cannot remove a running container 37047e7bab6d1cdbef57a7e16a03fa26116147a231fdc9690fe4b756b9ec1a3c. Stop the container before attempting removal or force remove

Al usar -f forzamos la eliminación:
C:\desarrollo\pruebasDocker\phpsimple>docker rm -f 37047e7bab6d
37047e7bab6d

-Remover todos los containers stopped:
docker container prune

-Obtener la versión de Docker:
docker version

C:\desarrollo\pruebasDocker\phpsimple>docker version
Client:
 Cloud integration: v1.0.22
 Version:           20.10.12
 API version:       1.41
 Go version:        go1.16.12
 Git commit:        e91ed57
 Built:             Mon Dec 13 11:44:07 2021
 OS/Arch:           windows/amd64
 Context:           default
 Experimental:      true

Server: Docker Engine - Community
 Engine:
  Version:          20.10.12
  API version:      1.41 (minimum version 1.12)
  Go version:       go1.16.12
  Git commit:       459d0df
  Built:            Mon Dec 13 11:43:56 2021
  OS/Arch:          linux/amd64
  Experimental:     false
 containerd:
  Version:          1.4.12
  GitCommit:        7b11cfaabd73bb80907dd23182b9347b4245eb5d
 runc:
  Version:          1.0.2
  GitCommit:        v1.0.2-0-g52b36a2
 docker-init:
  Version:          0.19.0
  GitCommit:        de40ad0


-Listar containers:
docker container ls

C:\desarrollo\pruebasDocker\phpsimple>docker container ls
CONTAINER ID   IMAGE                    COMMAND                  CREATED          STATUS         PORTS                  NAMES
9e1661113503   sbeltran2006/phpsimple   "docker-php-entrypoi…"   10 seconds ago   Up 9 seconds   0.0.0.0:5000->80/tcp   phpsimple_app_1

-Ver puertos locales asignados por docker a un container:
docker port 9e1661113503

C:\desarrollo\pruebasDocker\phpsimple>docker port 9e1661113503
80/tcp -> 0.0.0.0:5000

-Para detener un container:
docker stop 9e1661113503

C:\desarrollo\pruebasDocker\phpsimple>docker stop 9e1661113503
9e1661113503


-Listar todas las imágenes de Docker:
docker images

C:\desarrollo\pruebasDocker\phpsimple>docker images
REPOSITORY                     TAG             IMAGE ID       CREATED        SIZE
sbeltran2006/phpsimple         latest          55ad6613ab41   24 hours ago   472MB
<none>                         <none>          2636dc163922   24 hours ago   472MB
sbeltran2006/phpsimple22       latest          2b0d4415beb6   24 hours ago   472MB
sbeltran2006/phpsimple33       latest          2b0d4415beb6   24 hours ago   472MB

-Realizar docker compose, que es el comando actualizado:
docker compose up -d

C:\desarrollo\pruebasDocker\phpsimple>docker compose up -d
[+] Running 1/1
 - Container phpsimple-app-1  Started                                                                               1.4s

-Tener varios archivos de configuración, aplicados uno sobre el otro:
docker-compose -f docker-compose.yml -f production.yml up -d


