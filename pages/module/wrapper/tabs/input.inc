<?php
use FriendsOfRedaxo\MForm;
// init mform
$mform = MForm::factory()
    ->addTabElement('Tab1', MForm::factory()
        ->addTextField('1.1',['label' => 'Text1'])
            ->setOptions([1=>'option1',2=>'option2'])
    )
    ->addTabElement('Tab2', MForm::factory()
        ->addTextField('2.1',['label' => 'Text2'])
        , true, true
    )
    ->addTabElement('Tab3', MForm::factory()
        ->addTextField('2.2',['label' => 'Text3'])
    );
// parse mform
echo $mform->show();