<?php

namespace App\Models;

use Phalcon\Mvc\Model;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
/**
 * Product model
 */
class Product extends Model {

    /**
     * Product id
     * @var type 
     */
    protected $id;
    
    /**
     * Product name
     * 
     * @var string
     */
    protected $name;
    
    /**
     * Product price
     * 
     * @var decimal
     */
    protected $price;

    /**
     * Initialize the model
     */
    public function initialize() {
        $this->setSource('product');
    }

    /**
     * Get unique ID
     * @return type
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get name
     * 
     * @return type
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Get price
     * 
     * @return type
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set name
     * 
     * @param type $input
     * @return $this
     */
    public function setName($input) {
        $this->name = $input;
        return $this;
    }
    
    /**
     * Set price
     * 
     * @param type $input
     * @return $this
     */
    public function setPrice($input) {
        $this->price = $input;
        return $this;
    }
    
    /**
     * Validate the entity
     * 
     * @return type
     */
    public function validation() {
        $validator = new Validation();
        $params = [
            'model' => new self(),
            'message' => 'The product with this name already exists'
        ];
        if ($this->id) {
            $params['except'] = ['id' => [$this->id]];
        }
        $uniqueness = new Uniqueness($params);
        $validator->add('name', $uniqueness);
        return $this->validate($validator);
    }
    
    /**
     * Search product
     * 
     * @param type $q
     * @return type
     */
    public static function search($q) {
        $di = \Phalcon\DI::getDefault();
        $builder = $di['modelsManager']->createBuilder()->from(['App\Models\Product']);
        $bind = [];
        $condition = '';
        $condition .= 'MATCH(name) AGAINST(:q:)';
        $bind['q'] = $q;
        $builder->where($condition, $bind);
        $resultSet = $builder->getQuery()->execute();
        return $resultSet;
    }

}
