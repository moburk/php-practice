## Defined Routes

| Method | URI             | Request                                         |
|--------|-----------------|-------------------------------------------------|
| GET    | /api/users      | None                                            |
| GET    | /api/users/{id} | None                                            |
| POST   | /api/users      | {  "first_name":"Hello",  "last_name":"World" } |
| DELETE | /api/users/{id} | None                                            |

## Response Objects

All API routes will send a JSON response object in the following format:

{  
&nbsp; "data": ,  
&nbsp; "description":  
}
