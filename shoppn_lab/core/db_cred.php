<?php
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define("DATABASE", "shoppn_lab");
    define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWD", "");
} else {
    define("DATABASE", "ecommerce_2026A_oghenetejiri_etireri");
    define("SERVER", "localhost");
    define("USERNAME", "oghenetejiri.etireri");
    define("PASSWD", "Adeyinka67$");
}