

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



