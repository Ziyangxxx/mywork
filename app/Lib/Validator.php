<?php

namespace App\Lib;

class Validator
{
    private $post = [];
    private $error = [];

    public function __construct($array)
    {
        $this->post = $array;
    }

    /* VALIDATION METHODS
    ----------------------------------------------------------*/

    /**
     * Validate required elements in an array
     * @param array $required array of required keys
     */
    public function required($required)
    {
        foreach($required as $key) {
            if (empty($this->post[$key])) {
                $this->errors[$key][] = $this->label($key) . " is a required field.";
            }
        }
    }

    /* UTILITY METHODS
    ----------------------------------------------------------*/

    /**
     * Validate postal code
     * @param string $field
     * @return void
     */
    function postalcode($field)
    {
        // This regex is from : https://regexlib.com/
        $pattern = '([ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ])\ ?([0-9][ABCEGHJKLMNPRSTVWXYZ][0-9])';
        $pcode = $this->post[$field];
        if($pcode != $pattren){
            $this->$errors = $this->label($field) . " Invalidate postal code format.";
        }
    }

    /**
     * Validate two values match
     * @param string $field1
     * @param string $field2
     * @return void 
     */
    function matches($field1, $field2)
    {
        $passwd = $this->post[$field1];
        $passwdcon = $this->post[$field2];
        if ($passwd != $passwdcon) {
            $this->errors[$field2][] = $this->label($field1) . " does not match.";
        }
    }

    /**
     * Validate a value is numeric and within a range
     * @param  string $field 
     * @return void 
     */
    function num($field)
    {
        $age = $this->post[$field];

        if(!empty($age)) {
            if (!is_numeric($age)) {
                $this->errors[$field][] = $this->label($field) . " must be a number.";
            } elseif ($age < 10) {
                $this->errors[$field][] = $this->label($field) . " must have a minimum value of 10.";
            } elseif ($age > 120) {
                $this->errors[$field][] = $this->label($field) . " must have a maximum value of 120.";
            }
        }
    }

    /**
     * Email validator
     * @param  string $field 
     * @return void 
     */
    public function email($field)
    {
        $email = $this->post[$field];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = $this->label($field) . " must be a valid email address.";
        }
    }

    // first_name ==> First Name
    // ucwords( str_replace('_',' ', $variable_name) )

    /**
     * [label description]
     * @param [type] $str
     * @return [type] 
     */
    private function label($str)
    {
        return ucwords( str_replace('_',' ', $str) );
    }

    /**
     * Get post array
     * 
     */
    public function post()
    {
        return $this->post;
    }

    /**
     * 
     */
    public function errors()
    {
        return $this->errors;
    }
}