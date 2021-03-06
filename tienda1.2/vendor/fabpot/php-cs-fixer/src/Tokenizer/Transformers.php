<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer\Tokenizer;

use PhpCsFixer\Utils;
use Symfony\Component\Finder\Finder;

/**
 * Collection of Transformer classes.
 *
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * @internal
 */
final class Transformers
{
    /**
     * The registered transformers.
     *
     * @var TransformerInterface[]
     */
    private $items = array();

    /**
     * Array mapping custom token value => custom token name.
     *
     * @var array
     */
    private $customTokens = array();

    /**
     * Constructor. Register built in Transformers.
     */
    private function __construct()
    {
        $this->registerBuiltInTransformers();

        usort($this->items, function (TransformerInterface $a, TransformerInterface $b) {
            return Utils::cmpInt($b->getPriority(), $a->getPriority());
        });
    }

    /**
     * Create Transformers instance.
     *
     * @return Transformers
     */
    public static function create()
    {
        static $instance = null;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Get name for registered custom token.
     *
     * @param int $value custom token value
     *
     * @return string
     */
    public function getCustomToken($value)
    {
        if (!$this->hasCustomToken($value)) {
            throw new \InvalidArgumentException(sprintf('No custom token was found for: %s', $value));
        }

        return $this->customTokens[$value];
    }

    /**
     * Check if given custom token was added to collection.
     *
     * @param int $value custom token value
     *
     * @return bool
     */
    public function hasCustomToken($value)
    {
        return isset($this->customTokens[$value]);
    }

    /**
     * Transform given Tokens collection through all Transformer classes.
     *
     * @param Tokens $tokens Tokens collection
     */
    public function transform(Tokens $tokens)
    {
        foreach ($tokens as $index => $token) {
            foreach ($this->items as $transformer) {
                $transformer->process($tokens, $token, $index);
            }
        }
    }

    /**
     * Register Transformer.
     *
     * @param TransformerInterface $transformer Transformer
     */
    private function registerTransformer(TransformerInterface $transformer)
    {
        if (PHP_VERSION_ID >= $transformer->getRequiredPhpVersionId()) {
            $this->items[] = $transformer;
        }

        $transformer->registerCustomTokens();

        foreach ($transformer->getCustomTokenNames() as $name) {
            $this->addCustomToken(constant($name), $name);
        }
    }

    /**
     * Add custom token.
     *
     * @param int    $value custom token value
     * @param string $name  custom token name
     */
    private function addCustomToken($value, $name)
    {
        if ($this->hasCustomToken($value)) {
            throw new \LogicException(
                sprintf(
                    'Trying to register token %s (%s), token with this value was already defined: %s',
                    $name, $value, $this->getCustomToken($value)
                )
            );
        }

        $this->customTokens[$value] = $name;
    }

    /**
     * Register all built in Transformers.
     */
    private function registerBuiltInTransformers()
    {
        static $registered = false;

        if ($registered) {
            return;
        }

        $registered = true;

        foreach (Finder::create()->files()->in(__DIR__.'/Transformer') as $file) {
            $relativeNamespace = $file->getRelativePath();
            $class = __NAMESPACE__.'\\Transformer\\'.($relativeNamespace ? $relativeNamespace.'\\' : '').$file->getBasename('.php');
            $this->registerTransformer(new $class());
        }
    }
}
