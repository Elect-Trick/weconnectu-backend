<?php
declare(strict_types=1);


set_exception_handler(static function (\Throwable $e): void {
    error_log((string) $e);

    // Lets default to 500 and hide the server details lapha
    $status  = 500;
    $payload = ['error' => 'Server error'];

    if ($e instanceof PDOException)
    {
        //lets switch on the driver specific error code
        //For db failures , we could expand this to
        //accomodate more drivers but for now mysql_pdo is fine.

        switch (true)
        {
            case $e->errorInfo[1] === 1062:
                $status  = 409;
                $payload = ['error' => 'Email already exists'];
                break;

        }
    }
 elseif ($e instanceof Exception) {
        $status  = $e->getCode();
        $payload = ['error' => $e->getMessage()];
    }

     //Optional: surface detail in dev only
//    if ((getenv('ENVIRONMENT') ?: 'dev') !== 'prod') {
//        $payload['debug'] = [
//            'type'    => get_class($e),
//            'message' => $e->getMessage(),
//            'file'    => $e->getFile() . ':' . $e->getLine(),
//        ];
//    }

    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
});