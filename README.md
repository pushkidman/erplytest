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
None

***

##### Example
***Request***

    /api/product

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


#### GET /api/product/search/:query

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
