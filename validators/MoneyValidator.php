<?php
/**
 *  MoneyValidator class file.
 *  @version 0.2
 */
class MoneyValidator extends CNumberValidator
{
    const PREFIX  = '/^';
    const NUMBER  = '[0-9]+(\.[0-9]{0,2})?';
    const INTEGER = '\d+';
    const SPACE   = '\s*';
    const POSTFIX = '$/';

    public $allowPlusSign   = false;
    public $allowMinusSign  = false;
    public $allowSpaces     = true;

    public $message = 'Некорректное значение поля {attribute}';

    private function constructPatterns()
    {
        $sign = '';
        $space= ($this->allowSpaces)?self::SPACE:'';
        if ($this->allowPlusSign || $this->allowMinusSign)
        {
            $sign = '['.($this->allowPlusSign?'+':'').($this->allowMinusSign?'-':'').']?';
        }

        $this->integerPattern = self::PREFIX.$space.$sign.self::INTEGER.$space.self::POSTFIX;
        $this->numberPattern  = self::PREFIX.$space.$sign.self::NUMBER.$space.self::POSTFIX;
    }

    protected function validateAttribute($object,$attribute)
    {
        $this->constructPatterns();
        parent::validateAttribute($object,$attribute);
    }

    public function clientValidateAttribute($object,$attribute)
    {
        $this->constructPatterns();
        parent::validateAttribute($object,$attribute);
    }

}

?>