<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('app/Views'));
$pattern = '/[\x{1F300}-\x{1F64F}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F900}-\x{1F9FF}\x{1FA70}-\x{1FAFF}]/u';

$foundEmoji = 0;
$foundAddress = 0;

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (preg_match_all($pattern, $content, $m)) {
            echo "Emoji in: " . $file->getPathname() . " -> " . implode(' ', array_unique($m[0])) . "\n";
            $foundEmoji++;
        }
        if (stripos($content, 'Education Lane') !== false) {
            echo "Address in: " . $file->getPathname() . "\n";
            $foundAddress++;
        }
    }
}

echo "Total files with emojis: $foundEmoji\n";
echo "Total files with old address: $foundAddress\n";
