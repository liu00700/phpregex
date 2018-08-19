<?php
require './vendor/autoload.php';

use AmoyRegex\RegexSearch;

// (?<=v3\.0)aefgc[\w\W]*?ddd(?=aaa)

$demo_txt='11,sdf fds s aaaa@aa.com xxxdkfje4i2333 d34fsd 111.111.111.11 ,vandewqfod@yahoo.com, f4e4e4,22.22.22.33,d fdd,yahoo,http://www.baidu.com/axdff, dkfs';

$res=RegexSearch::setSubject($demo_txt)->setRegex("/[1-9]\d*/")->First();

//$res=RegexSearch::setSubject($demo_txt)->CustomRegex('aaa','a@','baidu','.com',true,true);

//$res=RegexSearch::setSubject($demo_txt)->setRegex("/(?<=aaa)a@[\w\W]*?baidu(?=\.com)/");

dump($res);