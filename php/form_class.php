<?php
require_once("field_class.php");

class Form extends Field{
    private $method;
    private $id;
    private $fields;
    private $has_input_file;

    public function __construct(string $method = "POST", string $id = "form", array $fields = [], bool $has_input_file = false){
        $this->method = $method;
        $this->id = $id;
        $this->fields = $fields;
        $this->has_input_file = $has_input_file;
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

    public function getHasInputFile() : bool{
        return $this->has_input_file;
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

    public function setHasInputFile(bool $new_status) : void{
        $this->has_input_file = $new_status;
    }


    public function createForm() : string{
        $add_on = $this->has_input_file ? "enctype=\"multipart/form-data\"" : "";
        $form = "<form autocomplete=\"off\" method='{$this->method}' id='{$this->id}' {$add_on}>";

        for($i = 0; $i < count($this->fields); $i++){
            $form .= $this->fields[$i];
        }

        return $form."</form>";
    }
}