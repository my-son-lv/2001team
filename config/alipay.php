<?php
return[
    //应用ID,您的APPID。
    'app_id' => "2016101800713184",

    //商户私钥，您的原始格式RSA私钥
    'merchant_private_key' =>"MIIEpAIBAAKCAQEAtjF1fDPbWs7dJ3p/olJ1v2X/LqpezLv7K69OaDxEWf0i1/3FLOAjvvKjxliX32Q692kct1nCJyyE8LIpdyunYMgY9s+f+6s4I8Nn1U+kHUvJdl8lvvIOwLykWv0XtwTSFlq6kyvqoNA+l2U9GD19MkLuu/8Tl1D1ar3f37GttWRaXCvguLqivbDBuedoS/uHRtEnXGCcFOGPlZr9c+32AAVB1FKgeQ6f7GsoKri+vLvQ9s3MINM4PGodHOjvydd8bWCyn9k8rsKbRWYj0ku8m9zPufAfLCj3vADJIUXpJCtNAF4cYVfrf/VepfJIK4UkCvSSSpUA2qifs1adxPL1VwIDAQABAoIBACPoyaQqQGC8hwBB96gRop2Px+T1tWua3V111vlab4phBx4VKWi34LPA9SCh04U3JxwefodwzICWGLmsE9omI35C0hDLSVf8HjuGRw/W+5y+lD2dcT4aTWgVhjtcyPDMpW+8gCuDq2H4yW1jidAeRm/Cm3U4SC85yLU6KUbYqUkn4URiIqoq0jrerBBmiOw1p0d1nC6/G6pATjSuH1PYLfiNNmgrsNQr1ZRRr7VkhhyP/wJcgPbW8dVOxSW1ASxOGEJFiRJVEGjb0CoKDaLwJs64Ws8Qd62iDyDyADgslGv5Uo/NPonzqc8Y90UOLUfp3ogKLYDirwDQKSoK84C4JwkCgYEA+t4Y/8+lu+AMruHaoqZOm7tvFwkldRxSnnOBJrh3CBW09CrqUuIYox8GU68KGHpRQ1B7yJloiOfHlkKGqz2kjdTvfM5oE3nR03a7kdcba2yQGP0/c2Q3hZMD3+xHcO7w+3VoBBLVVgOv3ibpffa2EbxelfH0bw8Ny6wQxWliVAsCgYEAueuvDNKyUKUjqyuN/Aj/AAPdL347cPy4jWzFlrfT4iXx6DOVHQ5bNRCiSaaLt/nMP7cEedxIZ577s9opr/WrZktFj/T0aA3LPj9kPVXI7WEuM777zzH/vXOpqyaW9rhvAZdVBTywXsU1lINJWl3j7pNNtyhJDTywGCRJC4RCh2UCgYEA4zzzICUTVw8n7fGffd1vLxmlExSx3Vb+b5Do2A4XpDclZlbJUrKC5p9ft8XCO1Hw8iyhM5/iVMC+xZkVK1/3ApJzLHY7SAj8y7OtS/mxWKlKDZi4NOn+cPwuclMwk1ec6en7glUc8YD9eRl+Px+O5Jngg6pbY44bTPZbarZ+3ukCgYAX+uswJzjyp+oq2MpOeMaTNOxhhNGb6CzRqPbvUrSUlbpW7dhM0B45gPS9tSqORzzt9ugv45a/LsVeVEROOsypvAmz4K9pgGX3mGuQcbEh1QgFipumBNfskq+OsMKF/hHrTZ6ct1A0WRFpH2nlqviMPBmpBxwtBefcpUl6n8uI9QKBgQDlg8yjHYVKXAPoN7R8h4Ks5vpf2S6sC1yEf3Ehm8aAEpHLxtMlubJmn8DRidbHrl71UK7eg7K0zto9aFhfXsoq/cS8XxGETLRgIDihnR4LIOg5IESBAiDeKOfXfM1pgiLehf61hV69r2CIrLh28sIs3IfU5HXGpW7xpGNf/LM4Uw==",
    //异步通知地址
    'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP- -8/notify_url.php",

    //同步跳转
    'return_url' => env('JUSTMES_URL')."pay/return_url",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //商户id
    "seller_id" => "2088102180088525",
    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAgU4gXU+IuxqZp3rdN6toVYDyXssFZiXsZoayt58S0EjY3Yyag05yryBRFbt+Gqz34u0NCDaLxY6EgthKbKZTcoZiVirAnBr3BvhfbJFyLGHbdemFVGDIpQEFU6L8o4889yOdEI5OgAwmPVXTB6rB7XmpWjk1AIq1FzoelgL4G67pTVVqmCdY8UF+ZPAY4cBeLnDTotRRXn/OptgNwqgA61Vqiy6Lzp6SiPwrBsXq5GVv34jGGGKGlNw50WOWuF4XwbDgeQfPKZ/IVmBHYs90RIgFyrSV19Po2QXOvEjOReNsCZXJyunQKKpRxIUqcb64CCJE5e9UdYzfkAPiVCdnOQIDAQAB",
];

?>