<?php

namespace YanDatsyuk\Courses;

use YanDatsyuk\Courses\Concerns\IsLesson;
use YanDatsyuk\Courses\Contracts\Lesson as ILesson;
use YanDatsyuk\Courses\Contracts\RateType;

/**
 * Class Lesson
 * @package YanDatsyuk\Courses
 */
abstract class Lesson implements ILesson
{
    use IsLesson;

    /**
     * Lesson constructor.
     *
     * @param int $price
     * @param int $duration
     * @param RateType $rateType
     */
    public function __construct($price = 0, $duration = 0, RateType $rateType = null)
    {
        $this->setPrice($price);
        $this->setDuration($duration);
        if (!is_null($rateType)) {
            $this->setRateType($rateType);
        }
    }

    /**
     * Add possibility to use magic "setters".
     *
     * @param $name
     * @param $value
     * @return $this
     */
    public function __set($name, $value)
    {
        $methodName = 'set' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);
            return $this;
        }
    }

}