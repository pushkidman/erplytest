# Erply Test - Simple Rest API

## Installation

## Dev notes

## Endpoints

#### Product Resources

- **<code>GET</code> /api/product**
- **<code>GET</code> /api/product/search/:query**
- **<code>PUT</code> /api/product/:id**
- **<code>POST</code> /api/product**
- **<code>DELETE</code> /api/product/:id**

    GET /api/product

## Description
Returns a list of products.

***

## Parameters
None

***

## Return format
An array with the following keys and values:

- **id** — unique ID.
- **name** — unique product name.
- **price** — unique product price.

***

## Errors
None

***

## Example
**Request**

    /api/products

**Return** __shortened for example purpose__
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
