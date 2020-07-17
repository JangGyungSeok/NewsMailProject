# 메일 발송 API 테스트

![image-20200717153705360](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200717153705360.png)

	GuzzleHttp\Client(); 사용
	http method 접근을 해주는 도구라고 보면 된다.
	
	POST방식의 method로 접근했기 때문에
	query가 아닌 form_params로 data를 넘겨주게된다.

![image-20200717153854728](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200717153854728.png)

![image-20200717153831360](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200717153831360.png)

	테스트를 위해 route설정한 경로를 통해 httpresponse를 출력했다.
	
	메일발송 테스트 완료!