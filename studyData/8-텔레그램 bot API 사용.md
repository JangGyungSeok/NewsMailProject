# 텔레그램 bot API 사용

## telegram 

![image-20200722175834863](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200722175834863.png)

	텔레그램 bot API생성 및 호출동작 테스트

![image-20200722175927755](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200722175927755.png)

	메시지 동작 확인
	
	추후 크롤링 동작 실패, 당일 기사가 없어 크롤링 미진행,
	메일발송 실패 등 특정 동작에 따라 메시지를 발송할 예정

## 한계사항
	텔레그램 bot API를 webhook설정하여 method 결과값을 반환하고 싶었으나
	SSL인증키 즉 https 인증이 되지 않은 host는 webhook불가
	
	또한 이를 위해 ngrok을 사용하려 했으나 회사네트워크라 배포는..