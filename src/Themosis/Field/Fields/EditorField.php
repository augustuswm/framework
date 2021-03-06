<?php
namespace Themosis\Field\Fields;

use Themosis\View\ViewFactory;

class EditorField extends FieldBuilder implements IField
{
    /**
     * Build an EditorField instance.
     *
     * @param array $properties
     * @param ViewFactory $view
     */
    public function __construct(array $properties, ViewFactory $view)
    {
        $this->properties = $properties;
        $this->view = $view;
        $this->fieldType();
        $this->setId();
        $this->setTitle();
    }

    /**
     * Set a default ID attribute if not defined.
     *
     * @return void
     */
    protected function setId()
    {
        $this['id'] = isset($this['id']) ? $this['id'] : $this['name'].'-id';
    }

    /**
     * Set a default label title, display text if not defined.
     *
     * @return void
     */
    protected function setTitle()
    {
        $this['title'] = isset($this['title']) ? ucfirst($this['title']) : ucfirst($this['name']);
    }

    /**
     * Set default settings for the WordPress editor.
     *
     * @return void
     */
    protected function setSettings()
    {
        $settings = [
            'textarea_name' => $this['name']
        ];

        $this['settings'] = isset($this['settings']) ? array_merge($settings, $this['settings']) : $settings;
    }

    /**
     * Define input where the value is saved.
     *
     * @return void
     */
    protected function fieldType()
    {
        $this->type = 'textarea';
    }

    /**
     * Method that handle the field HTML code for
     * metabox output.
     *
     * @return string
     */
    public function metabox()
    {
        $this->setSettings();

        return $this->view->make('metabox._themosisEditorField', ['field' => $this])->render();
    }

    /**
     * Handle the field HTML code for the
     * Settings API output.
     *
     * @return string
     */
    public function page()
    {
        return $this->metabox();
    }

    /**
     * Handle the HTML code for user output.
     *
     * @return string
     */
    public function user()
    {
        return $this->metabox();
    }


}