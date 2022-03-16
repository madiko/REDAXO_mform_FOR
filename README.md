# MForm - REDAXO Addon für bessere Input-Formulare

MForm ist ein REDAXO Addon, welches das Erstellen von Modul-Eingabeformularen erheblich erleichtert. Dabei nutzt MForm Templates welche es dem Administrator ermöglichen den Modul-Style seinen Vorstellungen anzupassen. MForm stellt alle gängigen Modul-Input-Formular-Elemente und zusätzlice Widgets bereit welche sich einfach einbinden lassen. MForm eweitert auch **YForm** und **rex_form** um zusätzliche Widgets, z.B. ein Custom-Link-Feld und Image-List für Galerien. 

Eine detailierte Beschreibung wie Modul-Input-Formulare mit beliebigen Elementen versehen werden können lässt sich im [Doku-Plugin](https://github.com/FriendsOfREDAXO/mform/blob/master/plugins/docs/docs/de_de/main_navi.md) finden.


**Hinweis**

* Der MForm Formular-Builder ist ausschließlich dafür geeignet REDAXO Modul-Input-Formulare zu generieren!


## Installation

1. Letzten [release](https://github.com/FriendsOfREDAXO/mform/releases/latest) downloaden
2. Zip Archiv entpacken
3. Entpackten Folder in `mform` umbenennen
4. MForm Ordner in den REDAXO Addon Ordner `redaxo/src/addons/` verschieben
5. In REDAXO einloggen und unter "AddOns" MForm installieren und aktivieren

## Alternative Installationen

MForm kann auch direkt über den Redaxo-Installer Installiert werden. [MForm Redaxo Addon Page](http://www.redaxo.org/de/download/addons/?addon_id=967&searchtxt=mform&cat_id=-1)

1. In REDAXO einloggen
2. Im Backend unter "Installer > Neue herunterladen" "MForm" suche und unter "Funktion" "ansehen" klicken
3. Bei der aktuelle Version in der Liste unter "Funktion" "herunterladen" klicken
4. Unter "AddOns" MForm installieren und aktivieren

## Usage

MForm muss im Modul-Input eines REDAXO Moduls als PHP Code notiert werden.


### Instanziierung  

```php
// instantiate
$MForm = MForm::factory();
```

Es können beliebig viele MForm Formulare erzeugt werden, welche je nach dem auch direkt als Element-Properties zu instazieren sind.

```php
// instantiate
$MForm = MForm::factory() // init 
    ->addFieldsetArea('My fieldset', MForm::factory() // use fieldset method and init new mform instance 
            ->addTextField(1, ['label' => 'My input']) // add text field with rex_value_id 1 and label attribute
    );
```

### Formularelemente

Die wesentlichen Formularelemente die MForm bereitstellt werden durch Methoden hinzugefügt.

```php
$MForm = MForm::factory()
    ->addHeadline("Headline") // add headline
    ->addTextField(1, ['label' => 'Input', 'style' => 'width:200px']); // add text field with rex_value_id 1
```

Alle MForm Methoden erwarten optional Attribute, Parameter und Optionen. Diese können auch durch Setter nachträglich dem Element zugewiesen werden.

```php
// add text field
$MForm = MForm::factory()
    ->addTextField(1) // add text field with rex_value_id 1
    ->setLabel('Text Field') 
    ->setAttributes(['style' => 'width:200px', 'class' => 'test-field']);
```
Der `REX_VALUE-Key` muss jeder Formular-Input-Methode als Pflichtfeld übergeben werden. Informative Elemente benötigen keine ID.


##### Full JSON Value Support

MForm unterstützt `REX_VALUE-ARRAYs` wodurch es praktisch keine `REX_VALUE`-Limitierung mehr gibt. Zu beachten ist, dass jeder x.0 Key als Sting übergeben werden muss.

```php
// add text field
$MForm = MForm::factory()
    ->addTextField("1.0")
    ->addTextField(1.1)
    ->addTextField("1.2.Titel");
```

### Formular erzeugen

Um das komponierte Formular erzeugen zu lassen muss muss die `show` Methode genutzt werden.

```php
 // create output
echo $MForm->show();

// without var
echo MForm::factory()
    ->addTextField(1, ['label' => 'Input', 'style' => 'width:200px']) // add text field with rex_value_id 1
    ->show();
```

### Element-Methoden

MForm stellt folgende Element-Methoden bereit: 

* Strukturelle Wrapper-Elemente
  * `addFieldsetArea`
  * `addCollapseElement`
  * `addAccordionElement`
  * `addTabElement`
  * `addColumnElement`
  * `addInlineElement`
* Text-Input- und Hidden-Elemente
  * `addTextField`
  * `addHiddenField`
  * `addTextAreaField`
  * `addTextReadOnlyField`
  * `addTextAreaReadOnlyField`
* Select-Elemente
  * `addSelectField`
  * `addMultiSelectField`
* Checkbox- und Radio-Elemente
  * `addCheckboxField`
  * `addRadioField`
* Informelle-Elemente
  * `addHtml`
  * `addHeadline`
  * `addDescription`
  * `addAlert`
  * `addAlertDanger`, `addAlertError`
  * `addAlertInfo`
  * `addAlertSuccess`
  * `addAlertWarning`
* System-Button-Elemente
  * `addLinkField`
  * `addLinklistField`
  * `addMediaField`
  * `addMedialistField`
* Custom-Elemente 
  * `addCustomLinkField`
  * `addImagelistField`
  * `addInputField`
* Spezielle `setter`-Methoden
  * `setAttribute`
  * `setAttributes`
  * `setCategory`
  * `setCollapseInfo`
  * `setDefaultValue`
  * `setDisableOption`
  * `setDisableOptions`
  * `setFormItemColClass`
  * `setFull`
  * `setLabel`
  * `setLabelColClass`
  * `setMultiple`
  * `setOption`
  * `setOptions`
  * `setParameter`
  * `setParameters`
  * `setPlaceholder`
  * `setSize`
  * `setSqlOptions`
  * `setTabIcon`
  * `setToggleOptions`
  * `setTooltipInfo`

## Lizenz

MForm ist unter der [MIT Lizenz](LICENSE.md) lizensiert.
