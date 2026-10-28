<?php
require __DIR__ . '/../config/db.php';
$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
$sql = "-- CB Climate Accomplish LTD database backup\n-- Generated: ".date('Y-m-d H:i:s')."\n\n";
foreach ($tables as $table) {
    $sql .= "DROP TABLE IF EXISTS `$table`;\n";
    $create = $pdo->query("SHOW CREATE TABLE `$table`")->fetch();
    $sql .= $create['Create Table'].";\n\n";
    $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll();
    foreach ($rows as $row) {
        $cols = array_map(fn($c)=>"`$c`", array_keys($row));
        $vals = array_map(fn($v)=>$v === null ? "NULL" : $pdo->quote($v), array_values($row));
        $sql .= "INSERT INTO `$table` (".implode(',',$cols).") VALUES (".implode(',',$vals).");\n";
    }
    $sql .= "\n";
}
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="cb_climate_backup_'.date('Ymd_His').'.sql"');
echo $sql;
?>
