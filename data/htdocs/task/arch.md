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

Profiles
id
user_id
profession
message

Goals
id
user_id
goal

Books
id
asbn

Results
id
user_id
book_id
startdate
finishdate

