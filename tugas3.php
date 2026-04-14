<?php
    $arrBunga = ['mawar', 'melati', 'tulip', 'anggrek', 'matahari', 'lavender', 'dahlia'];

    $isArr = is_array($arrBunga);
    echo "Apakah arrBunga adalah array? " . ($isArr ? "Ya" : "Tidak") . " \n\n";

    $panjangArr = count($arrBunga);
    echo "Jumlah bunga: $panjangArr \n\n";

    sort($arrBunga);
    echo "Array setelah di-sort: \n";
    foreach ($arrBunga as $bunga) {
        echo "  - $bunga \n";
    }
    echo "\n";

    shuffle($arrBunga);
    echo "Array setelah di-shuffle: \n";
    foreach ($arrBunga as $bunga) {
        echo "  - $bunga \n";
    }
    echo "\n";

    // String
    $namaBunga = $arrBunga[0];
    $sub = substr($namaBunga, 0, 3);
    echo "Bunga pertama (setelah shuffle): $namaBunga \n";
    echo "3 huruf pertama: $sub \n";
?>