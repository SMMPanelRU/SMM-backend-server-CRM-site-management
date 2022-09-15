<?php

namespace App\Services;

use App\Enum\SystemLogs\SystemLogTypeEnum;
use App\Models\SystemLog;

class SystemLogService
{
    private ?string           $class;
    private ?string           $method;
    private ?string           $index;
    private SystemLogTypeEnum $type;
    private ?string           $message;
    private ?array            $data = null;

    public function log(SystemLog $systemLog = null): SystemLog
    {
        if ($systemLog === null) {
            $systemLog = new SystemLog();
        }
        if ($this->class ?? null) {
            $systemLog->class = $this->class;
        }
        if ($this->method ?? null) {
            $systemLog->method = $this->method;
        }
        if ($this->index ?? null) {
            $systemLog->index = $this->index;
        }
        if ($this->type ?? null) {
            $systemLog->type = $this->type;
        }
        if ($this->message ?? null) {
            $systemLog->message = $this->message;
        }
        if ($this->data ?? null) {
            $systemLog->data = $this->data;
        }

        $systemLog->save();

        return $systemLog;

    }

    function addToData(string|array $value): SystemLogService
    {
        if ($this->data === null) {
            $this->data = [];
        }
        $this->data = array_merge($this->data, is_array($value) ? $value : [$value]);

        return $this;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     *
     * @return SystemLogService
     */
    public function setClass(string $class): SystemLogService
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @return SystemLogService
     */
    public function setMethod(string $method): SystemLogService
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->index;
    }

    /**
     * @param string $index
     *
     * @return SystemLogService
     */
    public function setIndex(string $index): SystemLogService
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return \App\Enum\SystemLogs\SystemLogTypeEnum
     */
    public function getType(): SystemLogTypeEnum
    {
        return $this->type;
    }

    /**
     * @param \App\Enum\SystemLogs\SystemLogTypeEnum $type
     *
     * @return SystemLogService
     */
    public function setType(SystemLogTypeEnum $type): SystemLogService
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return SystemLogService
     */
    public function setMessage(string $message): SystemLogService
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return SystemLogService
     */
    public function setData(array $data): SystemLogService
    {
        $this->data = $data;

        return $this;
    }


}
