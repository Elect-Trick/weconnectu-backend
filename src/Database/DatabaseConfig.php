<?php
declare(strict_types=1);
namespace Database;

use PDO;

class DatabaseConfig
{
    private static ?PDO $pdo = null;
    private static string $host;
    private static string $dbname;
    private static string $username;
    private static string $password;

    private static bool $isInitialized = false;

    public function __construct()
    {
    }

    public static function setEnvironmentValues(): void
    {
        if (!self::$isInitialized) {
            $environment = getenv("ENVIRONMENT")?: "dev";
            switch ($environment)
            {
                case "dev":
                    self::$host = "127.0.0.1";
                    self::$dbname = "weconnectu";
                    self::$username = "njax";
                    self::$password = "coffee";
                    break;
                case "prod":

                        self::$host  = self::requireEnv('DB_HOST');
                        self::$dbname   = self::requireEnv('DB_NAME');
                        self::$username = self::requireEnv('DB_USERNAME');
                        self::$password = self::requireEnv('DB_PASSWORD');
                    break;

                default:
                    throw new \Exception("Invalid environment");
            }

            self::$isInitialized = true;
        }

    }


    public static function getPdoConnection(): ?PDO
    {
        if (self::$pdo === null) {
            self::setEnvironmentValues();
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname. ";charset=utf8mb4";
            self::$pdo = new PDO($dsn, self::$username, self::$password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        return self::$pdo;
    }

    public static function requireEnv(string $key): string
    {
        $value = getenv($key);
        if ($value === false || $value === '') {
            throw new \RuntimeException("Missing required environment variable: {$key}");
        }
        return $value;
    }

}