<?
// Database auto-update when database.sql file has been changed
$dbFile = 'system/database.sql';
$last_mod = new DateTime($db->query("SELECT * FROM version")->fetch_assoc()['last_mod']);
$last_mod = $last_mod->getTimestamp();
//var_dump($last_mod);
//var_dump(filemtime($dbFile));

if (filemtime($dbFile) > $last_mod) {
$db->multi_query(file_get_contents($dbFile));
$db->query("UPDATE version SET last_mod=DEFAULT");
}