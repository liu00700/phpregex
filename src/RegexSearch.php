<?php
/**
 * User: amoy
 */

namespace AmoyRegex;


/**
 * Class RegexSearch
 * @package Amoy\RegexSearch
 *
 * @method RegexSearch Ip()
 * @method RegexSearch Email()
 * @method RegexSearch Url()
 * @method RegexSearch Integer()    正整数
 * @method RegexSearch ChinesLetters() 匹配中文
// * @method RegexSearch EmptyLine()
 * @method RegexSearch Alpha()
 * @method RegexSearch LowercaseLetters()
 * @method RegexSearch UppercaseLetters()
// * @method RegexSearch ChineseTelephone()
 *
 */
class RegexSearch{

    protected $EMAIL="/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
    protected $IP="/\d+\.\d+\.\d+\.\d+/";
    protected $URL="/(http|https):\/\/([\w\d\-_]+[\.\w\d\-_]+)[:\d+]?([\/]?[\w\/\.]+)/i";
    protected $INTEGER="/[1-9]\d*/";    //正整数
    protected $CHINESELETTERS="/[\x{4e00}-\x{9fff}]+/u"; //匹配中文
    protected $EMPTY_LINE="/\n[\s| ]*\r/";
    protected $ALPHA="/[a-z]+/i";  //匹配26个字母，不分大小写
    protected $LOWERCASELETTERS="/[a-z]+/";     // 匹配小写字母
    protected $UPPERCASELETTERS="/[A-Z]+/";     // 匹配大写字母
    protected $CHINESETELEPHONE="/((\(\d{2,3}\))|(\d{3}\-))?13\d{9}$/";  //中国手机号码
    protected $HTML_TAG="/<([\w\W]*?)>/";


    protected $subject;
    protected $regex_res;
    protected $pattern;

    public function __call($name, $arguments)
    {
        $variable=strtoupper($name);
        if(isset($variable)){
            $this->pattern=$this->$variable;
        }
        return $this->DealRes();
    }

    public static function __callStatic($name, $arguments)
    {
        if(isset(static::$name)){
            $query=static::$name;
        }else{
            $query=(new static())->$name();
        }
        return call_user_func_array([$query,$name],$arguments);
    }
    public static function setSubject($subject){
        $class=new self();
        $class->subject=$subject;
        return $class;
    }
    public function setRegex($pattern){
        $this->pattern=$pattern;
        return $this->DealRes();
    }

    /**
     * @param string $front 以此字符串开头，但不包含在结果里面
     * @param string $begin 以此字符串开头，包含在结果里面
     * @param string $end   以此字符串结尾，包含在结果里面
     * @param string $last  以此字符串结尾，但不包含在结果里面
     * @param bool $is_short    是否使用最短匹配
     * @param bool $enable_break    是否包含换行匹配搜索
     * @return RegexSearch
     */
    public function CustomRegex($front='',$begin='',$end='',$last='',$is_short=true,$enable_break=false){
        $regex_pattern='';
        if(!empty($front)){
            $regex_pattern="(?<=".$this->DealParam($front).")";
        }
        if(!empty($begin)){
            $regex_pattern.=$this->DealParam($begin);
        }
        if($enable_break){
            $regex_pattern.="[\w\W]";
        }else{
            $regex_pattern.=".";
        }
        if($is_short){
            $regex_pattern.="*?";
        }else{
            $regex_pattern.="*";
        }
        if(!empty($end)){
            $regex_pattern.=$this->DealParam($end);
        }
        if(!empty($last)){
            $regex_pattern.="(?=".$this->DealParam($last).")";
        }
        $regex_pattern='/'.$regex_pattern.'/';
        $this->pattern=$regex_pattern;
        return $this->DealRes();
    }

    /**
     * User: Jun
     * Date: 2018/9/8
     * Time: 上午11:05
     * Remark: 替换自定义正则中的保留符号
     * @param $custom_param 自定义正则表达式
     * @return mixed
     */
    private function DealParam($custom_param){
        $custom_param=str_replace(['\\','$','.','(',')','*','+','[',']','?','^','{','}','|'],
            ['\\\\','\$','\.','\(','\)','\*','\+','\[','\]','\?','\^','\{','\}','\|'],$custom_param);
        return $custom_param;
    }
    private function DealRes(){
        if(!empty($this->pattern)){
            preg_match_all($this->pattern,$this->subject,$data);
            if($data){
                if(isset($data[0])){
                    $this->regex_res=$data[0];
                }
            }
        }
        return $this;
    }

    public function First(){
        if($this->regex_res){
            $res_data=$this->regex_res;
            return $res_data[0];
        }
        return false;
    }
    public function Last(){
        if($this->regex_res){
            $res_data=$this->regex_res;
            if(count($res_data)>1){
                return $res_data[count($res_data)-1];
            }else{
                return $res_data[0];
            }
        }
        return false;
    }
    public function All(){
        if($this->regex_res){
            return $this->regex_res;
        }
        return false;
    }
    public function Num($num){
        if($this->regex_res){
            $regex_res=$this->regex_res;
            return $regex_res[$num];
        }
        return false;
    }
    public function getPattern(){
        return $this->pattern;
    }
    /**
     * @return int
     */
    public function Count(){
        if($this->regex_res){
            return count($this->regex_res);
        }
        return 0;
    }
}