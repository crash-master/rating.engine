<?php

class ExternalCustomFieldController{
	public function update(){
		if(!is_admin()){
			return false;
		}
		$field_value = \Kernel\Request::post('field_value');
		$field_id = \Kernel\Request::post('field_id');
		if(!$field_id or empty($field_id)){
			return false;
		}
		return model('ExternalCustomField') -> set_field($field_id, $field_value);
	}
}