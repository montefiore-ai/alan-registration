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
     * @param string $username
     * @return void
     */
    public function generateSshKey(string $email, string $username): void
    {
        shell_exec('yes | ssh-keygen -C "' . $email . '" -t rsa -b 4096 -f ../' . $username . ' -N "" > /dev/null');
    }
}