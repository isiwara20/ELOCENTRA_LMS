<?php
$ch = curl_init('http://localhost/ELOCENTRA_LMS/courses?search=English');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
curl_close($ch);
echo "Length: " . strlen($res) . "\n";
echo "Contains 'English for Global Communication': " . (strpos($res, 'English for Global Communication') !== false ? 'YES' : 'NO') . "\n";
if (strpos($res, 'English for Global Communication') === false) {
    echo substr($res, 0, 500);
}
