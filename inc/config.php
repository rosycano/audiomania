<?php

// these two constants are used to create root-relative web addresses
// and absolute server paths throughout all the code
define("HOME","http://192.168.1.64:1234/audiomania/");
define("BASE_URL","/audiomania/");
define("URL_AUDIOS","audios/");
define("ROOT_PATH",$_SERVER["DOCUMENT_ROOT"] . BASE_URL);

define("DB_HOST","localhost");
define("DB_NAME","audiomania");
define("DB_PORT","3306"); 
define("DB_USER","root");
define("DB_PASS","");