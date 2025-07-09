# App Build
FROM us-docker.pkg.dev/element-energy/gcr.io/php:8.3-frankenphp

ARG GITHUB_TOKEN

# Copy Configuration
RUN sed -i 's/{$SERVER_NAME:localhost}/:{$PORT}/' /etc/caddy/Caddyfile && \
    sed -i '/CADDY_GLOBAL_OPTIONS/a http_port {$PORT}' /etc/caddy/Caddyfile && \
    sed -i '/http_port/a servers :{$PORT} {\nprotocols h1 h2 h2c h3\n}' /etc/caddy/Caddyfile

# Add Config
COPY .docker/php-upload.ini /usr/local/etc/php/conf.d/php-upload.ini

# Add application
COPY . .

# Add Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Dependencies
RUN composer config -g github-oauth.github.com $GITHUB_TOKEN && \
    composer install --optimize-autoloader --no-dev
