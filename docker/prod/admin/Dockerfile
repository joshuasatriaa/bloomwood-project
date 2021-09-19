# Image
FROM node:16.4.2-alpine

COPY ./admin /var/www/admin

# Set up work directory
WORKDIR /var/www/admin

# Configure host
ENV HOST=0.0.0.0

# Init command
CMD ["sh", "-c", "npm ci && npm run build && npm run start"]