<?php
//selected country would be retrieved from a database or as post data
function  country_dropdown($name, $id, $class, $selected_country,$top_countries=array(), $all, $selection=NULL, $show_all=TRUE ){
    // You may want to pull this from an array within the helper
    $countries = config_item('country_list');

    $html = "<select name='{$name}' id='{$id}' class='{$class}'>";
    $selected = NULL;
    if(in_array($selection,$top_countries)){
        $top_selection = $selection;
        $all_selection = NULL;
    }else{
        $top_selection = NULL;
        $all_selection = $selection;
    }
    if(!empty($selected_country)&&$selected_country!='all'&&$selected_country!='select'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_country === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='{$selected_country}'{$selected}>{$countries[$selected_country]}</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }else if($selected_country=='all'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_country === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }else if($selected_country=='select'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_country === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }
    if(!empty($all)&&$all=='all'&&$selected_country!='all'){
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
    }
    if(!empty($all)&&$all=='select'&&$selected_country!='select'){
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
    }

    if(!empty($top_countries)){
        $html .= "<optgroup label='Top Countries'>";
        foreach($top_countries as $value){
            if(array_key_exists($value, $countries)){
                if($value === $top_selection){
                    $selected = "SELECTED";
                }
            $html .= "<option value='{$value}'{$selected}>{$countries[$value]}</option>";
            $selected = NULL;
            }
        }
        $html .= "</optgroup>";
    }

    if($show_all){
        $html .= "<optgroup label='All Countries'>";
        foreach($countries as $key => $country){
            if($key === $all_selection){
                $selected = "SELECTED";
            }
            $html .= "<option value='{$key}'{$selected}>{$country}</option>";
            $selected = NULL;
        }
        $html .= "</optgroup>";
    }

    $html .= "</select>";
    return $html;
    }
	
	function  states_dropdown($name, $id, $class, $selected_state,$top_states=array(), $all, $selection=NULL, $show_all=TRUE ){
    // You may want to pull this from an array within the helper
    $states = config_item('province_list');

    $html = "<select name='{$name}' id='{$id}' class='{$class}'>";
    $selected = NULL;
    if(in_array($selection,$top_states)){
        $top_selection = $selection;
        $all_selection = NULL;
    }else{
        $top_selection = NULL;
        $all_selection = $selection;
    }
    if(!empty($selected_state)&&$selected_state!='all'&&$selected_state!='select'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_state === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='{$selected_state}'{$selected}>{$states[$selected_state]}</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }else if($selected_state=='all'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_state === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }else if($selected_state=='select'){
        $html .= "<optgroup label='Selected Country'>";
        if($selected_state === $top_selection){
            $selected = "SELECTED";
        }
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }
    if(!empty($all)&&$all=='all'&&$selected_state!='all'){
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
    }
    if(!empty($all)&&$all=='select'&&$selected_state!='select'){
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
    }

    if(!empty($top_states)){
        $html .= "<optgroup label='Top states'>";
        foreach($top_states as $value){
            if(array_key_exists($value, $states)){
                if($value === $top_selection){
                    $selected = "SELECTED";
                }
            $html .= "<option value='{$value}'{$selected}>{$states[$value]}</option>";
            $selected = NULL;
            }
        }
        $html .= "</optgroup>";
    }

    if($show_all){
        $html .= "<optgroup label='All states'>";
        foreach($states as $key => $country){
            if($key === $all_selection){
                $selected = "SELECTED";
            }
            $html .= "<option value='{$key}'{$selected}>{$country}</option>";
            $selected = NULL;
        }
        $html .= "</optgroup>";
    }

    $html .= "</select>";
    return $html;
	}