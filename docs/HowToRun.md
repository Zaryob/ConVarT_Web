## Docker Compose

In this project, for tesing while development, `docker-compose`. To test it:

```bash
cp examples/config_docker.php ./config.php
cp examples/htaccess_docker ./.htaccess

docker-compose up 
mysql -h 127.0.0.1 -P 3306  convart -u convart -p < examples/clinvar.sql
mysql -h 127.0.0.1 -P 3306  convart -u convart -p < examples/msa.sql

```

Just open the 
* http://localhost:8000 for Convart
* http://localhost:8001 for phpMyAdmin