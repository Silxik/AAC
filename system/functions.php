<?

function fetch($sql)
{
    global $db;
    $q = $db->query($sql) or $db->error;
    return $q->fetch_assoc();
}
