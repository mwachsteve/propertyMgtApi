## create endpoint
POST /api/properties
Request Body :
{
    "name": "test",
    "description": "test desc",
    "cost": 0,
    "avatar": null
}
## fetch All endpoint
GET /api/properties

## fetch single property endpoint
GET /api/properties/{id}

##update endpoint
PUT /api/properties/{id}

##delete endpoint 
DELETE /api/properties/{id}
