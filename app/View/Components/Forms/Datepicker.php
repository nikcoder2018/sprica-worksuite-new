<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Datepicker extends Component
{
    public $fieldLabel;
    public $fieldRequired;
    public $fieldPlaceholder;
    public $fieldValue;
    public $fieldName;
    public $fieldId;
    public $fieldHelp;
    public $fieldReadOnly;
    public $custom;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldLabel, $fieldRequired = false, $fieldPlaceholder, $fieldValue = null, $fieldName, $fieldId, $fieldHelp = null, $fieldReadOnly = false, $custom = false)
    {
        $this->fieldLabel = $fieldLabel;
        $this->fieldRequired = $fieldRequired;
        $this->fieldPlaceholder = $fieldPlaceholder;
        $this->fieldValue = $fieldValue;
        $this->fieldName = $fieldName;
        $this->fieldId = $fieldId;
        $this->fieldHelp = $fieldHelp;
        $this->fieldReadOnly = $fieldReadOnly;
        $this->custom = $custom; // If used in custom fields
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.datepicker');
    }

}
