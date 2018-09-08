<?php
require './vendor/autoload.php';

use AmoyRegex\RegexSearch;

// (?<=v3\.0)aefgc[\w\W]*?ddd(?=aaa)

$demo_txt='11,sdf fds s，你好吗，
 aaaa@aa.com xxxdkfje4i2333 d34fsd 111.111.111.11 ,
<a href="link_addrs"
 sylte="height:10px">链接文字</a>
 vandewqfod@yahoo.com,我很好，13798744444, f4e4e4,22.22.22.33,d 

 fdd,yahoo,http://www.baidu.com/axdff

dkfs';

$res=RegexSearch::setSubject($demo_txt)->setRegex("/<([\w\W]*?)>/")->All();

//$res=RegexSearch::setSubject($demo_txt)->CustomRegex('aaa','a@','baidu','.com',true,true);

//$res=RegexSearch::setSubject($demo_txt)->setRegex("/(?<=aaa)a@[\w\W]*?baidu(?=\.com)/");

dump($res);