## The Elephant in the Room

### 1. Overview

- 'the Elephant in the room' is my private PHP flame work.

### 2. Project Code is "Gladiolus"

- This project code is named Gladiolus. The gladiolus flower symbolizes strength, integrity, and victory, reflecting the essence of this PHP framework. Just as the gladiolus stands tall and resilient, this framework aims to empower developers with robust and reliable tools to build outstanding web applications. 

### 3. Set up

#### Clone Projectes & Install Packages
- Let's start by cloning the project.
    ```
    git clone https://github.com/sh-kikuchi/the-elephant-in-the-room.git
    ```

- After that, let's run `composer install`.
    ```
    composer install
    ```

#### Connect Database
- Prepare a `.env` file in the project directory and configure it as follows:
  ```env
    DB_HOST = 'localhost'
    DB_NAME = 'test'
    DB_USER = 'root'
    DB_PASS = ''
    PASSWORD = 'password'
  ```

- To create the table, please run the following command:
    ```
    　php elephant migrate
    ```

- To insert data into the table, please run the following command:
    ```php
    　php elephant seed     
    ```

### 4. Architecture
#### 3-tier architecture
- This framework is based on a 3-tier architecture, consisting of three layers: Model, Service, and View.
  - **Model**: Handles database operations and business logic.
    - *Entity*: Represents database tables as classes.
    - *Repository*: Encapsulates the actual logic for database operations, handling CRUD operations for Entities.
  
  - **Service**: Processes business logic and acts as an intermediary between Model and View.
  
  - **View**: Manages the user interface presented to the user.

This design improves code readability and maintainability, allowing each layer to be developed, tested, and modified independently.
Moreover,By providing interfaces for models and services, you can write type-safe and clean code.


![Architecture](https://private-user-images.githubusercontent.com/74047781/309458711-c1dc0e24-7712-4c47-b651-734fbf369ed2.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MjA3MDQ2MTYsIm5iZiI6MTcyMDcwNDMxNiwicGF0aCI6Ii83NDA0Nzc4MS8zMDk0NTg3MTEtYzFkYzBlMjQtNzcxMi00YzQ3LWI2NTEtNzM0ZmJmMzY5ZWQyLnBuZz9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDA3MTElMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwNzExVDEzMjUxNlomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPTE3MjI0OTFhZGIxNzAwYTQ5NDg3MTkwYjhkODE4NDVkMjRkYmFiZDk2YzViYmI0NzRjNmJmMjhhOGQ4NThkZWEmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.hQkFMWPQXAIai-K_TH3XFgIA6SkqmlGQG9sQV0-yQHA)


#### 5. Directory
```
├─axis
│  ├─database       // Database connection
│  ├─https          // Request and response management
│  ├─routes         // Routing management
│  └─toolbox
│      ├─commands    // Command processing
│      └─functions   // Functions primarily used in view files
├─config             // Configuration
├─form_classes       // Classes managing form data
├─interfaces         // Interfaces
│  ├─form_classes
│  ├─models
│  └─services
├─logs               // Logs
├─migrations         // Migrations (tables)
│  ├─csv            // CSV import/export
│  ├─migrate        // Table creation
│  └─seed           // Data insertion
├─models             // Model classes
│  ├─entities
│  └─repositories
├─public             // Public assets (JS, CSS, images)
│  └─assets
│      ├─css
│      ├─img
│      └─js
├─services           // Service classes
├─storage            // Storage
│  ├─csv
│  └─doc
└─templates          // Template files
    ├─errors         // Error pages
    └─layouts        // Headers and footers

```

#### Sample App
- I have prepared a sample application, a simple CRUD app with two tables: Users and Posts.

### 6. Dependencies
- `guzzlehttp/guzzle`: PHP library for simplifying HTTP requests.
- `vlucas/phpdotenv` : PHP library for loading environment variables.
- `phpunit/phpunit`  : PHP testing framework.

### 7. Testing
- You can execute tests using PHPUnit. Here's an example of running tests.
  ```
  vendor/bin/phpunit tests\form_classes\PostRequestTest.php
  ```

### 8. License

> MIT License
> 
> Copyright (c) 2024 The Elephant in the Room
> 
> Permission is hereby granted, free of charge, to any person obtaining a copy
> of this software and associated documentation files (the "Software"), to deal
> in the Software without restriction, including without limitation the rights
> to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
> copies of the Software, and to permit persons to whom the Software is
> furnished to do so, subject to the following conditions:
> 
> The above copyright notice and this permission notice shall be included in all
> copies or substantial portions of the Software.
> 
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
> IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
> FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
> AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
> LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
> SOFTWARE.
>

### 9. Contribution
- I might be whimsical at times, but contributions are always welcome. Please report bugs or suggest new features through GitHub Issues. I can't handle it all alone. Help me out! 😄

Thank you to all my friends, PHPers.
