<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$a = new App\Complex\Complex(1, 2);
$b = new App\Complex\Complex(3, 4);

/** Вывод результата решения примера (1+2i)/(3+4i) */
echo App\Complex\Complex::division($a, $b);