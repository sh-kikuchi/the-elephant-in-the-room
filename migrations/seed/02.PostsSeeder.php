<?php

require 'vendor/autoload.php'; // Composer autoloader

use GuzzleHttp\Client;
use app\axis\database\DataBaseConnect;

/**
 * Class PostsSeeder
 * 
 * This class seeds the 'posts' table with data from an external API.
 */
class PostsSeeder {
    
    /**
     * @var Client The Guzzle HTTP client instance.
     */
    private $client;

    /**
     * @var \PDO The PDO instance for database interaction.
     */
    private $pdo;

    /**
     * PostsSeeder constructor.
     * 
     * Initializes the database connection and the HTTP client.
     */
    public function __construct() {
        $this->dbConnect = new DataBaseConnect();
        $this->pdo = $this->dbConnect->getPDO();

        // Base URL for JSONPlaceholder
        $baseUrl = 'https://jsonplaceholder.typicode.com';

        // Create Guzzle client
        $this->client = new Client([
            'base_uri' => $baseUrl,
        ]);
    }

    /**
     * Seeds the 'posts' table with data from an external API.
     */
    public function seed() {
        // Retrieve posts data from the API
        $response = $this->client->get('/posts');

        // Continue processing only if the status code is 200 OK
        if ($response->getStatusCode() == 200) {
            // Decode the response body in JSON format
            $posts = json_decode($response->getBody(), true);

            // Display data
            foreach ($posts as $post) {
                $stmt = $this->pdo->prepare('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
                $stmt->execute([
                    ':user_id' => $post['userId'],
                    ':title' => $post['title'],
                    ':body' => $post['body'],
                ]);
            }

        } else {
            echo "Failed to retrieve data. Status code: {$response->getStatusCode()}\n";
        }
    }
}
