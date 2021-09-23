# Image
FROM node:14.17-alpine
RUN apk add g++ make python3

COPY ./admin /var/www/admin

# Set up work directory
WORKDIR /var/www/admin

# Configure host
ENV HOST=0.0.0.0

# Init command
CMD ["sh", "-c", "npm ci && npm run build && npm run start"]