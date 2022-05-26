<?php


namespace EnjoysCMS\WYSIWYG\CKEditor5;

use EnjoysCMS\Core\Components\Helpers\Assets;
use EnjoysCMS\Core\Components\WYSIWYG\WysiwygInterface;

class CKEditor5 implements WysiwygInterface
{
    private ?string $twigTemplate = null;

    public function __construct()
    {
        Assets::js(__DIR__ . '/../node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js');
    }

    public function getTwigTemplate(): string
    {
        return $this->twigTemplate ?? '@wysiwyg/ckeditor5/template/basic.twig';
    }


    public function setTwigTemplate(?string $twigTemplate): void
    {
        $this->twigTemplate = $twigTemplate;
    }
}
