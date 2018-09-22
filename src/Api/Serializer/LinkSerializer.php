<?php

/*
 * (c) Sajjad Hashemian <wolaws@gmail.com>
 */

namespace Sijad\Links\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\DiscussionSerializer;
use Symfony\Component\Translation\TranslatorInterface;

class LinkSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'links';

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultAttributes($link)
    {
        $attributes = [
            'id'         => $link->id,
            'title'      => $this->translateLinkTitle($link->title),
            'url'        => $link->url,
            'position'   => $link->position,
            'isInternal' => $link->is_internal,
            'isNewtab'   => $link->is_newtab,
        ];

        return $attributes;
    }

    /**
     * @param string $title
     * @return string
     */
    private function translateLinkTitle($title)
    {
        $translation = $this->translator->trans($key = 'core.link.'.strtolower($title));

        if ($translation !== $key) {
            return $translation;
        }

        return $title;
    }
}
