# VERSION:        0.1
# DESCRIPTION:    Create container for hosting Product Open Data PHP app
# AUTHOR:         Daniel Fowler <me@danfowler.net>
# COMMENTS:
#   This file installs a container for the POD webserver based on the official PHP (with Apache) container.
# USAGE:
#
#   ## build container
#      docker build -t pod_php_apache .
#
#   ## clone product-browser-web repo
#      git clone https://github.com/okfn/product-browser-web.git
#
#   ## run website pointing to location of repo, linking to the MySQL container
#      docker run -d -p 18080:80 --link pod_db:pod_db --name pod_web -v <path-to-repo>/explorer/:/var/www/html/ pod_php_apache

FROM php:5.6-apache
COPY config/php.ini /usr/local/etc/php/
COPY config/apache2.conf /etc/apache2/
RUN apt-get update
RUN apt-get install -y php5-mysql
RUN docker-php-ext-install mysql
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/
RUN ln -s /etc/apache2/mods-available/ratelimit.load /etc/apache2/mods-enabled/
