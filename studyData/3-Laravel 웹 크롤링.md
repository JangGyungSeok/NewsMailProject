# Laravel 웹 크롤링

## 1. 웹 크롤링 도구 선정
	Spatie/Crawler (필요하지 않은 기능이 상당수, 필요한 의존성 다수) - 미선정
	Snoopy (세부적인 Data까지 크롤링하기에 부적합하다고 판단) - 미선정
	fabpot/goutte (사용했던 BeautifulSoap과 사용법이 비슷, 적합) -선정

## 2. fabpot/goutte 설치
	Composer를 사용해 의존성 설치
	composer require fabpot/goutte -> 저장소에서 다운로드

![image-20200716152749871](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200716152749871.png)

	use를 통해 의존성에 접근 및 객체생성하여 진행

![image-20200716152829446](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200716152829446.png)

	페이지를 넘어가는 로직을 제외하고는 전부 구현완료! (95% 완료) -> 2020-07-16 15시00분