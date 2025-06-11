# 서비스 소개

---------------------------------------
## 개요
인포뱅크 OMNI API는 간편하게 연동 할 수 있는 통합메시지 API 입니다.

다양한 채널의 메시지 ( SMS, MMS, 국제메시지, RCS, 카카오 비즈메시지 등 ) 발송 및 리포트 결과, 메시지 간 Fallback 기능을 제공합니다.


## 설치방법
php7.2.5 이상 사용가능합니다.

아래 명령어를 통해 composer 2.x설치를 진행합니다.
```shell
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
sudo php composer-setup.php --version=2.x --install-dir=/usr/local/bin --filename=composer
```

아래 명령어를 통해 패키지 의존성 설치를 진행합니다.
```shell
cd {omni_sdk_php 설치 경로}

composer install
```


## 사용법

sdk 사용을 위해서는 [인포뱅크 비즈플러스](https://www.ibizplus.co.kr/main)를 통해 계정 발급 후 사용할 수 있습니다.

### client 발급
아래와 같이 api 인스턴트 생성 후 기능을 호출 할 수 있습니다.
```php
use Infobank\InfobankClient;

$client = new InfobankClient(<baseUrl>, <token>, <clientId>, <password>);
```
두번째 인자인 token의 경우 [OMNI-API 인증](https://infobank-guide.gitbook.io/omni-api-specification/api-reference/auth) 규격을 참고하시어 발급받은 후,
캐시에 저장하여 만료시간동안 재사용을 권장드립니다.

※ 빈값으로 넣고 InfobankClient 생성자를 호출 할 경우, 매번 새로 token을 발급 받습니다.(RateLimit 등 제약에 걸릴 수 있음)

### 파일 및 폼 관리
- 규격 확인: [OMNI-API-관리](https://infobank-guide.gitbook.io/omni-api-specification/api-reference/management)
- 참고 코드
  - regist_file.php
  - regist_form.php

### 발송
- 규격 확인: [OMNI-API-전송](https://infobank-guide.gitbook.io/omni-api-specification/api-reference/send)
- 참고 코드
  - send_kko.php 
  - send_mms.php 
  - send_rcs.php
  - send_sms.php

※ 발송 요청에 대한 결과 코드가 성공인 경우, 접수 성공을 의미하며 실제 발송 결과는 리포트를 확인해야 합니다.

simple SMS 발송 예제 소스입니다.
```php
$client = new InfobankClient($baseUrl, $token, $clientId, $password);

$msg = new SmsMessage("0316281500","01012341234","hello sms");

// 옵션 필드 setting
$msg
    ->setRef("참조필드(자체 msg uuid 등)")
    ->setOriginCID("1234");

$apiResponse = $client->sendMessage($msg);
```

발송 응답 결과는 아래와 같습니다.
```php
echo "code : " . $response->getCode() . "\r\n";
echo "result : " . $response->getResult() . "\r\n";
echo "msgKey : " . $response->getMsgKey() . "\r\n";
echo "ref : " . $response->getRef() . "\r\n";
```


### 리포트
- 규격 확인: [OMNI-API-리포트](https://infobank-guide.gitbook.io/omni-api-specification/api-reference/report)
- 참고 코드
  - report_polling.php

리포트는 polling 방식으로 제공되며 아래와 같이 수신 받을 수 있습니다.


reportPollingGet() 함수를 호출하여 report를 수신합니다.
```php
$client = new InfobankClient($baseUrl, $token, $clientId, $password);

$apiResponse = $client->reportPollingGet();
```

리포트는 List형태로 수신됩니다.
```php
echo "status_code : " . $apiResponse->getHttpCode() . "\r\n";
echo "code : " . $apiResponse->getCode() . "\r\n";
echo "result : " . $apiResponse->getResult() . "\r\n";
echo "reportId : " . $apiResponse->getData()->getReportId() . "\r\n";

foreach($apiResponse->getData()->getReport() as $report ){
    echo json_encode($report). "\r\n";
}
```

리포트 수신 확인 후 reportId로 delete method를 호출해야 다음 리포트를 받을 수 있습니다.
(delete 하지 않고 재호출 시 동일한 리포트를 수신받게 됩니다)
```php
$response = $client->reportPollingDel(
    $apiResponse->getData()->getReportId()
);

echo "status_code : " . $response->getHttpCode() . "\r\n";
echo "code : " . $response->getCode() . "\r\n";
echo "result : " . $response->getResult() . "\r\n";
```

### 결과코드
- 결과 코드 확인: [OMNI-API-코드표](https://infobank-guide.gitbook.io/omni-api-specification/api-reference/code)


## Contact
본 문서와 관련된 기술 문의는 아래 메일 주소로 연락 바랍니다.
support@infobank.net