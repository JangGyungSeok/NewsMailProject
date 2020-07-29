# NewsMailProject

----------------------------

## 진행상황

### 2020-07-15
	master -> gitrepository 생성 및 Laravel 기본 프로젝트 생성완료
	master -> develop 브랜치 생성
	develop -> JKS 브랜치 생성

### 2020-07-16
	JKS -> Practice프로젝트 fabpot/goutte 의존성 설치
	JKS -> goutte활용 크롤링 로직 작성 완료 (페이지 넘기기 작업만 미완성)

### 2020-07-17
	JKS -> Practice프로젝트 mysql연결 설정 변경 127.0.0.1 -> mysql
	JKS -> Docker php image 공식 이미지는 extension 미설치 상태
	        docker php 관련 extension 설정 완료
	JKS -> 크롤링 로직 작성, DB연동, 테이블정의(migration) 및 모델 관계 정의 완료
	JKS -> develop 브랜치 병합
	develop -> master 브랜치 병합
	develop -> master 브랜치 pull
	JKS -> develop 브랜치 pull
	JKS -> 브랜치 상태 확인을 위한 push

### 2020-07-20 ~ 22
	JKS -> gateway page Route정의 및 사용자 확인 로직 실행(DB적재)
	JKS -> 크롤링 로직 전면 수정
	JKS -> 전체 코드 MVC기반 재정리
	JKS -> develop 브랜치 병합
	develop -> master 브랜치 병합

### 2020-07-23
	JKS -> 텔레그램 메시지 발송 로직 작성
	JKS -> Controller 로직 Service로 이동
	JKS -> 각 Service 로직 Exception 확인 및 처리로직 정의
	JKS -> 각 Exception에 따른 텔레그램 메시지 발송 확인
	JKS -> develop 브랜치 병합
	develop -> master 브랜치 병합
