<?php

namespace App\Service\CommandExecutor;

class SlurmHelper
{
    /**
     * @var CommandExecutorService
     */
    private CommandExecutorService $executorService;

    public function __construct(CommandExecutorService $executorService)
    {
        $this->executorService = $executorService;
    }

    /**
     * Add the specified user to the chosen Slurm group.
     *
     * @param string $username
     * @param string $group
     * @return string
     */
    public function addUserToSlurmGroup(string $username, string $group): string
    {
        return $this->executorService
            ->executeCommand('yes | sacctmgr add user ' . $username . ' account=' . $group)
            ->getOutput();
    }

    /**
     * Creates a temp directory on the server and generates a new ssh key with the user's email.
     *
     * @param string $email
     * @return string
     */
    public function generateSshKey(string $email): string
    {
        // Generate a new temp directory and generate an SSH key.
        $tmpDir = $this->executorService->removeTrailing($this->executorService->executeCommand([
            'cd "$(mktemp -d)"',
            'pwd',
            'ssh-keygen -C "' . $email . '" -t rsa -b 4096 -f alan -N "" > /dev/null'
        ])->getOutput());

        return $tmpDir . '/alan';
    }
}