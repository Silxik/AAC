<?

function fetch($sql)
{
    global $db;
    $q = $db->query($sql) or $db->error;
    return $db->fetch($q);
}