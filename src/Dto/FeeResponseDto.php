<?php


namespace App\Dto;


/**
 * Class FeeResponseDto
 * @package App\Dto
 * @codeCoverageIgnore
 */
class FeeResponseDto
{
    /**
     * @var array
     *
     */
    private $errors;

    /**
     * @var boolean
     *
     * @JMS\Type("boolean")
     */
    private $success;

    /**
     * @var array
     */
    private $data;

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return $this
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @param string $error
     * @return $this
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $datum
     * @return $this
     */
    public function addData($datum)
    {
        $this->data[] = $datum;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return $this
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }
}
