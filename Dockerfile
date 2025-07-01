# App Build
FROM us-docker.pkg.dev/alias-cloud/gcr.io/php:8.3-frankenphp

RUN sed -i 's/{$SERVER_NAME:localhost}/:{$PORT}/' /etc/caddy/Caddyfile && \
    sed -i '/CADDY_GLOBAL_OPTIONS/a http_port {$PORT}' /etc/caddy/Caddyfile && \
    sed -i '/http_port/a servers :{$PORT} {\nprotocols h1 h2 h2c h3\n}' /etc/caddy/Caddyfile

# Add application
COPY . .

# Add Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Dependencies
RUN chmod +x /usr/local/bin/docker-configure && \
    composer install --optimize-autoloader --no-dev
