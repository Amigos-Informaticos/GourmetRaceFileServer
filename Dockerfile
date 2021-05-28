FROM php:7-alpine3.13

RUN mkdir -p /usr/gourmetRace

COPY . /usr/gourmetRace

WORKDIR /usr/gourmetRace

CMD ["php", "index.php"]
