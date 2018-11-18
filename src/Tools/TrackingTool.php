<?php

namespace Elhebert\Tracking\Tools;

use Elhebert\Croustillon\Traits\HasCookies;
use Elhebert\Croustillon\Facades\Croustillon;
use Symfony\Component\HttpFoundation\Response;

abstract class TrackingTool
{
    use HasCookies;

    abstract public function configure();

    abstract public function config(): array;

    abstract protected function configIsValid(): bool;

    public function viewPath(): string
    {
        return camel_case(class_basename($this));
    }

    public function neededCookieLevel(): int
    {
        return $this->getCookies()
            ->groupBy(function ($cookie) {
                return $cookie->category();
            })
            ->keys()
            ->map(function ($category) {
                return Croustillon::category($category);
            })
            ->reduce(function ($carry, $category) {
                return $carry + $category->value();
            }) ?? 0;
    }

    public function addTrackingCodeTo(Response $response): Response
    {
        if (
            !$this->configIsValid()
            || !$this->hasAcceptedNeededCookiePolicy()
            || !$this->containsBodyTag($response)
        ) {
            return $response;
        }

        $content = $response->getContent();
        $closingBodyTagPosition = $this->getLastClosingBodyTagPosition($content);
        $content = ''
            . substr($content, 0, $closingBodyTagPosition)
            . view("tracking::{$this->viewPath()}")
                ->with('hasCookies', $this->getCookies()->count() > 0)
                ->with('config', $this->config())
                ->render()
            . substr($content, $closingBodyTagPosition);

        return $response->setContent($content);
    }

    protected function hasAcceptedNeededCookiePolicy(): bool
    {
        return Croustillon::hasAcceptedPolicy($this->neededCookieLevel());
    }

    protected function containsBodyTag(Response $response): bool
    {
        return $this->getLastClosingBodyTagPosition($response->getContent()) !== false;
    }

    protected function getLastClosingBodyTagPosition(string $content = '')
    {
        return strripos($content, '</body>');
    }
}
