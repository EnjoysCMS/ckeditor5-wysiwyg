<?php


namespace EnjoysCMS\ContentEditor\CKEditor5;

use Enjoys\AssetsCollector;
use EnjoysCMS\Core\ContentEditor\ContentEditorInterface;
use Exception;
use RuntimeException;
use Throwable;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CKEditor5 implements ContentEditorInterface
{
    private ?string $selector = null;

    /**
     * @throws Exception
     */
    public function __construct(
        private readonly Environment $twig,
        private readonly AssetsCollector\Assets $assets,
        private readonly ?string $template = null
    ) {
        if (!file_exists(__DIR__ . '/../node_modules/@ckeditor')) {
            $command = sprintf('cd %s && yarn install', realpath(__DIR__ . '/..'));
            try {
                $result = passthru($command);
                if ($result === false) {
                    throw new Exception();
                }
            } catch (Throwable) {
                throw new RuntimeException(sprintf('Run: %s', $command));
            }
        }

        $this->initialize();
    }


    public function initialize(): void
    {
        $this->assets->add('js', __DIR__ . '/../node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js');
    }

    private function getTemplate(): ?string
    {
        return $this->template ?? __DIR__ . '/../template/basic.twig';
    }


    public function setSelector(string $selector): void
    {
        $this->selector = $selector;
    }

    public function getSelector(): string
    {
        if ($this->selector === null) {
            throw new RuntimeException('Selector not set');
        }
        return $this->selector;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getEmbedCode(): string
    {
        $twigTemplate = $this->getTemplate();
        if (!$this->twig->getLoader()->exists($twigTemplate)) {
            throw new RuntimeException(
                sprintf("ContentEditor: (%s): Нет шаблона в по указанному пути: %s", self::class, $twigTemplate)
            );
        }
        return $this->twig->render(
            $twigTemplate,
            [
                'editor' => $this,
                'selector' => $this->getSelector()
            ]
        );
    }
}
