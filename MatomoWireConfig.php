<?php namespace ProcessWire;

class MatomoWireConfig extends ModuleConfig
{
    public function getDefaults()
    {
        return [
            'matomo_url' => '',
            'embedding_method' => 'site',
            'render_position' => 'body',
            'site_id' => '',
            'container_id' => '',
            'track_users_without_js' => false,
            'set_do_not_track' => false,
            'disable_cookies' => false,
            'integrate_privacywire' => false,
            'privacywire_cookie_category' => 'statistics',
            'opt_out_type' => 'iframe'
        ];
    }

    public function getInputfields()
    {
        $inputfields = parent::getInputfields();


        // Matomo URL
        $f = $this->modules->get('InputfieldURL');
        $f->attr('name', 'matomo_url');
        $f->label = $this->_('Matomo URL');
        $f->description = $this->_('Insert the full URL including http:// or https://');
        $f->columnWidth = 33;
        $f->required = 1;
        $inputfields->add($f);

        // Embedding Method
        $f = $this->modules->get('InputfieldSelect');
        $f->attr('name', 'embedding_method');
        $f->description = $this->_("Choose between the classical matomo site tracking or via Matomo Tag Manager");
        $f->label = $this->_('Embedding Method');
        $f->options = [
            "site" => $this->_("Site Tracking"),
            "tag" => $this->_("Matomo Tag Manager Tracking"),
        ];
        $f->columnWidth = 33;
        $f->required = 1;
        $inputfields->add($f);

        // Rendering Position
        $f = $this->modules->get('InputfieldSelect');
        $f->attr('name', 'render_position');
        $f->description = $this->_("Choose between rendering within <head> or within <body>.");
        $f->label = $this->_('Rendering Position');
        $f->options = [
            "head" => $this->_("<head>"),
            "body" => $this->_("<body>"),
        ];
        $f->columnWidth = 34;
        $inputfields->add($f);

        // Site Id
        $f = $this->modules->get('InputfieldText');
        $f->attr('name', 'site_id');
        $f->label = $this->_('Site Id');
        $f->columnWidth = 100;
        $f->showIf("embedding_method=site");
        $inputfields->add($f);

        // Container Id
        $f = $this->modules->get('InputfieldText');
        $f->attr('name', 'container_id');
        $f->label = $this->_('Container Id');
        $f->columnWidth = 100;
        $f->showIf("embedding_method=tag");
        $inputfields->add($f);

        // Site Tracking: Track Users Without JavaScript
        $f = $this->modules->get('InputfieldCheckbox');
        $f->attr('name', 'track_users_without_js');
        $f->showIf("embedding_method=site");
        $f->label = $this->_('Track users without JavaScript');
        $f->columnWidth = 33;
        $inputfields->add($f);

        // Site Tracking: Respect DoNotTrack (DNT)
        $f = $this->modules->get('InputfieldCheckbox');
        $f->attr('name', 'set_do_not_track');
        $f->showIf("embedding_method=site");
        $f->label = $this->_('Respect Do-Not-Track');
        $f->columnWidth = 33;
        $inputfields->add($f);

        // Site Tracking: Disable Cookies
        $f = $this->modules->get('InputfieldCheckbox');
        $f->attr('name', 'disable_cookies');
        $f->showIf("embedding_method=site");
        $f->label = $this->_('Disable Cookies');
        $f->columnWidth = 34;
        $inputfields->add($f);

        // Fieldset for PrivacyWire Integration
        $privacywire_integration = $this->modules->get('InputfieldFieldset');
        $privacywire_integration->label = $this->_("PrivacyWire Integration");
        $inputfields->add($privacywire_integration);

        // Enable PrivacyWire Integration
        $f = $this->modules->get('InputfieldCheckbox');
        $f->attr('name', 'integrate_privacywire');
        $f->label = $this->_('Enable PrivacyWire Integration');
        $f->description = $this->_('**Important:** PrivacyWire needs to be installed to enable this feature!');
        $f->columnWidth = 33;
        $privacywire_integration->add($f);

        // PrivacyWire Cookie Category
        $f = $this->modules->get('InputfieldSelect');
        $f->attr('name', 'privacywire_cookie_category');
        $f->showIf("integrate_privacywire=1");
        $f->description = $this->_("Choose, which PrivacyWire Cookie Category should trigger the Matomo Integration");
        $f->label = $this->_('PrivacyWire Cookie Category');
        $f->options = [
            "necessary" => $this->_("Necessary Cookies"),
            "functional" => $this->_("Functional Cookies"),
            "all" => $this->_("All Cookies"),
            "statistics" => $this->_("Statistics"),
            'marketing' => $this->_("Marketing"),
            'external_media' => $this->_("External Media")
        ];
        $f->columnWidth = 33;
        $privacywire_integration->add($f);

        // PrivacyWire Cookie Category
        $f = $this->modules->get('InputfieldSelect');
        $f->attr('name', 'opt_out_type');
        $f->showIf("integrate_privacywire=1");
        $f->label = $this->_('Matomo Opt-Out Type');
        $f->description = $this->_("Should the Opt-Out Tag (Textformatter) trigger the Matomo iFrame Opt-Out (default) or the PrivacyWire Choose-Cookies-Window?");
        $f->options = [
            "iframe" => $this->_("Matomo iFrame (default)"),
            "privacywire" => $this->_("PrivacyWire Choose-Cookies-Window"),
        ];
        $f->columnWidth = 34;
        $privacywire_integration->add($f);

        return $inputfields;
    }
}
