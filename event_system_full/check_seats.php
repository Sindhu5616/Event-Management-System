<?php
require 'config.php';
$slot_id = intval($_GET['slot_id'] ?? 0);
$res = $conn->query('SELECT capacity,booked FROM slots WHERE id='.$slot_id.' LIMIT 1');
if($res && $res->num_rows){
    $r = $res->fetch_assoc();
    echo json_encode(['capacity'=>intval($r['capacity']),'booked'=>intval($r['booked']),'left'=>intval($r['capacity'])-intval($r['booked'])]);
} else {
    echo json_encode(['capacity'=>0,'booked'=>0,'left'=>0]);
}
