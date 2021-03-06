<?php

namespace YanDatsyuk\Courses\Concerns;

use YanDatsyuk\Courses\Contracts\RateType;
use YanDatsyuk\Courses\Exceptions\IncorrectDurationValueException;
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
     * @var $rateType RateType
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
        return $this->rateType->calculatePrice($this->price, $this->duration);
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
     * @throws IncorrectDurationValueException
     */
    public function setDuration($duration)
    {
        //duration validation
        if ($duration < 0) {
            throw new IncorrectDurationValueException();
        }

        $this->duration = $duration;
    }

    /**
     * @return RateType
     */
    public function getRateType(): RateType
    {
        return $this->rateType;
    }

    /**
     * @param RateType $rateType
     */
    public function setRateType(RateType $rateType)
    {
        $this->rateType = $rateType;
    }
}