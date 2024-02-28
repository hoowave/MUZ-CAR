<div align="center">
<img src="/resources/images/muz-car.jpg">

# 라라벨 ORM을 이용한 렌트카 예약 시스템

## 소개
뮤즈카(Muz-Car)의 이름은 '아뮤즈(amuz)'와 자동차를 의미하는 '카(Car)'의 조합으로, 기업의 긍정적인 이미지를 바탕으로 안전하고 편안한 렌트카 서비스를 사용자에게 제공하고자 하는 뜻을 담고 있습니다.

</div>

## 사용 기술

- 백엔드: PHP / Laravel
- 프론트엔드: Vue 3, Tailwind CSS
- 라우팅처리: Inertia.js

## 요구 사항
하나씩 펼쳐서 읽어보시면 좋을 것 같아서 다음과 같이 작성 했습니다.
<details>
<summary>데이터 처리 아키텍처</summary>

"렌트카" 도메인에 대한 과제를 맡으면서, 전체적인 시스템 설계와 구조에 대해 깊이 고민했습니다.<br>
특히, 코드의 유지보수성과 확장성을 향상시키는 방법과, 비즈니스 로직을 효율적으로 처리하는 방법에 중점을 두었습니다.<br>
이 과정에서 결제 시스템과 같은 외부 서비스와의 원활한 통신을 위해 Facade 패턴을 도입하기로 결정했습니다.<br>
시스템의 전체적인 데이터 처리 과정은 다음과 같습니다:
1. Request: 사용자로부터 받은 JSON 형식의 데이터를 시스템이 첫 단계로 받습니다.
2. Controller: 들어온 요청을 받아 초기 유효성 검사를 수행합니다. 이 과정에서 요청 데이터의 형식이 올바른지, 필요한 정보가 모두 포함되어 있는지 등을 검사합니다.
3. Facade: 해당 계층은 다양한 비즈니스 로직과 외부 서비스 통신을 캡슐화하고자 추가했습니다.
4. Service: 실제 비즈니스 로직이 처리되는 계층입니다. 사용자의 요청에 따른 로직을 실행하여, 필요한 작업을 수행하고 결과를 생성합니다.
5. Model: 데이터베이스와의 상호작용을 담당하는 계층입니다. 데이터의 저장, 조회, 수정, 삭제 등 데이터베이스와 관련된 모든 작업을 처리합니다.

</details>

<details>
<summary>1. 라라벨 프레임 워크를 설치, 로컬에 개발환경 구축</summary>
- PHP 8.0.2 / Laravel 9.19 설치 완료 및 개발환경 구축 완료
</details>

<details>
<summary>2. Route 정의</summary>

* Front-End<br>
- / : 등록된 차량 리스트 페이지 제공 -> Inertia::render('list'); 사용<br>
- /create : 차량 등록 페이지 제공 -> Inertia::render('create'); 사용<br>
- /show/{id} : 차량별 예약 정보 확인 페이지 제공 -> Inertia::render('show'); 사용<br>
- /reservation : 차량 예약 페이지 제공 -> Inertia::render('reservation'); 사용<br>
- 프론트엔드는 Inertia.js를 활용하여 라우팅 요청에 따라 페이지를 동적으로 렌더링합니다. 페이지 로딩 전에는 fetch API를 통해 백엔드 서버로부터 필요한 데이터를 요청하고, 응답 받은 데이터를 기반으로 사용자에게 최종 페이지를 제공합니다. <br>
<br>

* Back-End<br>
- /create(POST) : 차량 등록을 하기 위한 API<br>
- /list(GET) : 차량 목록을 불러오기 위한 API<br>
- /info(POST) : 차량 상세 정보를 불러오기 위한 API<br>
- /reservation(POST) : 예약 등록을 하기 위한 API<br>
- /reservation/intro(POST) : 예약 등록 전, 사용자가 입력한 예약 정보에 대한 최종 정보를 보여주며, 예약 가능 여부를 판단하기 위한 API<br>
- /show(GET) : 등록된 예약 정보를 불러오기 위한 API<br>
- /show(POST) : 예약 상세 정보를 불러오기 위한 API<br>
</details>

<details>
<summary>3. migration을 사용해 table 생성 : table은 임의로 생성하시면 됩니다.</summary>

* [migration](/introduce/migrations.php)

<img src="/introduce/erd.png">

</details>

<details>
<summary>4. 생성된 table을 바탕으로 Eloquent ORM에 postModel 만들기</summary>

* [차량 모델](/app/Models/Car/Model/CarModel.php)
* [차량 상세정보 모델](/app/Models/Car/Model/CarDetailModel.php)
* [예약 모델](/app/Models/Reservation/Model/ReservationModel.php)

</details>

<details>
<summary>5 ~ 8 기능적 요구사항</summary>
5. create route에서 차량을 등록할 수 있도록 처리<br>
6. list route 에서 create된 차량 List 및 예약 가능 여부를 볼 수 있도록 처리<br>
7. list route의 차량을 클릭하면 show route로 이동하며 해당 차량의 예약 정보 확인<br>
8. show route에서 "예약" 버튼 클릭하면 reservation route로 이동 하여 예약 할 수 있도록 처리<br>
- 예약 시작일/시간, 종료일/시간 설정<br>
- 중복 예약이 안되어야 함. 중복을 막는 시점은 예약시 날짜를 선택하는 단계에서 dim 처리<br>
해당 요구사항은 구현하는 API 예시를 작성했습니다.<br>

* [API 문서](/API.md)

</details>

<details>
<summary>9. Frontend View 구현시 Tailwind & Inertia Vue 사용</summary>

<details>
<summary>차량등록</summary>
<img src="/introduce/create-1.png">
<img src="/introduce/create-2.png">
<img src="/introduce/create-3.png">
<img src="/introduce/create-4.png">
</details>

<details>
<summary>차량목록</summary>
<img src="/introduce/list-1.png">
<img src="/introduce/list-2.png">
</details>

<details>
<summary>예약하기</summary>
<img src="/introduce/reservation-1.png">
<img src="/introduce/reservation-2.png">
<img src="/introduce/reservation-3.png">
<img src="/introduce/reservation-4.png">
</details>

<details>
<summary>예약목록</summary>
<img src="/introduce/show-1.png">
<img src="/introduce/show-2.png">
</details>

</details>

<details>
<summary>10. 제출기한전까지 상기사항 작업 후 시간이 남으면 회원가입, 로그인, 게시물 비밀번호등 구현하실 수 있는 기능이 있으시면 더 하셔도 됩니다.</summary>
회원 관리 기능을 추가하는 것은 서비스의 가치를 높일 수 있는 좋은 방법이라고 생각합니다.<br>
그러나 제가 집중한 것은 우선 주어진 요구사항을 충실히 만족시키는 것이었습니다.<br>
이 과정에서 시스템의 유연성과 확장성을 최대한 끌어올리려 노력했고, 사용자 경험을 향상시키기 위해 제공된 라우팅 정보를 기반으로 한 친화적이고 유연한 모달창 사용에 주안점을 두었습니다.<br>
만약 시간이 허락한다면, 회원가입, 로그인, 게시물 관리 등 추가적인 기능을 구현하여 서비스의 완성도를 더욱 높이고자 합니다.
</details>















