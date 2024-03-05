<?php
// データベースへの接続
$dsn = "mysql:host=; dbname=; charset=";
$username = "";
$password = "";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
// $queryを使ってデータベースから結果を取得するクエリを実行
if (isset($_POST['query']) and $_POST['query'] != "") {
    $sql = "SELECT * FROM tags WHERE name LIKE ?";
    $stmt = $dbh->prepare($sql);
    $query = $_POST['query'];
    $stmt->bindValue(1, "%$query%", PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
}
?>
