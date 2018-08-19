# phpregex

phpregex 是一个正则工具，内置部分常用的正则表达式，重要的是包含一个正则工具，让新手也能简单的使用正则而不需要去深入学习正则表达式。

## Composer Installation

Packagist：https://packagist.org/packages/amoy/phpregex

````
composer require amoy/phpregex
````
## Usage
````

$demo_txt='11,sdf fds s aaaa@aa.com , 111.111.111.11 ,vandewqfod@yahoo.com, http://github.com';

$res=RegexSearch::setSubject($demo_txt)->Ip()->First();  //111.111.111.11

$res=RegexSearch::setSubject($demo_txt)->Email()->First(); //aaaa@aa.com

$res=RegexSearch::setSubject($demo_txt)->Email()->Last(); //vandewqfod@yahoo.com

$res=RegexSearch::setSubject($demo_txt)->Email()->All(); //['aaaa@aa.com','vandewqfod@yahoo.com']

$res=RegexSearch::setSubject($demo_txt)->Url()->All(); // ['http://github.com']

$res=RegexSearch::setSubject($demo_txt)->setRegex("/[1-9]\d*/")->First(); // 11

````
## More Usage
````
$res=RegexSearch::setSubject($demo_txt)->CustomRegex('aaa','a@','yahoo','.com',true,true)->First();
//a@aa.com xxxdkfje4i2333 d34fsd 111.111.111.11 ,vandewqfod@yahoo

     * @param string $front 以此字符串开头，但不包含在结果里面
     * @param string $begin 以此字符串开头，包含在结果里面
     * @param string $end   以此字符串结尾，包含在结果里面
     * @param string $last  以此字符串结尾，但不包含在结果里面
     * @param bool $is_short    是否使用最短匹配
     * @param bool $enable_break    是否包含换行匹配搜索
     CustomRegex($front='',$begin='',$end='',$last='',$is_short=true,$enable_break=false)
     详解： $begin必须紧随着$front字符串， $last必须紧随着$end字符串，
````
## Features
````
增加替换
增加内置常用正则
````