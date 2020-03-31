<?php


class DatabaseConfig
{
    private string $serverName = "server name";
    private string $userName = "user name";
    private string $serverPass = "server password";

    public function getServerName(): string
    {
        return $this->serverName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getServerPass(): string
    {
        return $this->serverPass;
    }
}