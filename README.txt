

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
