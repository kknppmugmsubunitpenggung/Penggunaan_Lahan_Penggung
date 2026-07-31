<?php
header('Content-Type: text/plain');

$map = [
    'BATAS PADUKUHAN PENGGUNG.zip' => 'BATAS_PADUKUHAN_PENGGUNG.dat',
    'HUTAN.zip'                    => 'HUTAN.dat',
    'KEBUN.zip'                    => 'KEBUN.dat',
    'PEMUKIMAN.zip'                => 'PEMUKIMAN.dat',
    'SAWAH.zip'                    => 'SAWAH.dat',
    'CENGKEH.zip'                  => 'CENGKEH.dat',
    'JAHE.zip'                     => 'JAHE.dat',
    'KELAPA.zip'                   => 'KELAPA.dat',
    'KETELA.zip'                   => 'KETELA.dat',
    'PADI.zip'                     => 'PADI.dat',
    'PISANG.zip'                   => 'PISANG.dat'
];

foreach ($map as $zipFile => $datFile) {
    if (file_exists($zipFile)) {
        if (copy($zipFile, $datFile)) {
            echo "Updated $datFile (" . filesize($datFile) . " bytes)\n";
        } else {
            echo "Failed to copy $zipFile\n";
        }
    } else {
        echo "Source file $zipFile not found!\n";
    }
}
?>
