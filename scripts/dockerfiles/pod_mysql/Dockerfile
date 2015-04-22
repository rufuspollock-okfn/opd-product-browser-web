# VERSION:        0.1
# DESCRIPTION:    Create container for initial import of product database
# AUTHOR:         Daniel Fowler <me@danfowler.net>
# COMMENTS:
#   This file installs a simple mysql database using the official mysql base image.
#   MySQL 5.6 was the current stable version when written.
# USAGE:
#
#   docker run -v /var/lib/mysql --name pod_dbdata mysql:5.6 true
#
#   ## build container
#   docker build -t pod_mysql .
#
#   ## use data-only container
#   docker run -d --name pod_db --volumes-from pod_dbdata -e MYSQL_ROOT_PASSWORD=<somerootpw> -e MYSQL_PASSWORD=<someuserpw> pod_mysql
#
#   ## initial import of product database (provided separately)
#   docker run -it --name pod_db_import --link pod_db:mysql --rm pod_mysql sh -c 'exec mysql -h"$MYSQL_PORT_3306_TCP_ADDR" -P"$MYSQL_PORT_3306_TCP_PORT" -uroot -p"$MYSQL_ENV_MYSQL_ROOT_PASSWORD" "$MYSQL_ENV_MYSQL_DATABASE" < products.sql'
#
#   ## check database
#   docker run -it --name pod_db_check --link pod_db:mysql --rm pod_mysql sh -c 'exec mysql -h"$MYSQL_PORT_3306_TCP_ADDR" -P"$MYSQL_PORT_3306_TCP_PORT" -uroot -p"$MYSQL_ENV_MYSQL_ROOT_PASSWORD" "$MYSQL_ENV_MYSQL_DATABASE"'

FROM mysql:5.6
MAINTAINER Daniel Fowler <me@danfowler.net>
ENV MYSQL_DATABASE products
ENV MYSQL_USER pod_web
ADD /products.sql /products.sql
