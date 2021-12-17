<?php

class Input{
    private $balise;
    private $role;
    private $type;
    private $name;
    private $id;
    private $class;
    private $placeholder;
    private $value;
    private $href;
    private $autofocus;
    private $readonly;
    private $is_expanded;
    private $is_static;
    private $has_icons_left;
    private $icon_left;
    private $has_icons_right;
    private $icon_right;
    private $has_helpbox;
    private $helpbox_content;
    private $accepting_files;

    public function __construct(string $balise = "input", string $role = "", string $type = "text", string $name = "", string $id = "", 
    string $class = "", string $placeholder = "", string $value = "", string $href = "", bool $autofocus = false,
    bool $readonly = false, bool $is_expanded = false, bool $is_static = false, bool $has_icons_left = false, string $icon_left = "",
    bool $has_icons_right = false, string $icon_right = "", bool $has_helpbox = false, string $helpbox_content = "", string $accepting_files = "*"){

        $this->balise = $balise;
        $this->role = $role;
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->href = $href;
        $this->autofocus = $autofocus;
        $this->readonly = $readonly;
        $this->is_expanded = $is_expanded;
        $this->is_static = $is_static;
        $this->has_icons_left = $has_icons_left;
        $this->icon_left = $icon_left;
        $this->has_icons_right = $has_icons_right;
        $this->icon_right = $icon_right;
        $this->has_helpbox = $has_helpbox;
        $this->helpbox_content = $helpbox_content;
        $this->accepting_files = $accepting_files;

    }

    public function getBalise() : string{
        return $this->balise;
    }

    public function getRole() : string{
        return $this->role;
    }

    public function getType() : string{
        return $this->type;
    }

    public function getName() : string{
        return $this->name;
    }

    public function getId() : string{
        return $this->id;
    }

    public function getClass() : string{
        return $this->class;
    }

    public function getPlaceholder() : string{
        return $this->placeholder;
    }

    public function getValue() : string{
        return $this->value;
    }

    public function getHref() : string{
        return $this->href;
    }

    public function getAutofocus() : bool{
        return $this->autofocus;
    }

    public function getReadonly() : bool{
        return $this->readonly;
    }

    public function getIsExpanded() : bool{
        return $this->is_expanded;
    }

    public function getIsStatic() : bool{
        return $this->is_static;
    }

    public function getHasIconsRight() : bool{
        return $this->has_icons_right;
    }

    public function getIconRight() : bool{
        return $this->icon_right;
    }

    public function getHasIconsLeft() : bool{
        return $this->has_icons_left;
    }

    public function getIconLeft() : bool{
        return $this->icon_left;
    }

    public function getHasHelpbox() : bool{
        return $this->has_helpbox;
    }

    public function getHelpboxContent() : bool{
        return $this->helpbox_content;
    }

    public function getAcceptingFiles() : bool{
        return $this->accepting_files;
    }


    public function setBalise(string $new_balise) : void{
        $this->balise = $new_balise;
    }

    public function setRole(string $new_role) : void{
        $this->role = $new_role;
    }

    public function setType(string $new_type) : void{
        $this->type = $new_type;
    }

    public function setName(string $new_name) : void{
        $this->name = $new_name;
    }

    public function setId(string $new_id) : void{
        $this->id = $new_id;
    }

    public function setClass(string $new_class) : void{
        $this->class = $new_class;
    }

    public function setPlaceholder(string $new_placeholder) : void{
        $this->placeholder = $new_placeholder;
    }

    public function setValue(string $new_value) : void{
        $this->value = $new_value;
    }

    public function setHref(string $new_href) : void{
        $this->href = $new_href;
    }

    public function setAutofocus(bool $new_autofocus) : void{
        $this->autofocus = $new_autofocus;
    }

    public function setReadonly(bool $new_readonly) : void{
        $this->readonly = $new_readonly;
    }

    public function setIsExpanded(bool $new_is_expanded) : void{
        $this->is_expanded = $new_is_expanded;
    }

    public function setIsStatic(bool $new_is_static) : void{
        $this->is_static = $new_is_static;
    }

    public function setHasIconsRight(bool $new_has_icons_right) : void{
        $this->has_icons_right = $new_has_icons_right;
    }

    public function setIconRight(string $new_icon_right) : void{
        $this->icon_right = $new_icon_right;
    }

    public function setHasIconsLeft(bool $new_has_icons_left) : void{
        $this->has_icons_left = $new_has_icons_left;
    }

    public function setIconLeft(string $new_icon_left) : void{
        $this->icon_left = $new_icon_left;
    }

    public function setHasHelpbox(bool $new_has_helpbox) : void{
        $this->has_helpbox = $new_has_helpbox;
    }

    public function setHelpboxContent(string $new_helpbox_content) : void{
        $this->helpbox_content = $new_helpbox_content;
    }

    public function setAcceptingFiles(string $new_accepting_files) : void{
        $this->accepting_files = $new_accepting_files;
    }

    public function createInput() : string{

        $add_ons = "";
        $readonly = $this->readonly ? "readonly" : "";
        $value = $this->value != "" ? "value=\"{$this->value}\"" : "";

        $static = $this->is_static ? "is-static" : "";

        $icons = $this->has_icons_left ? "<span class='icon is-small is-left'> <i class='fas fa-{$this->icon_left}'></i> </span>" : "";
        $icons .= $this->has_icons_right ? "<span class='icon is-small is-right'> <i class='fas fa-{$this->icon_right}'></i> </span>" : "";

        $helpbox = $this->has_helpbox ? "<p class='help' id='statebox_{$this->id}'></p>" : "";
        $helpbox .= $this->helpbox_content != "" ? "<p class='help' id='statebox_{$this->id}'> {$this->helpbox_content} </p>" : "";

        $add_ons .= $this->has_icons_left ? "has-icons-left" : "";
        $add_ons .= $this->has_icons_right ? "has-icons-right" : "";
        $add_ons .= $this->is_expanded ? " is-expanded" : "";

        $input = "<div class='control {$add_ons}'>";

        switch ($this->balise) {
            case "a":
                $input .= "<a class='{$this->role} {$this->class} {$static}' id='{$this->id}' href=\"{$this->href}\">
                            {$this->value}
                          </a>";
                break;

            case "button":
                $input .= "<button class='{$this->role} {$this->class} {$static}' id='{$this->id}' role='{$this->role}'>
                            {$this->value} 
                            {$icons}
                          </button>";
                break;
            
            default:

                if($this->type != "file"){
                $input .= "<input class='{$this->class} {$static}' type='{$this->type}' id='{$this->id}' name='{$this->name}' {$value} placeholder=\"{$this->placeholder}\" autofocus='{$this->autofocus}' {$readonly}>
                           {$icons} 
                           {$helpbox}";
                }else{
                $input .= "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"500000\" />
                            <div id=\"{$this->id}\" class=\"file has-name\">
                            <label class=\"file-label\">
                                <input class=\"file-input\" type=\"file\" name=\"{$this->name}\" id='{$this->id}' accept=\"{$this->accepting_files}\">
                                <span class=\"file-cta\">
                                <span class=\"file-icon\">
                                    <i class=\"fas fa-upload\"></i>
                                </span>
                                <span class=\"file-label\">
                                    Choisissez un fichier
                                </span>
                                </span>
                                <p class=\"file-name help\" id='statebox_{$this->name}'>
                                 Aucun fichier uploadé
                                </p>
                            </label>
                           </div>";
                }
                break;
        }

        return $input."</div>";
    }
}