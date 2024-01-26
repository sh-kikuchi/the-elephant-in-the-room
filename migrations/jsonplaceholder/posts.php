<?php

require 'vendor/autoload.php'; // Composer autoloader

use GuzzleHttp\Client;
use app\anchor\database\DataBaseConnect;

$dbConnect = new DataBaseConnect();
$pdo = $dbConnect->getPDO();

// JSONPlaceholderのベースURL
$baseUrl = 'https://jsonplaceholder.typicode.com';

// Guzzleクライアントの作成
$client = new Client([
    'base_uri' => $baseUrl,
]);

// APIからpostsデータを取得
$response = $client->get('/posts');

// ステータスコードが200 OKの場合のみ処理を続行
if ($response->getStatusCode() == 200) {
    // レスポンスボディをJSON形式でデコード
    $posts = json_decode($response->getBody(), true);

    // データを表示
    foreach ($posts as $post) {
        $stmt = $pdo->prepare('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
        $stmt->execute([
            ':user_id' => $post['userId'],
            ':title' => $post['title'],
            ':body' => $post['body'],
        ]);
    }

} else {
    echo "Failed to retrieve data. Status code: {$response->getStatusCode()}\n";
}