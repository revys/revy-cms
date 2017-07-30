<div class="form__group">
	<label class="form__group__label" for="form-input-{{ $field['field'] }}">{{ $field['label'] }}</label>
	{{ Form::text(
		$field['field'], 
		(! is_string($field['value']) ? $field['value']($object) : $object->{$field['value']}), 
		[
			'id' => 'form-input-' . $field['field'], 
			'class' => 'form__group__input' . 
				(isset($field['size']) ? ' form__group__input--' . $field['size'] : '')
		]
	) }}
</div>