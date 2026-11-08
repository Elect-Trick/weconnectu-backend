version: '3.8'

services:
  
  app:
    image: electrick/weconnectu-proj:latest
    environment:
      ENVIRONMENT: prod
      DB_HOST: weconnectu.c3a0ik2ww8wh.eu-north-1.rds.amazonaws.com
      DB_PORT: "3306"
      DB_NAME: weconnectu
      DB_PASSWORD: majenje1010
      DB_USERNAME: njax
      AWS_REGION: eu-north-1
    ports:
      - "80:80"
    restart: unless-stopped
#    volumes:
#      - ./src:/var/www/html

  # The MySQL Database
#  users-db:
#    image: mysql:8.0ls
#    restart: unless-stopped
#    container_name: users-db
#    environment:
#      MYSQL_ROOT_PASSWORD: coffee
#      MYSQL_DATABASE: weconnectu
#      MYSQL_USER: njax
#      MYSQL_PASSWORD: coffee
#    ports:
#      - "3306:3306"
#    volumes:
#      - mysql_data:/var/lib/mysql
#      - ./schema.sql:/docker-entrypoint-initdb.d/schema.sql:ro
#
#volumes:
#  mysql_data: