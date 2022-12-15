<?php
namespace App\Views\Helpers;

 class  htmlHelper{

    public static function getSelect($dados, $name, $label, $selected=null,$titulo){
       
        $select ="  <div class='form-row'>
        <div class='col-md-6 mb-3'>
         <label>{$titulo}</label>";
        $select .="<select  class='custom-select' id='inputGroupSelect01' name={$name} aria-label='Selecione o Cliente'>";
        if(!$selected)
            $select .= "<option  value='{$selected}'>{$label}</option>";

        foreach ($dados as $chave => $value) {
            if($selected == $chave){
                $select .= "<option selected value='{$chave}'>{$value}</option>";
            }else
                $select .= "  <option value='{$chave}'>{$value}</option>";
        }
        $select .= '</select></div>';
        return $select;
    }
 
    
}