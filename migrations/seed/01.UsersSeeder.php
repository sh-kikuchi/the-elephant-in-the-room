<?php

require 'vendor/autoload.php'; // Composer autoloader

use GuzzleHttp\Client;
use app\axis\database\DataBaseConnect;

class UsersSeeder
{
    private $client;
    private $pdo;

    public function __construct()
    {
        $this->dbConnect = new DataBaseConnect();
        $this->pdo = $this->dbConnect->getPDO();

        // JSONPlaceholderのベースURL
        $baseUrl = 'https://jsonplaceholder.typicode.com';

        // Guzzleクライアントの作成
        $this->client = new Client([
            'base_uri' => $baseUrl,
        ]);
    }

    public function seed()
    {
        // APIからusersデータを取得
        $response = $this->client->get('/users');

        // ステータスコードが200 OKの場合のみ処理を続行
        if ($response->getStatusCode() == 200) {
            // レスポンスボディをJSON形式でデコード
            $users = json_decode($response->getBody(), true);

            // データを表示
            foreach ($users as $user) {
                $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
                $stmt->execute([
                    ':name'  => $user['name'],
                    ':email' => $user['email'],
                    ':password' => password_hash('password', PASSWORD_DEFAULT)
                ]);
            }

        } else {
            echo "Failed to retrieve data. Status code: {$response->getStatusCode()}\n";
        }
    }
}

