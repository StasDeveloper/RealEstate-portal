<?php
/**
 * HCFormInputElement class file.
 *
 */
class HCFormInputElement extends CFormInputElement
{
	/**
	 * @var array the options used when rendering the error part. This property will be passed
	 * to the {@link CActiveForm::error} method call as its $htmlOptions parameter.
	 * @see CActiveForm::error
	 * @since 1.1.1
	 */
	public $errorOptions=array('class'=>'help-inline');

	/**
	 * Renders the label for this input.
	 * The default implementation returns the result of {@link CHtml activeLabelEx}.
	 * @return string the rendering result
	 */
	public function renderLabel()
	{
		$options = array(
			'label'=>$this->getLabel(),
			'required'=>$this->getRequired()
		);

		if(!empty($this->attributes['id']))
                {
                    $options['for'] = $this->attributes['id'];
                }

                $options['class'] = 'label';

		return CHtml::activeLabel($this->getParent()->getModel(), $this->name, $options);
	}

	/**
	 * Renders the input field.
	 * The default implementation returns the result of the appropriate CHtml method or the widget.
	 * @return string the rendering result
	 */
	public function renderInput()
	{
		if(isset(self::$coreTypes[$this->type]))
		{
			$method=self::$coreTypes[$this->type];
			if(strpos($method,'List')!==false)
				return '<label class="input">' . CHtml::$method($this->getParent()->getModel(), $this->name, $this->items, $this->attributes) . '</label>';
			else
				return '<label class="input">' . CHtml::$method($this->getParent()->getModel(), $this->name, $this->attributes) . '</label>';
		}
		else
		{
			$attributes=$this->attributes;
			$attributes['model']=$this->getParent()->getModel();
			$attributes['attribute']=$this->name;
			ob_start();
			$this->getParent()->getOwner()->widget($this->type, $attributes);
			return '<label class="input">' . ob_get_clean() . '</label>';
		}
	}

	/**
	 * Renders the error display of this input.
	 * The default implementation returns the result of {@link CHtml::error}
	 * @return string the rendering result
	 */
	public function renderError()
	{
		$parent=$this->getParent();
		return $parent->getActiveFormWidget()->error($parent->getModel(), $this->name, $this->errorOptions, $this->enableAjaxValidation, $this->enableClientValidation);
	}

	/**
	 * Renders the hint text for this input.
	 * The default implementation returns the {@link hint} property enclosed in a paragraph HTML tag.
	 * @return string the rendering result.
	 */
	public function renderHint()
	{
		return $this->hint===null ? '' : '<div class="hint">'.$this->hint.'</div>';
	}

}
