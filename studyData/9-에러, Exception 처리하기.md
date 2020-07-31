# 에러, Exception 처리하기

## 1. Crawling
### 1-1. url이 잘못되었을 때

![image-20200723112907558](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200723112907558.png)

	이러한 exception 반환

### 1-2. CSS Selector가 잘못되었을 때

	이 경우는 에러로그를 남기지 않는다 다만

![image-20200723113243941](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200723113243941.png)

	이러한 설명을 확인할 수 있다.

## 2. 메일발송

### 2-1. 메일발송 url이 잘못되었을 때

![image-20200723113743877](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200723113743877.png)


## 3. 데이터베이스 접근

	Model에서 DB접근 실패 시 예외처리 필요





## 결론. 내가 처리한 방법

![image-20200729162357676](C:\Users\user\AppData\Roaming\Typora\typora-user-images\image-20200729162357676.png)

	CustomException이름의 Exception을 생성했다.
	이는 CustomException이 발생했을 때 report와 render메서드를 이용해 처리한다.
	현재 오류라 생각되는 부분에 있어 throw new CustomException(situation)을 입력한다.
	
	situation 문자열의 값에 따라 텔레그램으로 다른 메시지를 전송한다.