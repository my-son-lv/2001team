<?php
/**
 * Created by PhpStorm.
 * User: season
 * Date: 2019/4/7
 * Time: 15:33
 */

namespace App\Common;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

use Lcobucci\JWT\ClaimsFormatter;
use Lcobucci\JWT\Configuration;

/**
 *
 * 单例模式 一次请求只针对一个用户.
 * Class JwtAuth
 * @package App\Lib
 */
class Jwt
{
    private static $instance;
    // 加密后的token
    private $token;
    // 解析JWT得到的token
    private $decodeToken;
    // 用户ID
    private $uid;
    // jwt密钥
    private $secrect = 'cSWI7BXwInlDsvdSxSQjAXcE32STE6kD';

    // jwt参数
    private $iss = 'http://example.com';//该JWT的签发者
    private $aud = 'http://example.org';//配置听众
    private $id = '4f1g23a12aa';//配置ID（JTI声明）

    /**
     * 获取token
     * @return string
     */
    public function getToken()
    {
        return (string)$this->token;
    }

    /**
     * 设置类内部 $token的值
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }


    /**
     * 设置uid
     * @param $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 得到 解密过后的 uid
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 加密jwt
     * @return $this
     */
    public function encode()
    {
//        $time = time();
//        $this->token = (new Builder())
//            ->setIssuer($this->iss)// Configures the issuer (iss claim)
//            ->setAudience($this->aud)// Configures the audience (aud claim)
//            ->setId($this->id, true)// Configures the id (jti claim), replicating as a header item
//            ->setIssuedAt($time)// Configures the time that the token was issued (iat claim)
//            ->setNotBefore($time + 60)// Configures the time that the token can be used (nbf claim)
//            ->setExpiration($time + 3600)// Configures the expiration time of the token (exp claim)
//            ->set('uid', $this->uid)// Configures a new claim, called "uid"
//            ->sign(new Sha256(), $this->secrect)// creates a signature using secrect as key
//            ->getToken(); // Retrieves the generated token
//        echo $this->token;die;

        $config = $container->get(Configuration::class);
        assert($config instanceof Configuration);

        $now   = new DateTimeImmutable();
        $token = $config->builder()
            // Configures the issuer (iss claim)
            ->issuedBy('http://example.com')
            // Configures the audience (aud claim)
            ->permittedFor('http://example.org')
            // Configures the id (jti claim)
            ->identifiedBy('4f1g23a12aa')
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($now->modify('+1 minute'))
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify('+1 hour'))
            // Configures a new claim, called "uid"
            ->withClaim('uid', 1)
            // Configures a new header, called "foo"
            ->withHeader('foo', 'bar')
            // Builds a new token
            ->getToken($config->signer(), $config->signingKey());
        return $this;
    }


    /**
     * 解密token
     * @return \Lcobucci\JWT\Token
     */
    public function decode()
    {

        if (!$this->decodeToken) {
            $this->decodeToken = (new Parser())->parse((string)$this->token);
           // $this->uid = $this->decodeToken->getClaim('uid');
        }

        return $this->decodeToken;

    }


    /**
     * 验证令牌是否有效
     * @return bool
     */
    public function validate()
    {
        $data = new ValidationData();
        $data->setAudience($this->aud);
        $data->setIssuer($this->iss);
        $data->setId($this->id);
        return $this->decode()->validate($data);
    }

    /**
     * 验证令牌在生成后是否被修改
     * @return bool
     */
    public function verify()
    {
        $res = $this->decode()->verify(new Sha256(), $this->secrect);
        return $res;
    }


    /**
     * 该类的实例
     * @return JwtAuth
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 单例模式 禁止该类在外部被new
     * JwtAuth constructor.
     */
    private function __construct()
    {
    }

    /**
     * 单例模式 禁止外部克隆
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

}