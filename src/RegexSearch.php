<?php
/**
 * User: amoy
 */

namespace Amoy\RegexSearch;


/**
 * Class RegexSearch
 * @package Amoy\RegexSearch
 *
// * @method Ip()
// * @method Email()
// * @method Alls()
 */
class RegexSearch{

    protected $EMAIL="/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
    protected $IP="/\d+\.\d+\.\d+\.\d+/";


    protected static $instance = null;
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
    public function setSubject($subject){
        $class=new self();
        $class->subject=$subject;
        return $class;
    }
    public function Email(){
        $this->pattern=$this->EMAIL;
        return $this->DealRes();
    }
    public function Ip(){
        $this->pattern=$this->IP;
        return $this->DealRes();
    }
    private function DealRes(){
        preg_match_all($this->pattern,$this->subject,$data);
        if($data){
            if(isset($data[0])){
                $this->regex_res=$data[0];
                return $this;
            }
        }
        return false;
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
        return $this->regex_res;
    }
}