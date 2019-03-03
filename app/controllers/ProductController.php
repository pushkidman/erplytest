<?php

namespace App\Controllers;

use App\Lib\Exceptions\Http400Exception;
use App\Lib\Exceptions\Http422Exception;
use App\Lib\Exceptions\Http500Exception;
use App\Services\ProductService;
use App\Services\ServiceException;
use App\Models\Validation\Product as ProductValidation;

/**
 * CRUD operations with products
 */
class ProductController extends ControllerBase {
    
    /**
     * Adding a product
     */
    public function addAction() {

        $data = $this->request->getPost();
        
        // validate parameters
        $validation = new ProductValidation();
        $errors = $validation->validate($data);
        
        if ($errors && $errors->count()) {
            $exception = new Http400Exception('Input parameters validation error', self::ERROR_INVALID_REQUEST);
            throw $exception->addErrorDetails($errors);
        }
            
	// passing to business logic and preparing the response
        try {
            $response = $this->productService->create($data);
            return ['status' => 'OK', 'data' => $response];
        } catch (ServiceException $e) {
            switch ($e->getCode()) {
                case ProductService::ERROR_UNABLE_CREATE_PRODUCT:
                    throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
                default:
                    throw new Http500Exception('Internal Server Error', $e->getCode(), $e);
            }
        }
    }

    /**
     * Returns product list
     *
     * @return array
     */
    public function getAction() {
        try {
            $products = $this->productService->get();
            return $products;
        } catch (ServiceException $e) {
            throw new Http500Exception('Internal Server Error', $e->getCode(), $e);
        }
    }

    /**
     * Updating product
     *
     * @param string $productId
     */
    public function updateAction($productId) {
        $data = $this->request->getPut();
        
        // validate parameters
        $validation = new ProductValidation();
        $errors = $validation->validate($data);
        
        if ($errors && $errors->count()) {
            $exception = new Http400Exception('Input parameters validation error', self::ERROR_INVALID_REQUEST);
            throw $exception->addErrorDetails($errors);
        }
        
        $data['id'] = (int)$productId;
        
	// passing to business logic and preparing the response
        try {
            $response = $this->productService->update($data);
            return ['status' => 'OK', 'data' => $response];
        } catch (ServiceException $e) {
            switch ($e->getCode()) {
                case ProductService::ERROR_PRODUCT_NOT_FOUND:
                    throw new Http404Exception($e->getMessage(), $e->getCode(), $e);
                case ProductService::ERROR_UNABLE_UPDATE_PRODUCT:
                    throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
                default:
                    throw new Http500Exception('Internal Server Error', $e->getCode(), $e);
            }
        }
    }

    /**
     * Delete a product
     *
     * @param string $productId
     */
    public function deleteAction($productId) {
        
        if (!ctype_digit($productId) || $productId < 0) {
            throw new Http400Exception('Invalid ID', self::ERROR_INVALID_REQUEST);
        }

        try {
            $this->productService->delete((int) $productId);
            return ['status' => 'OK'];
        } catch (ServiceException $e) {
            switch ($e->getCode()) {
                case ProductService::ERROR_PRODUCT_NOT_FOUND:
                    throw new Http404Exception($e->getMessage(), $e->getCode(), $e);
                case ProductService::ERROR_UNABLE_DELETE_PRODUCT:
                    throw new Http422Exception($e->getMessage(), $e->getCode(), $e);
                default:
                    throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
            }
        }
    }

    /**
     * Search product by query string
     * 
     * @param string $q
     */
    public function searchAction($q) {
        try {
            
            if (empty($q) || strlen($q) < 3) {
                throw new Http400Exception('Query string must be aat least 3 characters', self::ERROR_INVALID_REQUEST);
            }
            
            $products = $this->productService->search($q);
            return $products;
        } catch (ServiceException $e) {
            throw new Http500Exception('Internal Server Error', $e->getCode(), $e);
        }
    }

}
