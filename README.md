
# Laravel E-Commerce Product Catalog

Develop a simple e-commerce product catalog with an ordering system using Laravel. The catalog includes features to display products, place orders, update order status via an API, and create webhooks to notify other systems of order status updates. Additionally, provide documentation for the API.

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 7.4
- Composer
- Laravel >= 8.x
- A local server environment like XAMPP, WAMP, or Laravel Valet
- ngrok (for testing webhooks locally)

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/AhmedRaoouf/uis-task.git
    cd uis-task
    ```

2. **Install dependencies:**

    ```sh
    composer install
    ```

3. **Copy the `.env.example` file to `.env`:**

    ```sh
    cp .env.example .env
    ```

4. **Generate an application key:**

    ```sh
    php artisan key:generate
    ```

5. **Set up your database:**

    - **Create a new database** in your preferred database management system (e.g., MySQL).

    - **Import the exported database file:**

      - **Locate the database file**: The exported database file (e.g., `database.sql`) should be located in the `database` directory of your project.

      - **Import the file** into your database using a database management tool like phpMyAdmin or via the command line:

        ```sh
        mysql -u your_database_username -p your_database_name < database/database.sql
        ```

    - **Update the `.env` file** with your database credentials. For example:

      ```dotenv
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=your_database_name
      DB_USERNAME=your_database_username
      DB_PASSWORD=your_database_password
      ```

6. **Run the database migrations (if necessary):**

    ```sh
    php artisan migrate
    ```

## Configuration

### Webhook URL Configuration

To set the webhook URL for the order status updates, configure your ngrok tunnel as follows:

1. **Start ngrok:**

    ```sh
    ngrok http 8000
    ```

    This command will provide you with a forwarding URL that you need to use for your webhook endpoint.

2. **Update the webhook URL in your `.env` file:**

    ```dotenv
    WEBHOOK_URL=https://<your-ngrok-subdomain>.ngrok.io/webhook-endpoint
    ```

    Replace `<your-ngrok-subdomain>` with the actual subdomain provided by ngrok.

### Queue Configuration

Ensure your queue driver is configured in the `.env` file:

```dotenv
QUEUE_CONNECTION=database
```

1. **Create the queue table:**

    ```sh
    php artisan queue:table
    php artisan migrate
    ```

2. **Run the queue worker:**

    ```sh
    php artisan queue:work
    ```

## Usage

To use the application, follow these steps:

1. **Start your local server:**

    ```sh
    php artisan serve
    ```

2. **Ensure ngrok is running:**

    ```sh
    ngrok http 8000
    ```

3. **Make an API request to update an order status (use Postman or any API client):**

    Replace `{order_id}` with the ID of the order you want to update.

4. **Check the Laravel logs** in `storage/logs/laravel.log` for webhook processing results.

## Testing

To test the webhook endpoint, use Postman or a similar tool to send a request to the webhook URL provided by ngrok.

## Troubleshooting

### Common Issues

- **Maximum execution time exceeded**: Increase the `max_execution_time` in your `php.ini` file.
- **Connection timeout**: Ensure ngrok is running and the URL is correct.
- **Class name conflicts**: Ensure there are no duplicate class names.

### Debugging Tips

- **Check ngrok logs**: Open `http://localhost:4040` to view detailed logs of requests passing through ngrok.
- **Inspect Laravel logs**: Use `tail -f storage/logs/laravel.log` to monitor real-time log output.

## Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss changes.

