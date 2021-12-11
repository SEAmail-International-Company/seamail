<?php
require_once("input_class.php");

class Field extends Input{
    private $class_field;
    private $is_grouped;
    private $has_addons;
    private $has_label;
    private $label_value;
    private $inputList = [];

    public function __construct(string $class_field = "", bool $is_grouped = false, bool $has_addons = false, bool $has_label = false, string $label_value = "", array $inputList = []){
        $this->class_field = $class_field;
        $this->is_grouped = $is_grouped;
        $this->has_addons = $has_addons;
        $this->has_label = $has_label;
        $this->label_value = $label_value;
        $this->inputList = $inputList;
    }

    public function getClassField() : string{
        return $this->class_field;
    }

    public function getIsGrouped() : bool{
        return $this->is_grouped;
    }

    public function getHasAddons() : bool{
        return $this->has_addons;
    }

    public function getHasLabel() : bool{
        return $this->has_label;
    }

    public function getLabelValue() : string{
        return $this->label_value;
    }

    public function getInputList() : array{
        return $this->inputList;
    }


    public function setClassField(string $new_class_field) : void{
        $this->class_field = $new_class_field;
    }

    public function setIsGrouped(bool $new_is_grouped) : void{
        $this->is_grouped = $new_is_grouped;
    }

    public function setHasAddons(bool $new_has_addons) : void{
        $this->has_addons = $new_has_addons;
    }

    public function setHasLabel(bool $new_has_label) : void{
        $this->has_label = $new_has_label;
    }

    public function setLabelValue(string $new_label_value) : void{
        $this->label_value = $new_label_value;
    }


    public function setInputList(array $new_inputList) : void{
        $this->inputList = $new_inputList;
    }

    public function createField() : string{

        $grouped = $this->is_grouped ? "is-grouped is-grouped-left mt-5" : "";
        $addons = $this->has_addons ? "has-addons" : "";

        $field = $this->has_label ? "<label class=\"label\">{$this->label_value}</label>" : "";

        $field .= "<div class=\"field\" {$this->class_field} {$grouped} {$addons}>";

        if(!empty($grouped)){
            for($i = 0; $i < count($this->inputList); $i++){
                $field .= $this->inputList[$i];
            }
        }else{
            $field .= $this->inputList[0];
        }

        return $field."</div>";
    }
}