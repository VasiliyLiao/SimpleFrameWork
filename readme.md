# 簡易MVC-API-PHP框架

------

此框架為自己整理系統的練習作品，切勿將之應用在實務上，應用在實務上的框架上請選擇Laravel 5.1等框架。

### 所使用的package
>* Laravel - ORM("illuminate/database": "5.1.8")
>* Laravel - Pagination("illuminate/pagination": "5.1.8")
>* PHP單元測試("phpunit/phpunit" : "4.8.9")
>* 擬真假資料("fzaninotto/faker": "~1.4")

------

## 初始設定
### 1.安裝package
``` php composer install```
### 2.修改db設定
修改`config\db.example.php` 修正為 db.php
### 3.新增資料表
``` php database\setTables.php ```
### 4.新增假資料
``` php database\setSeeds.php ```
### 5.修改伺服器之根目錄
如果伺服器為`http://localhost/test`,則修改`config\app.php`
``` define(Server_Document,'/test') ```
### 6.執行測試程式
``` php tests\TestCase.php ```

------

## 檔案架構
此檔案架構為參考Laravel之架構，再進行修改。

### 1. app
**Controller**為放置Controller。
**Kernel**放置app一些核心套件。
**Model**放置package、enities、responsitory等檔案。
**Request**為放置請求的程式碼。
**Response**為放置回應的程式碼。

### 2. bootstrap
存放起始程式

### 3. config
**app.php**存放app一些初始設定，如根目錄、使用者檔案資料目錄、時區等設定。
**bootstrap.php**設定是否需要建立template或是log檔。
**db.php**設定database連線設定。

### 4.database
**seeds**  存放seeds檔案。
**tables** 存放資料表檔案。

### 5. helper
放置一些helper function等檔案

### 6. public
放置使用者可看到的檔案，如css、js及一些jpg檔

### 7. storage
放置需儲存的資料紀錄，如logs。

### 8. template
放置App的**view**。

### 9. tests
放置寫單元測試的檔案。


------

作者 [@vasiliy_liao][3]  2015 年 09月 28日

