<?php

namespace Elhebert\Tracking\Traits;

use Illuminate\Support\Collection;
use Elhebert\Tracking\Tools\TrackingTool;
use Elhebert\Tracking\Exceptions\InvalidTool;

trait HasTools
{
    /** @var \Tracking\Tools\Tool[] */
    protected $tools = [];

    public function addTool(string $tool): self
    {
        $this->guardAgainstInvalidTools($tool);

        if (!$this->alreadyPresent($tool)) {
            $tool = app($tool);
            $tool->configure();

            $this->tools[] = $tool;
        }

        return $this;
    }

    /**  @throws \Tracking\Exceptions\InvalidTool */
    protected function guardAgainstInvalidTools(string $tool)
    {
        $tool = app($tool);

        if (!is_a($tool, TrackingTool::class, true)) {
            throw InvalidTool::create($tool);
        }
    }

    public function getTools(): Collection
    {
        return collect($this->tools);
    }

    private function alreadyPresent(string $className): bool
    {
        return collect($this->tools)->filter(function ($tool) use ($className) {
            return class_basename($tool) === $className;
        })->count() > 0;
    }
}
