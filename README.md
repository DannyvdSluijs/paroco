# Paper route complaint

## Docker
```bash
# Start the containers
$ docker-compose up -d 
$ docker-compose up -d  --build

# List the container
$ docker ps

# Start a bash terminal in the container
$ docker exec -it  b7d22f81fba6  /bin/bash 

# Stop the containers
$ docker-compose down
```


## Setup database
```sql
CREATE USER "paper-route-complaint" WITH PASSWORD 'paper-route-complaint';
CREATE DATABASE "paper-route-complaint";
ALTER DATABASE "paper-route-complaint" OWNER TO "paper-route-complaint";
```

## Generate API documentation
```bash
swagger-codegen generate -i doc/api.yml -l swagger -o public/doc
```