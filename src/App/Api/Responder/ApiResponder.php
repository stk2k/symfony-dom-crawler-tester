<?php
namespace SymfonyDomCrawlerTester\App\Api\Responder;

use Calgamo\Util\Util;
use Calgamo\Kernel\LoggerInterface;

use SymfonyDomCrawlerTester\Logger\LoggerTrait;

class ApiResponder
{
    use LoggerTrait;

    /** @var LoggerInterface */
    private $logger;

    /**
     * ShellResponder constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Get logger
     *
     * @return LoggerInterface
     */
    public function getLogger() : LoggerInterface
    {
        return $this->logger;
    }

    /**
     * Send api header
     */
    protected static function sendApiHeader()
    {
        header("Content-Type: application/json; charset=utf-8");
    }

    /**
     * success response
     *
     * {
     *    code: 1
     *    data: <json_data>
     * }
     *
     * @param mixed $data
     */
    public function successResponse($data = NULL)
    {
        list($file, $line) = Util::caller();
        $this->debug('API will return success response: ' . print_r($data, true) . ' from ' . basename($file) . '(' . $line . ')');
        $res = [
            'code' => 1,
            'data' => $data !== NULL ? $data : NULL,
        ];
        self::sendApiHeader();

        $json = json_encode($res);
        echo $json;

        if (!empty($json)){
            $this->logger->debug('Sent sucess response: ' . $json);
        }
        else{
            $this->logger->warning('Failed to encode json: ' . json_last_error_msg() . ' data=' . print_r($res, true));
        }
    }

    /**
     * error response
     *
     * {
     *    code: -108
     *    message: 'NOT AUTHORIZED'
     * }
     * 
     * @param int $code
     * @param string $message
     *
     * @throws
     */
    public function errorResponse(int $code, string $message)
    {
        list($file, $line) = Util::caller();
        $this->debug('API will return error response: ' . $code . ' from ' . basename($file) . '(' . $line . ')');
        $res = [
            'code' => $code,
            'message' => $message,
        ];
        self::sendApiHeader();

        $json = json_encode($res);
        echo $json;

        $this->logger->debug('Sent error response: ' . $json);
    }

}