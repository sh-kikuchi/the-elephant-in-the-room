<?php
define('MAX','3'); // 1ページの記事の表示数
 
$books = array( // 表示データを配列に入れる
          array('book_kind' => 'ライトノベル', 'book_name' => 'ライトノベルの本'),
          array('book_kind' => '歴史', 'book_name' => '歴史の本'),
          array('book_kind' => '料理', 'book_name' => '料理の本'),
          array('book_kind' => '啓発本', 'book_name' => '啓発の本'),
          array('book_kind' => 'コミック', 'book_name' => 'コミックの本'),
          array('book_kind' => '推理小説', 'book_name' => '推理小説の本'),
          array('book_kind' => 'フォトブック', 'book_name' => 'フォトブックの本'),
            );
            
$books_num = count($books); // トータルデータ件数
 
$max_page = ceil($books_num / MAX); // トータルページ数※ceilは小数点を切り捨てる関数
 
if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
}else{
    $now = $_GET['page_id'];
}
 
$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか
 
// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
$disp_data = array_slice($books, $start_no, MAX, true);
 
foreach($disp_data as $val){ // データ表示
    echo $val['book_kind']. '　'.$val['book_name']. '<br />';
}
 
for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
    if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
        echo $now. '　'; 
    } else {
        echo '<a href=/the-elephant-in-the-room/page/test.php?page_id='. $i. '>'. $i. '</a>'. '　';
    }
}
 
?>

