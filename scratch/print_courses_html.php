<?php
$ch = curl_init('http://localhost/ELOCENTRA_LMS/courses?search=English');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
curl_close($ch);
// Find where "COURSES GRID" begins
$pos = strpos($res, 'COURSES GRID');
if ($pos !== false) {
    echo substr($res, $pos, 2500);
} else {
    echo "COURSES GRID comment not found!\n";
}
