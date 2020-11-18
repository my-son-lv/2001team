<?php
namespace App\Console\Auth;
//use Illuminate\Validation/\ValidationData;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class Jwt{
    private $token;
    //  jwt签发者
    private $iss="http://www.2001team.com";
//    接受jwt的一方
    private $aud="http://www.2001api.com";
    //用户id
    private $uid;
    //私钥
    private $privateKey="!@#$%^&*()";
    private $decodetoken;

    //私有的静态变量 存放实例
    private static $instance;
    //私有的构造方法  防止类外new实例
    private function __construct()
    {

    }
//    私有的克隆 防止被克隆
    private function __clone(){

    }

    public static function instance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    //生成token
    public function product(){
        $time = time();
        $this->token = (new Builder())->setHeader('alg','HS256')
            ->issuedBy($this->iss) // Configures the issuer (iss claim)
        ->permittedFor($this->aud) // Configures the audience (aud claim)
        ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
        ->issuedAt($time) // Configures the time that the token was issue (iat claim)
        ->canOnlyBeUsedAfter($time) // Configures the time that the token can be used (nbf claim)
        ->expiresAt($time + 3600) // Configures the expiration time of the token (exp claim)
        ->withClaim('uid', $this->uid) // Configures a new claim, called "uid"安装
        ->sign(new Sha256(),$this->privateKey)
        ->getToken(); // Retrieves the generated token
        return $this->token;
    }

    public function setuid($uid){
        $this->uid = $uid;
        return $this;
    }
    public function getToken(){
        return (string)$this->product();
    }
    public function setToken($token){
        $this->token = $token;
        return $this;
    }
    //将字符串token转成token实例
    public function decode(){
        if(!$this->decodetoken){
            $this->decodetoken = (new Parser())->parse((string) $this->token );
            $this->uid = $this->decodetoken->getClaim('uid');
//            dd($this->uid);
        }
        return $this->decodetoken;
    }
    //验证签名是否有效
    public function verify(){
        $signer = new Sha256();
        $res = $this->decode()->verify($signer,$this->privateKey);
        return $res;
    }
    //验证jwt签发者和接收方以及唯一身份是否正确
    public function Validate(){
        $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer($this->iss);
        $data->setAudience($this->aud);
        $data->setId('4f1g23a12aa');
        $res = $this->decode()->validate($data);
        return $res;
    }
    //获取用户id
    public function getUid(){
//        dd($this);
        return $this->uid;
    }


}
