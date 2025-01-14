
# Multi-User Chat Room using Symfony and Mercure Protocol

This project is a multi-user chat room built with the [Symfony framework](https://symfony.com) and powered by the [Mercure Protocol](https://mercure.rocks/). It allows real-time communication between multiple users, enabling them to send and receive messages instantly.

## Features

- Real-time message updates using Mercure Protocol.
- Multi-user support for simultaneous users in the chat room.
- Built using Symfony, one of the most powerful PHP frameworks.

## Prerequisites

Before using the app, make sure to install the following:

- **Mercure** (for real-time communication)
  - Mercure is required for message delivery across multiple users. Please follow the instructions below to install and configure Mercure.
- **Symfony** (for backend and application management)
  - Make sure Symfony is installed and configured on your local system.

## Installation Steps

### 1. Install Mercure

First, ensure that you have [Mercure](https://mercure.rocks/) installed on your machine. You can download it from the [Mercure GitHub repository](https://github.com/dunglas/mercure).

### 2. Start Mercure Hub

To start the Mercure Hub, you need to set up a JWT key and start the Mercure server.

1. Open **PowerShell** (or terminal on your machine).
2. Navigate to the directory where you have the Mercure executable.
3. Run the following command:

```powershell
$env:MERCURE_PUBLISHER_JWT_KEY='!ChangeThisMercureHubJWTSecretKey!'; $env:MERCURE_SUBSCRIBER_JWT_KEY='!ChangeThisMercureHubJWTSecretKey!'; .\mercure.exe run --config dev.Caddyfile
```

> **Important**: Replace the `!ChangeThisMercureHubJWTSecretKey!` with a secret key of your choice. This key will be used to sign JWTs required for the Mercure protocol.

### 3. Configure Symfony

To properly configure the Symfony application for Mercure, follow these steps:

1. **Install Symfony** (if not already installed):
   - Install [Symfony CLI](https://symfony.com/download) or follow the instructions for installing Symfony on your local machine.
   
2. **Install the Mercure Symfony package**:
   - Use Composer to install the Mercure bundle for Symfony:

   ```bash
   composer require symfony/mercure-bundle
   ```

3. **Configure the Mercure Hub in Symfony**:
   - Open your `.env` or `.env.local` file and add the following Mercure configuration:

   ```env
   MERCURE_PUBLISHER_JWT_KEY='!ChangeThisMercureHubJWTSecretKey!'
   MERCURE_SUBSCRIBER_JWT_KEY='!ChangeThisMercureHubJWTSecretKey!'
   MERCURE_HUB_URL=http://localhost/.well-known/mercure
   ```

   - Make sure that the `MERCURE_HUB_URL` points to the correct URL for your Mercure Hub.

4. **Configure the Symfony routing**:
   - In your Symfony project, configure the routes for Mercure. You can refer to the [official Mercure Symfony documentation](https://symfony.com/doc/current/bundles/SymfonyMercureBundle/index.html) for detailed steps.

### 4. Running the Symfony Application

Now, you're ready to run the Symfony application. To start the Symfony server, use:

```bash
symfony server:start
```

Once the server is running, you can access the chat room application at [http://localhost:8000](http://localhost:8000).

### 5. Accessing the Chat Room

To access the chat room, simply visit the URL of your Symfony application in the browser. Multiple users can join the room and send messages in real-time.

### 6. Configuration for Production (Optional)

For production deployment, you may want to:

- Configure the Mercure Hub using a production-ready web server (like Nginx or Caddy).
- Set up environment-specific configuration in `.env.prod` or `.env.local` for security and performance optimizations.

---

## Troubleshooting

- **Mercure Hub not starting**: Ensure that the Mercure executable is properly set up and the configuration is correct (JWT keys, Caddyfile, etc.).
- **Messages not updating in real-time**: Verify that Mercure is running correctly and that Symfony is configured to use the correct Mercure Hub URL.
- **Security**: Make sure to change the JWT secret keys to something more secure when deploying the application in production.

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

Enjoy chatting! 🎉