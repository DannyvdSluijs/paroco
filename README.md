# Paper route complaint

## Database
```sql
CREATE USER "paper-route-complaint" WITH PASSWORD 'paper-route-complaint';
CREATE DATABASE "paper-route-complaint";
ALTER DATABASE "paper-route-complaint" OWNER TO "paper-route-complaint";
```

## Generate API documentation
```bash
swagger-codegen generate -i doc/api.yml -l swagger -o public/doc
```
