# Erply Test - Simple Rest API

## Installation

## Dev notes

## Endpoints

#### Product Resources

| Method | URL | Action |
| ------ | ------ | ------ |
| GET | /api/product | Retrieves all product list |
| GET | /api/product/search/:query | Searches for products by ‘:query’ |
| POST | /api/product | Adds a new product |
| PUT | /api/product/:id | Updates a product based on unique ID |
| DELETE | /api/product/:id | Deletes a product based on unique ID |

#### GET /api/product

##### Description
Returns a list of products.

***

##### Parameters
None

***

##### Return format
An array with the following keys and values:

- **id** — unique ID.
- **name** — unique product name.
- **price** — unique product price.

***

##### Errors
- **500 Internal Server Error** — Internal server error.

***

##### Example
***Request***

    api/product

***Return***
``` json
{
    [
        {
            "id": "1",
            "name": "Batman Arkham City",
            "price": "39.99"
        },
        {
            "id": "2",
            "name": "Dead By Daylight",
            "price": "29.99"
        },
        {
            "id": "16",
            "name": "Cuphead",
            "price": "19.99"
        }
    ]
}
```


#### GET api/product/search/:query

##### Description
Searches for products by name.

***

##### Parameters
- **query** — A keyword to search for (required, >= 3 characters).

***

##### Return format
An array with the following keys and values:

- **id** — unique ID.
- **name** — unique product name.
- **price** — unique product price.

***

##### Errors
- **400 Bad Request** — Missing or short query string.
- **500 Internal Server Error** — Internal server error.

***

##### Example
***Request***

    /api/product/search/batman

***Return***
``` json
{
    [
        {
            "id": "1",
            "name": "Batman Arkham City",
            "price": "39.99"
        }
    ]
}
```



#### POST api/product

##### Description
Adds a new product.

***

##### Parameters
Essential information:
- **name** — Product title.
- **price** — Product price.

***

##### Return format
An array with the following keys and values:

- **status** - request result status.
- **data** - inserted data.
-- **name** — unique product name.
-- **price** — unique product price.
-- **id** — unique ID.

***

##### Errors
- **400 Bad Request** — Invalid input parameters.
- **422 Unprocessable Entity** — Product name already exists.
- **500 Internal Server Error** — Internal server error.

***

##### Example
***Request***

    POST api/product?name=Bioshock&price=8.99

***Return***
``` json
{
    "status": "OK",
    "data": {
        "name": "Bioshock",
        "price": "8.99",
        "id": "17"
    }
}
```


#### PUT api/product/:id

##### Description
Updates an existing product.

***

##### Parameters
Essential information:
- **name** — Product title.
- **price** — Product price.

***

##### Return format
An array with the following keys and values:

- **status** - request result status.
- **data** - inserted data.
-- **name** — unique product name.
-- **price** — unique product price.
-- **id** — unique ID.

***

##### Errors
- **400 Bad Request** — Invalid input parameters.
- **422 Unprocessable Entity** — Product name already exists.
- **500 Internal Server Error** — Internal server error.

***

##### Example
***Request***

    PUT api/product/17?name=Bioshock%20Remastered&price=9.99

***Return***
``` json
{
    "status": "OK",
    "data": {
        "name": "Bioshock Remastered",
        "price": "9.99",
        "id": "17"
    }
}
```