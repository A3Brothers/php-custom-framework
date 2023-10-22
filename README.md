# Custom PHP Framework

[![GitHub Stars](https://img.shields.io/github/stars/A3Brothers/php-custom-framework.svg?style=flat&label=Star)](https://github.com/A3Brothers/php-custom-framework)
[![GitHub Forks](https://img.shields.io/github/forks/A3Brothers/php-custom-framework.svg?style=flat&label=Fork)](https://github.com/A3Brothers/php-custom-framework/fork)

**Important Note:** This framework was created for educational and practice purposes. It lacks several features necessary for production-ready applications. Please use it exclusively for development and learning purposes.

## Features

- **MVC Pattern**: This framework follows the Model-View-Controller architectural pattern, providing a structured way to develop web applications.

- **Service Container and Dependency Injection**: It includes a simple implementation of a service container and dependency injection for managing and injecting dependencies into your application.

- **Facade and Singleton**: You can utilize facades and singletons to access services and components easily.

- **Custom CLI Script**: A custom CLI script is available, inspired by Laravel's Artisan, to run a PHP local server and simplify common development tasks.

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/A3Brothers/php-custom-framework.git
   ```

2. Run composer install:

   ```bash
   composer install
   ```

3. Copy the .env.example file:
    ```bash
    cp .env.example .env
    ```

4. Open the .env file and fill in the necessary database information.

5. Run the PHP local server using the custom CLI script:

   ```bash
   php artisan serve 8000
   ```

3. Access your application in a web browser at `http://localhost:8000` (or a different port if specified).

## Contribute

If you find this project interesting and would like to contribute, please feel free to fork the repository and submit your pull requests. While this project is primarily for practice, contributions are always welcome, and they might inspire future updates.

## Follow Me

If you appreciate this project or my work, consider giving it a star and following me on GitHub. Your support encourages me to continue working on new projects and improving existing ones.

## Future Updates

While this framework is intentionally limited in scope, I may periodically work on adding more features and improvements. Please stay tuned for updates in the future.

---

Thank you for checking out my custom PHP framework. Enjoy exploring and learning from it! If you have any questions or feedback, don't hesitate to reach out.