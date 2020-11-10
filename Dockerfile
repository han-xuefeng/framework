FROM php:7.3-cli

COPY . /framework
WORKDIR /framework
CMD ["php", "-S", "0.0.0.0:8899"]