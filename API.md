# 차량등록

## Request

**URL** : `/api/create`

**Method** : `POST`

**Auth required** : NO

**데이터 제약**

```json
{
    "brand": "[제조사]",
    "model": "[모델명]",
    "type": "[차종]",
    "introduction": "[차량소개]",
    "year": "[차량연식(2010~2024 선택)]",
    "fuel": "[연료유형(휘발유,경유,LPG 선택)]",
    "seats": "[인승(1~8 선택)]",
    "gear": "[기어(수동,자동 선택))]"
}
```

**데이터 예시**

```json
{
    "brand": "현대",
    "model": "싼타페",
    "type": "SUV",
    "introduction": "싼타페 차량소개입니다.",
    "year": "2020",
    "fuel": "",
    "seats": "4",
    "gear": ""
}
```


## Response

**Code** : `200 OK`

**성공 응답**

```json
{
    "status": "success",
    "message": "싼타페 차량의 등록이 완료되었습니다."
}
```

**실패 응답 1**

**조건** : 동일한 모델명이 이미 존재하는 경우

**Code** : `200 OK`

**내용** :

```json
{
    "status": "error",
    "message": "이미 존재하는 모델입니다."
}
```

# 차량목록

## Request

**URL** : `/api/list`

**Method** : `GET`

**Auth required** : NO

**데이터 제약**

```json
{
}
```

**데이터 예시**

```json
{
}
```


## Response

**Code** : `200 OK`

**성공 응답**

```json
{
    "status": "success",
    "data": [
        {
            "id": 8,
            "brand": "현대",
            "model": "싼타페",
            "type": "SUV",
            "introduction": "차량소개",
            "del_yn": "N",
            "created_at": "2024-02-28 08:12",
            "updated_at": "2024-02-28 08:12"
        },
        {
            "id": 7,
            "brand": "test",
            "model": "test",
            "type": "test",
            "introduction": "test",
            "del_yn": "N",
            "created_at": "2024-02-28 07:18",
            "updated_at": "2024-02-28 07:18"
        },
        {
            "id": 6,
            "brand": "기아",
            "model": "K7",
            "type": "준대형",
            "introduction": "기아\nK7\n소개\n입니다~",
            "del_yn": "N",
            "created_at": "2024-02-28 03:26",
            "updated_at": "2024-02-28 03:26"
        },
        {
            "id": 5,
            "brand": "기아",
            "model": "K3",
            "type": "세단",
            "introduction": "안녕\n하세요\nK3\n입니다",
            "del_yn": "N",
            "created_at": "2024-02-27 06:45",
            "updated_at": "2024-02-27 06:45"
        },
        {
            "id": 4,
            "brand": "기아",
            "model": "K5",
            "type": "세단",
            "introduction": "안녕하세요\nK5차량\n입니다.",
            "del_yn": "N",
            "created_at": "2024-02-27 06:37",
            "updated_at": "2024-02-27 06:37"
        },
        {
            "id": 3,
            "brand": "현대",
            "model": "스타리아",
            "type": "\b대형",
            "introduction": "스타리아소개입니다.",
            "del_yn": "N",
            "created_at": "2024-02-26 08:42",
            "updated_at": "2024-02-26 08:42"
        },
        {
            "id": 2,
            "brand": "현대",
            "model": "베뉴",
            "type": "소형차",
            "introduction": "베뉴소개입니다.",
            "del_yn": "N",
            "created_at": "2024-02-26 08:42",
            "updated_at": "2024-02-26 08:42"
        },
        {
            "id": 1,
            "brand": "현대",
            "model": "캐스퍼",
            "type": "경차",
            "introduction": "캐스퍼소개입니다.",
            "del_yn": "N",
            "created_at": "2024-02-26 08:41",
            "updated_at": "2024-02-26 08:41"
        }
    ]
}
```

# 차량상세정보

## Request

**URL** : `/api/info`

**Method** : `POST`

**Auth required** : NO

**데이터 제약**

```json
{
    "id": "[등록된 차량 id]"
}
```

**데이터 예시**

```json
{
    "id": "2"
}
```


## Response

**Code** : `200 OK`

**성공 응답**

```json
{
    "status": "success",
    "data": {
        "id": 2,
        "brand": "현대",
        "model": "베뉴",
        "type": "소형차",
        "introduction": "베뉴소개입니다.",
        "del_yn": "N",
        "year": 2020,
        "fuel": null,
        "seats": 4,
        "gear": null
    }
}
```

**실패 응답 1**

**조건** : 차량 id가 존재하지 않을 경우

**Code** : `200 OK`

**내용** :

```json
{
    "status": "error",
    "message": "차량 정보를 찾을 수 없습니다."
}
```

# 예약

## Request

**URL** : `/api/reservation`

**Method** : `POST`

**Auth required** : NO

**데이터 제약**

