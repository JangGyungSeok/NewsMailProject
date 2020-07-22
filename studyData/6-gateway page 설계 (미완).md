# gateway page 설계 (미완)

## 1. Gateway page 관련 redirect 로직 정의

![image-20200720094414373](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200720094414373.png)

	GET방식의 gateway page 경로 = /gateway 를 정의함
	이 경로로 들어온 요청은 GatewayController의 enterGateway로직을 실행한다.

![image-20200720094510262](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200720094510262.png)

	이와 같이 query를 통해 넘어온 데이터를 사용한 로직을 실행
	현재는 수신자 정보 데이터를 받지 않은 상태이므로 url로의 redirect만을 정의했다.

![image-20200720094638654](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200720094638654.png)

	이는 사람인 채용공고 a태그 정보이다.
	query는 uid, url, skey, ix, lk가 넘어왔다.
	
	url은 parsing되어 넘어온 것을 확인할 수 있다.
	
	나머지는 사람인 사이트의 게시물 idx와
	사용자 판별정보로 보인다.
	skey에 대한 정보는 더 알아볼 예정이다.

