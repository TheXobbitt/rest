### Run in docker

1. Start docker compose
```
docker-compose up -d --build
```

2. Install composer autoloader
```
composer install
```

3. Run in postman
```
POST http://localhost/users/login
```
with credentials:
```
username: user
password: user
```

4. After that add to headers
```
Authorization - Bearer <token>
```

5. Run endpoints with articles
```
OPTIONS http://localhost/articles
GET http://localhost/articles
POST http://localhost/articles
OPTIONS http://localhost/articles/<id>
GET http://localhost/articles/<id>
PATCH http://localhost/articles/<id>
PUT http://localhost/articles/<id>
DELETE http://localhost/articles/<id>
```

### OAuth server

```
POST http://localhost:8080/token
```

Available only [Resource Owner Password Credentials](https://tools.ietf.org/html/draft-ietf-oauth-v2-13#section-4.3) grant type

API server sends http requests to OAuth server via curl and docker network.