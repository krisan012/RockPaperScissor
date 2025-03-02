# Build Stage
FROM node:18 AS builder

WORKDIR /app

# Copy package.json and install dependencies
COPY frontend/package.json frontend/package-lock.json ./
RUN npm install

# Copy the rest of the frontend files
COPY frontend ./

# Build Vue app for production
RUN npm run build

# Serve via Nginx
FROM nginx:latest AS production

WORKDIR /usr/share/nginx/html

# Remove default Nginx files
RUN rm -rf ./*

# Copy Vue build output to Nginx
COPY --from=builder /app/dist .

# Copy custom Nginx server configuration
COPY docker/default.conf /etc/nginx/conf.d/default.conf

# Expose port 80
EXPOSE 80

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]
