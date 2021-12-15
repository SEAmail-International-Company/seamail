<?php
require_once("field_class.php");

class Form extends Field{
    private $method;
    private $id;
    private $fields;

    public function __construct(string $method = "POST", string $id = "form", array $fields = []){
        $this->method = $method;
        $this->id = $id;
        $this->fields = $fields;
    }

    public function getMethod() : string{
        return $this->method;
    }

    public function getId() : string{
        return $this->id;
    }

    public function getFields() : array{
        return $this->fields;
    }

    public function setMethod(string $new_method) : void{
        $this->method = $new_method;
    }

    public function setId(string $new_id) : void{
        $this->id = $new_id;
    }

    public function setFields(array $new_fields) : void{
        $this->fields = $new_fields;
    }


    public function createForm() : string{
        $form = "<form method='{$this->method}' id='{$this->id}'>";

        for($i = 0; $i < count($this->fields); $i++){
            $form .= $this->fields[$i];
        }

        return $form."</form>";
    }
}