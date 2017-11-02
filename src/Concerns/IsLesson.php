<?php

namespace YanDatsyuk\Courses\Concerns;

use http\Exception;
use YanDatsyuk\Courses\Core\RateType;
use YanDatsyuk\Courses\Exceptions\IncorrectPriceValueException;
use YanDatsyuk\Courses\Exceptions\UnknownRateTypeException;

/**
 * Trait IsLesson
 * @package YanDatsyuk\Courses\Concerns
 */
trait IsLesson
{
    /**
     * Duration for a lesson.
     *
     * @var $duration float
     */
    private $duration;

    /**
     * Price value for a fixed rate or for an hour.
     *
     * @var $price float
     */
    private $price;

    /**
     * Rate type for a lesson.
     *
     * @var $rateType string
     */
    private $rateType;


    /**
     * Calculate total price for a lesson.
     * Price depends on rate type of this lesson.
     *
     * @return float
     * @throws UnknownRateTypeException
     */
    public function getTotalPrice(): float
    {
        switch ($this->rateType) {
            case RateType::FIXED:
                return $this->_calculatePriceForFixedRate();
                break;

            case RateType::HOURLY:
                return $this->_calculatePriceForHourlyRate();
                break;

            default:
                throw new UnknownRateTypeException();
        }
    }

    private function _calculatePriceForFixedRate(): float
    {
        return $this->price;
    }

    private function _calculatePriceForHourlyRate(): float
    {
        return $this->price * $this->duration;
    }

    /**
     * @return mixed
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param $price
     * @throws IncorrectPriceValueException
     */
    public function setPrice($price)
    {
        //price validation
        if ($price < 0) {
            throw new IncorrectPriceValueException();
        }
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * @param $duration
     * @throws IncorrectPriceValueException
     */
    public function setDuration($duration)
    {
        //duration validation
        if ($duration < 0) {
            throw new IncorrectPriceValueException();
        }

        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getRateType(): string
    {
        return $this->rateType;
    }

    /**
     * @param string $rateType
     */
    public function setRateType(string $rateType)
    {
        $this->rateType = $rateType;
    }
}