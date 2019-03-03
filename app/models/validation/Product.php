<?php

namespace App\Models\Validation;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\StringLength;

class Product extends Validation {

    public function initialize() {
        
        $this->add(
            ['name', 'price'], new PresenceOf([
                'message' => [
                    'name' => 'Name is required', 
                    'price' => 'Price is required'
                ],
            ])
        );
        
        $this->add(
            'name', new Regex([
                'pattern' => '/^[a-z0-9 ]+$/i',
                'message' => 'Product name can only be alphanumeric',
            ])
        );
        
        $this->add(
            'name', new StringLength([
                'max'            => 100,
                'min'            => 2,
                'messageMaximum' => 'We don\'t like really long names',
                'messageMinimum' => 'We want more informative name',
            ])
        );
        
        
        $this->add(
            'price', new Numericality([
                'message' => 'Price is not numeric',
            ])
        );
    }

}
