# WordPress Docker Test Project Setup
This repository contains a Docker configuration for a WordPress project with custom table migrations, Twig integration, and modern frontend tooling with Node.js and Yarn.

## Prerequisites
Before getting started, ensure you have the following installed:

- Git
- Docker and Docker Compose
- Node.js (v16 or later)
- Yarn (v1.22 or later)

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/HostAdvice/test-project.git
cd test-project
```

### 2. Install Project Dependencies
```bash
yarn install
```

### 3. Build Project assets
```bash
yarn build
```

### 4. Start Docker Environment
```bash
docker-compose up -d
```

### 5. Access the Site
Once the containers are running, you can access:
- WordPress site: http://localhost:8080
- WordPress admin: http://localhost:8080/wp-admin (default credentials: admin/admin)

## Development Workflow
```bash
# Start development with asset compilation and watch
yarn watch
```