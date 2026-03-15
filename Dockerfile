# syntax=docker/dockerfile:1

# Stage 1: Base image with Bun
ARG BUN_VERSION=1.2
FROM oven/bun:${BUN_VERSION}-alpine AS base

# Set working directory
WORKDIR /app

# Copy only the lock file for dependency installation
COPY bun.lockb ./

# Install dependencies
ENV BUN_INSTALL_CACHE=/root/.bun/install/cache
RUN --mount=type=cache,target=${BUN_INSTALL_CACHE} \
    bun install --frozen-lockfile --production

# Stage 2: Build the application
FROM base AS builder

# Copy the application source code
COPY . .

# Build the application
RUN bun build ./src/index.ts --outdir ./dist

# Stage 3: Final image
FROM base AS final

# Copy built application from builder stage
COPY --from=builder /app/dist /app/dist

# Expose the application port
EXPOSE 3000

# Set the command to run the application
CMD ["bun", "run", "start"]