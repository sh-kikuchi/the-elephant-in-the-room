# the Elephant in the room
'the Elephant in the room' is my private PHP flame work.
<br> since 2023.7.26

## 1. directory
```
|
├─assets
│  ├─css
│  ├─img
│  ├─js
│  └─pdf
├─config
├─database
│  ├─csv
│  │  ├─downloads
│  │  └─uploads
│  └─migrations
├─interfaces
├─logics
│  ├─artist
│  ├─concert
│  └─user_auth
├─logs
├─models
├─pages
│  ├─artist
│  ├─concert
│  ├─errors
│  ├─layouts
│  └─user_auth
├─classes
├─storage
│  └─doc
├─tests
├─util
│  └─trait
└─vendor
    ├─bin
    ├─composer
    ├─guzzlehttp
    ├─myclabs
    ├─nikic
    ├─phar-io
    ├─phpunit
    ├─psr
    ├─ralouphie
    ├─sebastian
    ├─symfony
    ├─tecnickcom
    └─theseer
```

<br>


## 2. Set up

- Let's start by cloning the project.
    ```
    git clone https://github.com/sh-kikuchi/the-elephant-in-the-room.git
    ```

<br>

- After that, let's run `composer install`.
    ```
    composer install
    ```

<br>

## 3. database
1. Set up the DB in 'db_connect.php' in the database directory 
2. There are PHP files for creating sample tables in database>migrations, which you can run with the command.You can run the sample application by executing the commands in all the table files provided.

    ```
    C:\xampp\htdocs\the-elephant-in-the-room/database>php 202306031133_create_artists.php
    ```
<br>

3. There is a db_csv_input.php directly under the database directory. This reads the CSV files provided in database>uploads and inserts the data into the relevant table. By default, the 'Artists' table is targeted,
    ```
    C:\xampp\htdocs\the-elephant-in-the-room/database>php db_csv_input.php
    ```
<br>
※The file db_csv_output.php allows data from specified tables to be stored in CSV. Make use of this if necessary.

<br>　

## 4. Settings

### ■ including_path
- Set include_path to the path to the project directory in the ini file.
For example, if you are using XAMPP, set up the following
```php
;include_path=C:\xampp\php\PEAR
include_path=C:\xampp\htdocs\the-elephant-in-the-room
```
 
### ■ Test for sending google mail on XAMPP (windows)

#### 【php.ini】
> Specifies the email address to be used for "From:" in emails sent directly via SMTP 
- sendmail_path ="xxxxxxxx@gmail.com"

<br>

>Specify sendmail exe file path
- sendmail_path = "C:\xampp\sendmail\sendmail.exe -t"

#### 【sendmail.ini】
- smtp_server=smtp.gmail.com
- smtp_port=587
- smtp_ssl=auto
- auth_username=xxxxxxxx@gmail.com
- auth_password=xxxxxxxxxxxxxxxxx

<br>

※As for the auth_password, you need to issue an 'App Password' from Google.
<br>[For more infomation](https://myaccount.google.com/signinoptions/two-step-verification)