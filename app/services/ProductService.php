<?php

namespace App\Services;

use App\Models\Product;

/**
 * Business-logic for product CRUD
 *
 * Class ProductService
 */
class ProductService extends ServiceBase {

    /** Unable to create product */
    const ERROR_UNABLE_CREATE_PRODUCT = 11001;

    /** Product not found */
    const ERROR_PRODUCT_NOT_FOUND = 11002;

    /** No such product */
    const ERROR_INCORRECT_PRODUCT = 11003;

    /** Unable to update product */
    const ERROR_UNABLE_UPDATE_PRODUCT = 11004;

    /** Unable to delete product */
    const ERROR_UNABLE_DELETE_PRODUCT = 1105;

    /**
     * Creating a new product
     *
     * @param array $data
     * @return type
     * @throws ServiceException
     */
    public function create(array $data) {
        try {
            $product = new Product();
            $create = $product->setName($data['name'])->setPrice($data['price'])->create();
            
            if (!$create) {
                throw new ServiceException(
                    sprintf('Unable to create product: %s', $product->getMessages()[0]->__toString()), 
                    self::ERROR_UNABLE_CREATE_PRODUCT
               );
            }
            
            $data['id'] = $product->getId();
            return $data;
            
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Updating an existing product
     *
     * @param array $data
     */
    public function update(array $data) {
        try {
            $product = Product::findFirst($data['id']);
            
            if (!$product) {
                throw new ServiceException('Product not found', self::ERROR_PRODUCT_NOT_FOUND);
            }
            
            $update = $product->setName($data['name'])->setPrice($data['price'])->update();

            if (!$update) {
                throw new ServiceException(
                    sprintf('Unable to update product: %s', $product->getMessages()[0]->__toString()), 
                    self::ERROR_UNABLE_UPDATE_PRODUCT
                );
            }
            
            return $data;
            
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete an existing product
     *
     * @param int $id
     */
    public function delete($id) {
        try {
            $product = Product::findFirst($id);
            
            if (!$product) {
                throw new ServiceException('Product not found', self::ERROR_PRODUCT_NOT_FOUND);
            }

            $delete = $product->delete();

            if (!$delete) {
                throw new ServiceException(
                    sprintf('Unable to delete product: %s', $product->getMessages()[0]->__toString()), 
                    self::ERROR_UNABLE_DELETE_PRODUCT
                );
            }
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns product list
     *
     * @return array
     */
    public function get() {
        try {
            $products = Product::find();

            if (!$products) {
                return [];
            }

            return $products->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    
    /**
     * Search product list by name
     *
     * @return array
     */
    public function search($q) {
        try {
            $products = Product::search($q);
            if (!$products) {
                return [];
            }

            return $products->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
