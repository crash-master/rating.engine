<?php

class ExternalCustomField{
	public function get_field($field_id){
		return model('Option') -> get_option($field_id);
	}

	public function set_field($field_id, $field_value){
		return model('Option') -> set_option($field_id, $field_value, 'external_custom_field');
	}
}