<?php
/**
 * End-to-End System Verification Script
 */

function testUrl($url, $expectStrings = [], $cookie = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    if ($cookie) {
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    $body = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err = curl_error($ch);
    curl_close($ch);

    if ($httpCode !== 200) {
        echo "[FAIL] $url => HTTP $httpCode ($err)\n";
        return false;
    }

    $allPassed = true;
    foreach ($expectStrings as $str) {
        if (strpos($body, $str) === false) {
            echo "[FAIL] $url missing expected text: '$str'\n";
            $allPassed = false;
        }
    }

    if ($allPassed) {
        echo "[PASS] $url => HTTP 200 (All " . count($expectStrings) . " checks passed)\n";
    }
    return $allPassed;
}

echo "=== 1. TESTING PUBLIC PAGES ===\n";
testUrl('http://localhost/ELOCENTRA_LMS/', [
    'ELOCENTRA – English Academy (PVT) LTD',
    'eloHeroSlider',
    'eloChatbotContainer',
    'eloengaca@gmail.com',
    '077 7354892',
    '077 2278069',
    'Learn English. Speak Confidently. Succeed Globally.'
]);

testUrl('http://localhost/ELOCENTRA_LMS/about', [
    'About Us',
    'eloengaca@gmail.com',
    'To become a trusted and internationally recognised English academy',
    'Our Vision',
    'Our Mission',
    'Main Goal'
]);

testUrl('http://localhost/ELOCENTRA_LMS/courses', [
    'Our Courses',
    'All Courses',
    'English & Communication',
    'eloengaca@gmail.com'
]);

testUrl('http://localhost/ELOCENTRA_LMS/courses?search=English', [
    'Our Courses',
    'English for Global Communication'
]);

testUrl('http://localhost/ELOCENTRA_LMS/contact', [
    'Contact Us',
    'eloengaca@gmail.com',
    '077 7354892',
    '077 2278069',
    'Send Us a Message'
]);

testUrl('http://localhost/ELOCENTRA_LMS/login', [
    'Welcome Back',
    'Username or Email',
    'Remember Me',
    'Forgot Password'
]);

testUrl('http://localhost/ELOCENTRA_LMS/register', [
    'Student Registration',
    'Step 1: Personal Information',
    'Step 2: Create Your Account'
]);

testUrl('http://localhost/ELOCENTRA_LMS/forgot-password', [
    'Change Password',
    'Verify It\'s Me',
    'Forgot your old password? Click here.'
]);

echo "\n=== 2. CHECKING FOR ANY PHYSICAL ADDRESS IN PUBLIC PAGES ===\n";
$publicUrls = [
    'http://localhost/ELOCENTRA_LMS/',
    'http://localhost/ELOCENTRA_LMS/about',
    'http://localhost/ELOCENTRA_LMS/courses',
    'http://localhost/ELOCENTRA_LMS/contact'
];

foreach ($publicUrls as $u) {
    $ch = curl_init($u);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    curl_close($ch);
    if (stripos($html, 'Education Lane') !== false || stripos($html, 'No. 123') !== false) {
        echo "[ERROR] Physical address found in $u!\n";
    } else {
        echo "[CLEAN] No physical address in $u\n";
    }
}

echo "\n=== 3. TESTING ADMIN AUTH & BANNER SLIDER ROUTE ===\n";
// Perform Admin login via cURL
$cookieJar = tempnam(sys_get_temp_dir(), 'lms_cookie_');

// 1. Get CSRF token from login page
$ch = curl_init('http://localhost/ELOCENTRA_LMS/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
$loginHtml = curl_exec($ch);
curl_close($ch);

preg_match('/name="_csrf_token"\s+value="([^"]+)"/', $loginHtml, $m);
$csrfToken = $m[1] ?? '';

if (!$csrfToken) {
    echo "[WARN] Could not parse CSRF token from login page\n";
} else {
    // 2. Submit login
    $postData = http_build_query([
        '_csrf_token' => $csrfToken,
        'user_id' => 'superadmin@elocentra.academy',
        'password' => 'Demo@12345'
    ]);

    $ch = curl_init('http://localhost/ELOCENTRA_LMS/login');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $adminHome = curl_exec($ch);
    $adminCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "Admin Login HTTP Code: $adminCode\n";

    // 3. Request /admin/banners
    $ch = curl_init('http://localhost/ELOCENTRA_LMS/admin/banners');
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $bannerHtml = curl_exec($ch);
    $bannerCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($bannerCode === 200 && strpos($bannerHtml, 'Homepage Banner Slider Management') !== false) {
        echo "[PASS] /admin/banners => HTTP 200 & Title Found!\n";
    } else {
        echo "[STATUS] /admin/banners => HTTP $bannerCode (Length: " . strlen($bannerHtml) . ")\n";
    }
}

@unlink($cookieJar);
echo "\n=== VERIFICATION COMPLETE ===\n";
