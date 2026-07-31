<?php
// Endpoint to serve live Shapefile ZIP data dynamically
$layer = isset($_GET['layer']) ? strtolower($_GET['layer']) : '';

$map = [
    'batas'      => 'BATAS PADUKUHAN PENGGUNG.zip',
    'hutan'      => 'HUTAN.zip',
    'kebun'      => 'KEBUN.zip',
    'pemukiman'  => 'PEMUKIMAN.zip',
    'sawah'      => 'SAWAH.zip',
    // Plant Layers
    'cengkeh'    => 'CENGKEH.zip',
    'jahe'       => 'JAHE.zip',
    'kelapa'     => 'KELAPA.zip',
    'ketela'     => 'KETELA.zip',
    'padi'       => 'PADI.zip',
    'pisang'     => 'PISANG.zip'
];

if (!isset($map[$layer])) {
    // Try matching file directly if passed as filename
    foreach ($map as $key => $filename) {
        if (str_contains(strtolower($filename), $layer) || $key === $layer) {
            $layer = $key;
            break;
        }
    }
}

if (!isset($map[$layer]) || !file_exists($map[$layer])) {
    http_response_code(404);
    echo "Berkas spasial untuk layer '$layer' tidak ditemukan.";
    exit;
}

$filePath = $map[$layer];

// Clear cache & serve binary data
header('Content-Type: application/octet-stream');
header('Content-Length: ' . filesize($filePath));
header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

readfile($filePath);
exit;
?>
