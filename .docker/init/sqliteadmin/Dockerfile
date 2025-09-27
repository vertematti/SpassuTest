FROM joseluisq/php-fpm:8.3 AS sqliteadmin

RUN adduser --uid 1000 --disabled-password appuser
RUN adduser www-data appuser

EXPOSE 80

USER appuser

WORKDIR /var/www/html

CMD php -S 0.0.0.0:80 -t .
