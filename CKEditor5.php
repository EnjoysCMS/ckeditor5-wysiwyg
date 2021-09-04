<?php


namespace EnjoysCMS\WYSIWYG\CKEditor5;

use EnjoysCMS\Core\Components\Helpers\Assets;
use EnjoysCMS\Core\Components\WYSIWYG\WysiwygInterface;

class CKEditor5 implements WysiwygInterface
{
    private string $twigTemplate;

    public function __construct(string $twigTemplate = null)
    {
        $this->twigTemplate = $twigTemplate ?? '@wysisyg/ckeditor5/template/basic.tpl';
        $this->initialize();
    }

    public function getTwigTemplate()
    {
        return $this->twigTemplate;
    }

    private function initialize()
    {
        Assets::js([
                       __DIR__ . '/node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js'
                   ]);
    }
}