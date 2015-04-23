Product Open Data
=================

This is a repository of code, documentation and database scripts for
the Product Open Data project currently hosted at
http://product-open-data.com/.  The goal of Product Open Data is to
build a public database of product data.  For more information, please
visit http://product.okfn.org.

The code is written in PHP with a MySQL database backend.


Dockerized Development Instance
-------------------------------

### Prerequisites

Make sure you have [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/) installed.

### Clone this repository

`git clone https://github.com/okfn/product-browser-web.git`

### Run the setup script

```
cd product-browser-web/scripts/dockerfiles
wget -O - http://dfowler.sixbit.org/products.sql.gz | \
  gunzip -c > pod_mysql/products.sql
docker-compose --project-name pod up
```

### Import the database

```
docker exec pod_db_1 sh -c \
  'mysql -uroot -p"$MYSQL_ROOT_PASSWORD" \
  "$MYSQL_DATABASE" < products.sql'
```

### Access the local development instance

Your local copy of Product Open Data should now be running on port 18080 of your Docker host.
