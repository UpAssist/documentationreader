<?php
namespace UpAssist\DocumentationReader\Eel;

use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Utility\Files;

/**
 * @Flow\Scope ("singleton")
 */
class MarkdownHelper implements ProtectedContextAwareInterface
{

    /**
     * @param string $fileName
     * @return string
     */
    public function parse(string $fileName): string
    {
        $parsedown = new \Parsedown();
        if (!str_starts_with($fileName, 'http')) {
            $markdownContents = Files::getFileContents(FLOW_PATH_ROOT . $fileName);
        } else {
            $markdownContents = Files::getFileContents($fileName);
        }
        return $parsedown
            ->setBreaksEnabled(true)
            ->parse($markdownContents);
    }

    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
