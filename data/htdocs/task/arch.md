## Routing
Main Page
GET /landing
Login

Logout

My Page
Get /mypage/(user_id)

Edit Profile
GET /profile/(user_id)/edit
POST /profile/(user_id)

Edit Goals
Get /goal/(user_id)/new
Get /goal/(user_id)/(goal_id)/edit
Get /gpal/(user_id)/(goal_id)/delete
POST /goal/(user_id)

Bookshelf
Get /books/(user_id)
Get /books/(user_id)/(book_id)
Get /books/(user_id)/new
POST /books/(user_id)/(book_id)/
GET /books/(user_id)/(book_id)/edit
GET /books/(user_id)/(book_id)/delete

History
Get /history/(user_id)

## DB
Users
id
username
password
role
createddate
modified date

mysql> CREATE TABLE profiles (
    -> id INT AUTO_INCREMENT PRIMARY KEY,
    -> user_id INT UNSIGNED,
    -> profession VARCHAR(50),
    -> message VARCHAR(200),
    -> created DATETIME,
    -> modified DATETIME,
    -> FOREIGN KEY user_key (user_id) REFERENCES users(id)
    -> ) CHARSET=utf8mb4;


mysql> CREATE TABLE goals ( 
    -> id INT AUTO_INCREMENT PRIMARY KEY,
    -> user_id INT UNSIGNED,
    -> goal VARCHAR(100),
    -> created DATETIME,
    -> modified DATETIME,
    -> FOREIGN KEY user_key (user_id) REFERENCES users(id)
    -> ) CHARSET=utf8mb4;

mysql> CREATE TABLE books (
    -> id INT AUTO_INCREMENT PRIMARY KEY,
    -> user_id INT UNSIGNED,
    -> isbn INT(13),
    -> FOREIGN KEY user_key (user_id) REFERENCES users(id)
    -> );

mysql> CREATE TABLE results (
    -> id INT AUTO_INCREMENT PRIMARY KEY,
    -> user_id INT UNSIGNED,
    -> book_id INT,
    -> comments VARCHAR(100),
    -> created DATETIME,
    -> finished DATETIME,
    -> FOREIGN KEY user_key (user_id) REFERENCES users(id),
    -> FOREIGN KEY book_key (book_id) REFERENCES books(id)
    -> ) CHARSET=utf8mb4;
