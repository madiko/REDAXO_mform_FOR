<?php
/**
 * @author Joachim Doerr
 * @package redaxo5
 * @license MIT
 */

use MForm\DTO\MFormInputsConfig;
use MForm\Inputs\MFormInputsInterface;
use MForm\MFormElements;
use MForm\Parser\MFormParser;

class MForm extends MFormElements
{
    use rex_factory_trait;

    private string $theme;
    private bool $debug;

    function __construct(?string $theme = null, bool $debug = false)
    {
        $this->setTheme((!is_null($theme)) ? $theme : '');
        $this->setDebug($debug);
        parent::__construct();
    }

    public function show(): string
    {
        // MForm count++
        try {
            rex_set_session('mform_count', rex_session('mform_count') + 1);
            $parser = new MFormParser();
            return $parser->parse($this->getItems(), ((!empty($this->theme)) ? $this->theme : null), $this->debug);
        } catch (rex_exception $e) {
            rex_logger::logException($e);
            return rex_view::error($e->getMessage());
        }
    }

    public static function factory($debug = false): MForm
    {
        $class = static::getFactoryClass();
        return new $class(null, $debug);
    }

    public function addInputs(string $filename = null, MFormInputsConfig $inputsConfig = null): ?MForm
    {
        if (!empty($filename)) {
            if (substr($filename,(strlen($filename) - 1), 1) == '/') $filename = substr($filename, 0, strlen($filename) - 1);
            $basename = pathinfo($filename, PATHINFO_BASENAME);
            if (str_contains($filename, '.php')) {
                $filename = substr($filename, 0, strlen($filename) - 4);
            }
            $file = (file_exists(rex_path::addon('mform/inputs', $filename . '.php'))) ? rex_path::addon('mform/inputs', $filename . '.php') : $filename . '.php';
            if (file_exists($file)) {
                include_once $file;
                /** @var MFormInputsInterface $inputs */
                $inputs = new $basename($this, $inputsConfig);
                return $inputs->generateInputs();
            }
        }
        return null;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;
        return $this;
    }

    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;
        return $this;
    }
}
