# Todo  App

This application demonstrates basic CRUD functionality using PHP and Laravel to create a Todo Application.

## Defined Routes

| Method | URI             | Request                                                                                                       |
|--------|-----------------|---------------------------------------------------------------------------------------------------------------|
| GET    | /api/tasks      | None                                                                                                          |
| GET    | /api/tasks/{id} | None                                                                                                          |
| POST   | /api/tasks      | {  "name":"task_1",  "description":"describe",  "status":"Pending", <br> "priority":1, <br> "deadline":"2021-08-20" } |
| DELETE | /api/tasks/{id} | None                                                                                                          |

<br>
The GET requests can be accompanied by query parameters: limit, offset and status.

## Response Objects

All API routes will send a JSON response object in the following format:

{  
&nbsp; "data": ,  
&nbsp; "description":  
}

The error response will be in the following format:

{  
&nbsp; "error_code": ,  
&nbsp; "description":  
}
