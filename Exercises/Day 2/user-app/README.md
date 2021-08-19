# User CRUD App

This application demonstrates basic CRUD functionality using PHP and Laravel.

## Defined Routes

| Method | URI             | Description       | Request                                         |
|--------|-----------------|-------------------|-------------------------------------------------|
| GET    | /api/users      | Get all users     | None                                            |
| GET    | /api/users/{id} | Get user by id    | None                                            |
| POST   | /api/users      | Create new user   | {  "first_name":"Hello",  "last_name":"World" } |
| DELETE | /api/users/{id} | Delete user by ID | None                                            |

## Response Objects

All API routes will send a JSON response object in the following format:

{  
&nbsp; "data": ,  
&nbsp; "description":  
}
