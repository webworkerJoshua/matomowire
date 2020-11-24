<?php namespace ProcessWire;

class TextformatterMatomoWireConfig extends ModuleConfig
{
    public function getDefaults()
    {
        return [
            'open_tag' => '[[',
            'close_tag' => ']]',
            'tag_name' => "matomowire-opt-out"
        ];
    }

    public function getInputfields()
    {
        $inputfields = parent::getInputfields();

        // open tag
        $f = $this->modules->get('InputfieldText');
        $f->attr('name', 'open_tag');
        $f->label = $this->_('Open Tag');
        $f->columnWidth = 33;
        $inputfields->add($f);

        // close tag
        $f = $this->modules->get('InputfieldText');
        $f->attr('name', 'close_tag');
        $f->label = $this->_('Close Tag');
        $f->columnWidth = 33;
        $inputfields->add($f);

        // tag name
        $f = $this->modules->get('InputfieldText');
        $f->attr('name', 'tag_name');
        $f->label = $this->_('Tag name');
        $f->columnWidth = 34;
        $inputfields->add($f);

        return $inputfields;
    }
}
