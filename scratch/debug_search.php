<?php
$ch = curl_init('http://localhost/ELOCENTRA_LMS/courses?search=English');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
curl_close($ch);
if (preg_match('/<div class="grid grid-cols-1.*?>.*?<\/div>\s*<\/section>/s', $res, $m)) {
    echo "Grid content snippet:\n" . substr($m[0], 0, 1000);
} else if (strpos($res, 'No courses found') !== false) {
    echo "No courses found rendered!\n";
} else {
    echo "Neither found\n";
}
