<?php
require './vendor/autoload.php';

use Amoy\RegexSearch\RegexSearch;

$demo_txt='sdf fds s aaaa@aa.com xxxdkfje4i2333 d34fsd 111.111.111.11 f4e4e4,22.22.22.33,d fdd';

$res=RegexSearch::setSubject($demo_txt)->Email()->All();
dump($res);