<?php

namespace App\Service\CommandExecutor;

use Spatie\Ssh\Ssh;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CommandExecutorService
{
    /**
     * @var CommandExecutorService $instance
     */
    private static $instance;

    /**
     * @var Ssh $process
     */
    private $process;

    public function __construct(string $projectDir = null, string $user = null, string $host = null)
    {
        $this->process = Ssh::create($user, $host)
            ->disableStrictHostKeyChecking()
            ->usePrivateKey($projectDir . '/alan-config/ssh/slurm');
    }

    public static function allocate(): self
    {
        if (self::$instance === null) {
            self::$instance = new CommandExecutorService();
        }

        return self::$instance;
    }

    public function getProcess(): Ssh
    {
        return $this->process;
    }

    /**
     * Execute a command on the server and throw an exception on failure.
     *
     * @param $cmd
     * @return Process
     */
    public function executeCommand($cmd): Process
    {
        $process = $this->process->execute($cmd);

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process;
    }

    public function removeTrailing(string $val): string
    {
        return substr($val, 0, -1);
    }

}