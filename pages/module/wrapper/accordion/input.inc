<?php
use FriendsOfRedaxo\MForm;
// init mform
$mform = MForm::factory()
    // fieldset
    ->addFieldsetArea('Collapse accordion elements', MForm::factory()
        ->addAccordionElement('Accordion 1', MForm::factory()
            ->addTextAreaField('1.1', ['label' => 'Text-Area 1'])
        )
        ->addAccordionElement('Accordion 2', MForm::factory()
            ->addTextAreaField('1.2', ['label' => 'Text-Area 2'])
        , true) // open this collapse initial
        ->addAccordionElement('Accordion 3', MForm::factory()
            ->addTextAreaField('1.3', ['label' => 'Text-Area 3'])
        )
    );
// parse mform
echo $mform->show();