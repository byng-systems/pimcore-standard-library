<?php

namespace Byng\Pimcore\Delegate;

/**
 * Logger provides the same interface Pimcores Logger class and delegates all
 * method calls to Pimcores logger.
 *
 * @author Asim Liaquat <asim@byng.co>
 */
class Logger
{

    public function setLogger($logger)
    {
        \Logger::setLogger($logger);
    }

    public function resetLoggers()
    {
        \Logger::resetLoggers();
    }

    public function addLogger($logger, $reset = false)
    {
        \Logger::addLogger($logger, $reset);
    }

    public function getLogger()
    {
        \Logger::getLogger();
    }

    public function setPriorities($prios)
    {
        \Logger::setPriorities($prios);
    }

    public function getPriorities()
    {
        \Logger::getPriorities();
    }

    public function initDummy()
    {
        \Logger::initDummy();
    }

    public function disable()
    {
        \Logger::disable();
    }

    public function enable()
    {
        \Logger::enable();
    }

    public function setVerbosePriorities()
    {
        \Logger::setVerbosePriorities();
    }

    public function log($message, $code = Zend_Log::INFO)
    {
        \Logger::log($message, $code);
    }

    public function emergency($m, $l = null)
    {
        \Logger::emergency($m, $l);
    }

    public function emerg($m, $l = null)
    {
        \Logger::emerg($m, $l);
    }

    public function critical($m, $l = null)
    {
        \Logger::critical($m, $l);
    }

    public function crit($m, $l = null)
    {
        \Logger::crit($m, $l);
    }

    public function error($m, $l = null)
    {
        \Logger::error($m, $l);
    }

    public function err($m, $l = null)
    {
        \Logger::err($m, $l);
    }

    public function alert($m, $l = null)
    {
        \Logger::alert($m, $l);
    }

    public function warning($m, $l = null)
    {
        \Logger::warning($m, $l);
    }

    public function warn($m, $l = null)
    {
        \Logger::warn($m, $l);
    }

    public function notice($m, $l = null)
    {
        \Logger::notice($m, $l);
    }

    public function info($m, $l = null)
    {
        \Logger::info($m, $l);
    }

    public function debug($m, $l = null)
    {
        \Logger::debug($m, $l);
    }

}
