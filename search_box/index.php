<?php
    $dsn = "mysql:host=; dbname=; charset=";
    $username = "";
    $password = "";
    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if (isset($_POST['word']) and $_POST['word'] != "") {
        $sql = "SELECT * FROM search_bar WHERE name LIKE ?";
        $stmt = $dbh->prepare($sql);
        $word = $_POST['word'];
        $stmt->bindValue(1, "%$word%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<html>
    <head>
        <title>検索バー</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <form action="index.php" method="post" style="display: flex;">
            &#128269;<input type="text" name="word" value="<?php echo $_POST['word']?>">
            <input type="submit" value="検索">
        </form>
        <table>
            <tr><th>ID</th><th>User Name</th></tr>
            <?php
            if(isset($rows)){
                foreach ($rows as $row){
                    print("
                    <tr><td>{$row['id']}</td><td>{$row['name']}</td></tr>
                    ");
                }
            }
            ?>
        </table>
    </body>
</html>
