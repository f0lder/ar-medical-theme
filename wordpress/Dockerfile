# Use the official WordPress image as the base image
FROM wordpress:6.2.2-apache

# Install Node.js and npm
RUN apt-get update && \
    apt-get install -y curl && \
    curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get install -y nodejs && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Set the working directory to the default WordPress directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Start the WordPress server
CMD ["apache2-foreground"]