```json
{
{
    "carId": "[차량 id]",
    "startAt": "[예약 시작시간]",
    "endAt": "[예약 종료시간]"
}
}
```

**데이터 예시**

```json
{
    "carId": "2",
    "startAt": "2024-02-28 04:00:00",
    "endAt": "2024-02-28 05:00:00"
}
```


## Response

**Code** : `200 OK`

**성공 응답**

```json
{
    "status": "success",
    "message": "베뉴 차량의 예약이 완료되었습니다."
}
```

**실패 응답 1**

**조건** : 해당 차량 예약 시간이 겹치는 경우

**Code** : `200 OK`

**내용** :

```json
{
    "status": "error",
    "message": "선택한 시간에 이미 다른 예약이 존재합니다."
}
```

**실패 응답 2**

**조건** : 60분 미만으로 예약 요청한 경우

**Code** : `200 OK`

**내용** :

```json
{
    "status": "error",
    "message": "예약 시간은 최소 1시간(60분) 이상이어야 합니다."
}
```

# 예약 정보

## Request

**URL** : `/api/reservation/intro`

**Method** : `POST`

**Auth required** : NO

**데이터 제약**

```json
{
{
    "carId": "[차량 id]",
    "startAt": "[예약 시작시간]",
    "endAt": "[예약 종료시간]"
}
}
```

**데이터 예시**

```json
{
    "carId": "2",
    "startAt": "2024-02-28 04:00:00",
    "endAt": "2024-02-28 05:00:00"
}
```


## Response

**Code** : `200 OK`

**성공 응답 1 : 예약이 불가능한 경우**

```json
{
    "status": "success",
    "data": {
        "carName": "베뉴",
        "startAt": "2024-02-28 04:00",
        "endAt": "2024-02-28 05:00",
        "minutes": 60,
        "cost": 6000,
        "pay_yn": "N",
        "reservation_yn": "N"
    }
}
```

**성공 응답 2 : 예약이 가능한 경우**

```json
{
    "status": "success",
    "data": {
        "carName": "베뉴",
        "startAt": "2024-02-28 05:00",
        "endAt": "2024-02-28 06:00",
        "minutes": 60,
        "cost": 6000,
        "pay_yn": "N",
        "reservation_yn": "Y"
    }
}
```


**실패 응답 1**

**조건** : 차량 정보를 찾을 수 없는 경우

**Code** : `200 OK`

**내용** :

```json
{
    "status": "error",
    "message": "차량 정보를 찾을 수 없습니다."
}
```

**실패 응답 2**

**조건** : 60분 미만으로 예약 요청한 경우

**Code** : `200 OK`

**내용** :

```json
{
    "status": "error",
    "message": "예약 시간은 최소 1시간(60분) 이상이어야 합니다."
}
```


# 예약목록

## Request

**URL** : `/api/show`

**Method** : `GET`

**Auth required** : NO

**데이터 제약**

```json
{
}
```

**데이터 예시**

```json
{
}
```


## Response

**Code** : `200 OK`

**성공 응답**

