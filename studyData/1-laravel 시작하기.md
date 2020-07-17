# laravel 프로젝트

## 환경설정

## 1. 필요한 프로그램들
	환경에 따라 다르다.
	
	웹서버 - nginx
	Language - php 7.4
	DB - MariaDB or MySql
	
	필자는 WNMP라는 툴을 사용해 한번에 설치했다.
	Laravel프레임워크 사용 시 내장 서버로 동작하지만
	PHP에 대한 설정을 바꿔줌으로 호스팅할 수 있다.
	
	의존성 관리 툴 - Composer
	Laravel 프론트엔드 스캐폴딩 - NPM (Node.js를 설치하면 함께 설치된다.)

## 2. Server 관련하여

	PHP로 작성한 소스들은 기본적으로 php내장서버로 동작하게된다.
	NginX서버를 사용하도록 설정해야된다.
	
	https://rumblefish.tistory.com/37 <- 를 참고해 php와 nginx를 연동해본다.
	
	https://medium.com/sjk5766/docker-container%EC%97%90%EC%84%9C-laravel-%EC%84%A4%EC%B9%98-%EB%B0%8F-%EC%8B%A4%ED%96%89%ED%95%98%EA%B8%B0-cd9ed211927e
	
	nginX 설정을 변경할 일이 잦을예정이다.
	
	기본적으로 server{}에 해당하는 부분을 설정한다.
	nginx의 root경로를 해당하는 프로젝트 경로로 변경한다.


​	
​	또한 location / { 속에try_files $uri $uri/ /index.php?$query_string; 을 꼭 추가해야한다.
​	기본 index.php에서 다른 경로를 찾아가기 위함이다.
​	
	js, css등은 프로젝트의 설정값을 따르기 때문에 별 문제없다.


​	
​	Laravel 프로젝트 NginX 서버로 동작하기 (최종)
​	https://medium.com/@koswarabilly/laravel-with-nginx-installation-to-set-up-94eae92e2541


## 3. 프로젝트 생성
	-- 설명 --
	PhpStrom을 사용하면 composer project생성으로 간편하게 생성가능하다.
	
	외 terminal을 사용해 디렉토리를 생성하기 위해선 다음과같은 키워드가 필요하다.
	create create-project laravel/laravel '프로젝트명'
	vendor 파일이 미생성되었을 경우 composer install 하면된다.
	php artisan key:generate 로 키를 생성해준다.


## 4. UI 스캐폴딩
	-- 설명 --
	Laravel은 JavaScript, CSS, Vue.. 등등의 프론트엔드 패키지를 NPM을 사용해 관리한다.
	(NPM을 설치하지 않을경우 프로젝트 내 프론트엔드 파일에 접근하기 어려울 수 있다.)
	
	기존의 front-end 는 laravel/ui로 분리되었고 make:auth는 사라졌다.
	composer require laravel/ui --dev -> ui를 생성해준다.
	라라벨 제공 부트스트랩 및 Vue 스캐폴딩은 laravel/ui에 속해있다.
	
	-- 명령어 --
	php artisan ui bootstrap
	php artisan ui vue
	php artisan ui react
	--auth를 붙일수도있다.
	ui관련 의존성을 추가해주는 부분이다.

--------------------------------
## 환경설정 끝
------------------------------

## Laravel 프로젝트 시작

## 1. MVC
	Laravel의 경우 기본적으로 MVC를 기반으로 한다.
	Controller에 해당하는 php파일,
	Views에 정의되는 php+html파일,
	routes에 정의되는 php파일
	이렇게 연동되어 서비스를 구성한다.
	
	Laravel에서는 DB 연동을 간편하게 구현할 수 있다.
	DB에 관련된 Model을 각 1개씩 가지며 일반적으로 Controller도 하나씩 가지게된다.
	-------------------------------------


## 1.데이터베이스
	1. migration
	Laravel에서는 migration파일을 정의해 DB테이블 생성을 돕는다. (DB설계 변동사항이 있을 경우 용이하다.)
	php artisan migrate 키워드를 사용해 필요한 테이블을 정의한다.
	DB관련 설정은 env의 값을 config경로의 파일들이 참조해 사용한다.
	따라서! env의 값을 설정해주면 자동으로 적용된다. (다만 적용되려면 서버를 재동작해야한다.)
	
	2. Model 매핑 (DB table의 데이터를 다대다, 다대일로 매핑한다. 관계를 정의함에 따라 편리한 기능들을 사용할 수 있다.)
	
	3. 데이터베이스 시딩 seeding
	서비스 구성에 필요한 기본 데이터, 개발중에 필요한 데이터, 테스트를 위한 데이터를 빠르게 준비할 수 있게해준다.
	php artisan make:seeder 'seeder클래스명' 키워드를 실행함으로 생성할 수 있다.
	생성 시 run이라는 메서드를 포함하는 클래스가 생성된다.
	시딩 로직을 run 안에 넣음으로 커스텀할 수 있다.
	php artisan db:seed --class='클래스명' 키워드로 실행하고 DB를 확인하면 임의값을 확인할 수 있다.
	
	4. Model Factory (모델팩토리) (더미데이터를 빠르게 만들 수 있는 도구)
	시더와 비슷하다!

## 2. Controller 정의
	Laravel에서는 비즈니스로직을 Controller에 정의한다.
	보통 DB와의 연결을 통해 데이터를 받아오거나
	Request와 함께 넘어온 데이터를 처리해 반환하는 등의 로직이 수행된다.
## 3. Routes
	Spring처럼 Controller에 annotation으로 mapping하는 것이 아니라
	Routes경로에서 Controller의 메서드 명을 참조하며 매핑한다.
	get, post로 요청 http method를 구분해 작성하도록 한다.
	
	또한 authentication 설정 시 권한이 필요한 리소스를 이곳에 정의한다.
	middleare('auth') 같은 태그를 뒤에 추가해 정의한다. (마찬가지로 middleware로 정의된 것들은 이렇게 사용가능하다.)
## 4. Auth
	php artisan make:model author
	키워드를 사용해 auth도 만들 수 있다.
## 5. RESTful 구현
	Laravel 에서 RESTful 리소스컨트롤러는 REST원칙에 따라 URL을 컨트롤러 메서드에 자동 연결한다.
	--resource 옵션을 주고 새로운 컨트롤러를 만들자.
	URL정의 규약에 따라 자동으로 생성해주는 기능이다.
## 6. 인증(authentication) & 인가(authorization)


## *참고사항
	1. 스케줄링!!
	 서버에 Cron항목을 추가해줌으로 작업 스케줄을 정의할 수 있다.
	https://laravel.kr/docs/7.x/scheduling 을 참고하도록 한다.
