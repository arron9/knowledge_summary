<?php
$dbConfig = [
    'db' => 'mg_marketingapi',
    'host' => '192.168.78.131:3306',
    'user' => 'root',
    'pass' => 'MySQL1@3456',
];

$dsn = "mysql:dbname={$dbConfig['db']};host={$dbConfig['host']}";
$pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['pass']);


echo memory_get_usage();
echo "\n";
$sql = "SELECT * FROM mg_marketingapi.admobile_toutiao_ad";
// pdo不使用buffer
$stmt = $pdo->prepare($sql);
echo memory_get_usage();
echo "\n";

$stmt->execute();
echo memory_get_usage();
echo "\n";

/*foreach (fetch($stmt) as $item) {
}*/

while($row = $stmt->fetch()) {
}

echo memory_get_usage();
echo "\n";exit;

/*// pdo使用buffer
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = array();
$data = $stmt->fetchAll();

echo memory_get_usage();
echo "\n";*/

function fetch($stmt) {
    while($row = $stmt->fetch()) {
        yield $row;
    }
}