```json
{
    "status": "success",
    "data": [
        {
            "id": 19,
            "carId": 7,
            "carName": "test",
            "startAt": "2024-02-28 16:18:00",
            "endAt": "2024-02-28 17:18:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 07:18",
            "updated_at": "2024-02-28 07:18"
        },
        {
            "id": 11,
            "carId": 6,
            "carName": "K7",
            "startAt": "2024-02-28 12:26:00",
            "endAt": "2024-02-28 15:26:00",
            "minutes": 180,
            "cost": 18000,
            "pay_yn": "N",
            "created_at": "2024-02-28 03:26",
            "updated_at": "2024-02-28 03:26"
        },
        {
            "id": 12,
            "carId": 6,
            "carName": "K7",
            "startAt": "2024-02-28 12:43:00",
            "endAt": "2024-02-28 13:43:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 03:43",
            "updated_at": "2024-02-28 03:43"
        },
        {
            "id": 15,
            "carId": 5,
            "carName": "K3",
            "startAt": "2024-02-28 17:06:00",
            "endAt": "2024-02-28 18:06:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 06:09",
            "updated_at": "2024-02-28 06:09"
        },
        {
            "id": 14,
            "carId": 5,
            "carName": "K3",
            "startAt": "2024-02-28 15:06:00",
            "endAt": "2024-02-28 16:06:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 06:06",
            "updated_at": "2024-02-28 06:06"
        },
        {
            "id": 17,
            "carId": 5,
            "carName": "K3",
            "startAt": "2024-02-28 13:11:00",
            "endAt": "2024-02-28 14:11:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 06:12",
            "updated_at": "2024-02-28 06:12"
        },
        {
            "id": 16,
            "carId": 5,
            "carName": "K3",
            "startAt": "2024-02-28 18:09:00",
            "endAt": "2024-02-28 19:09:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 06:10",
            "updated_at": "2024-02-28 06:10"
        },
        {
            "id": 10,
            "carId": 4,
            "carName": "K5",
            "startAt": "2024-02-27 18:26:00",
            "endAt": "2024-02-27 19:26:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 09:26",
            "updated_at": "2024-02-27 09:26"
        },
        {
            "id": 20,
            "carId": 3,
            "carName": "스타리아",
            "startAt": "2024-02-28 04:00:00",
            "endAt": "2024-02-28 05:00:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 08:19",
            "updated_at": "2024-02-28 08:19"
        },
        {
            "id": 6,
            "carId": 3,
            "carName": "스타리아",
            "startAt": "2024-02-27 14:53:00",
            "endAt": "2024-02-27 15:53:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 06:09",
            "updated_at": "2024-02-27 06:09"
        },
        {
            "id": 18,
            "carId": 3,
            "carName": "스타리아",
            "startAt": "2024-02-28 15:14:00",
            "endAt": "2024-02-28 16:14:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 06:14",
            "updated_at": "2024-02-28 06:14"
        },
        {
            "id": 5,
            "carId": 3,
            "carName": "스타리아",
            "startAt": "2024-02-27 04:00:00",
            "endAt": "2024-02-27 05:00:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 02:42",
            "updated_at": "2024-02-27 02:42"
        },
        {
            "id": 4,
            "carId": 3,
            "carName": "스타리아",
            "startAt": "2024-02-27 03:00:00",
            "endAt": "2024-02-27 04:00:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 02:42",
            "updated_at": "2024-02-27 02:42"
        },
        {
            "id": 3,
            "carId": 3,
            "carName": "스타리아",
            "startAt": "2024-02-27 02:00:00",
            "endAt": "2024-02-27 03:00:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 02:37",
            "updated_at": "2024-02-27 02:37"
        },
        {
            "id": 2,
            "carId": 3,
            "carName": "스타리아",
            "startAt": "2024-02-27 01:00:00",
            "endAt": "2024-02-27 02:00:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 02:36",
            "updated_at": "2024-02-27 02:36"
        },
        {
            "id": 9,
            "carId": 3,
            "carName": "스타리아",
            "startAt": "2024-02-27 16:17:00",
            "endAt": "2024-02-27 17:17:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 07:17",
            "updated_at": "2024-02-27 07:17"
        },
        {
            "id": 13,
            "carId": 2,
            "carName": "베뉴",
            "startAt": "2024-02-28 14:33:00",
            "endAt": "2024-02-28 15:34:00",
            "minutes": 61,
            "cost": 6100,
            "pay_yn": "N",
            "created_at": "2024-02-28 05:34",
            "updated_at": "2024-02-28 05:34"
        },
        {
            "id": 21,
            "carId": 2,
            "carName": "베뉴",
            "startAt": "2024-02-28 04:00:00",
            "endAt": "2024-02-28 05:00:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-28 08:19",
            "updated_at": "2024-02-28 08:19"
        },
        {
            "id": 8,
            "carId": 2,
            "carName": "베뉴",
            "startAt": "2024-02-27 15:27:00",
            "endAt": "2024-02-27 16:27:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 06:27",
            "updated_at": "2024-02-27 06:27"
        },
        {
            "id": 7,
            "carId": 1,
            "carName": "캐스퍼",
            "startAt": "2024-02-27 15:12:00",
            "endAt": "2024-02-27 16:12:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 06:12",
            "updated_at": "2024-02-27 06:12"
        },
        {
            "id": 1,
            "carId": 1,
            "carName": "캐스퍼",
            "startAt": "2024-02-27 11:34:00",
            "endAt": "2024-02-27 12:34:00",
            "minutes": 60,
            "cost": 6000,
            "pay_yn": "N",
            "created_at": "2024-02-27 02:35",
            "updated_at": "2024-02-27 02:35"
        }
    ]
}
```

# 예약상세정보

## Request

**URL** : `/api/show`

**Method** : `POST`

**Auth required** : NO

**데이터 제약**

```json
{
    "id": "[등록된 예약 id]"
}
```

**데이터 예시**

```json
{
    "id": "1"
}
```


## Response

**Code** : `200 OK`

**성공 응답**

```json
{
    "status": "success",
    "data": {
        "id": 1,
        "carId": 1,
        "carName": "캐스퍼",
        "startAt": "2024-02-27 11:34:00",
        "endAt": "2024-02-27 12:34:00",
        "minutes": 60,
        "cost": 6000,
        "pay_yn": "N",
        "created_at": "2024-02-27 02:35",
        "updated_at": "2024-02-27 02:35"
    }
}
```

**실패 응답 1**

**조건** : 예약 id가 존재하지 않을 경우

**Code** : `200 OK`

**내용** :

```json
{
    "status": "error",
    "message": "예약 정보를 찾을 수 없습니다."
}
```


### [<- 돌아가기](/README.md)