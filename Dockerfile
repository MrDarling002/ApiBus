FROM php:7.4-cli

WORKDIR /var/www/html

COPY . .

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]