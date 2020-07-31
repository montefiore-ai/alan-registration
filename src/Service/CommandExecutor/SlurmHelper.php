<?php

namespace App\Service\CommandExecutor;

class SlurmHelper
{
    /**
     * @var CommandExecutorService
     */
    private $executorService;

    public function __construct(CommandExecutorService $executorService)
    {
        $this->executorService = $executorService;
    }

    public function showAssoc(): string
    {
        return $this->executorService->executeCommand('sacctmgr show assoc')->getOutput();
    }

    public function test(): string
    {
        return $this->executorService->executeCommand([
            'ls',
            'pwd'
        ])->getOutput();
    }

}