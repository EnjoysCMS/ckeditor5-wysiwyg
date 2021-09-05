<?php


namespace EnjoysCMS\WYSIWYG\CKEditor5;

use EnjoysCMS\Core\Components\Helpers\Assets;
use EnjoysCMS\Core\Components\WYSIWYG\WysiwygInterface;

class CKEditor5 implements WysiwygInterface
{
    private string $template;

    public function __construct(string $template = null)
    {
        $this->template = $template ?? '@wysisyg/ckeditor5/template/basic.twig';
    }

    public function getTwigTemplate()
    {
        return $this->template;
    }


}