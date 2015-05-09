<?php

namespace LS\CalculatorBundle\Util;
/**
 * Class Calculator
 * @package LS\CalculatorBundle\Util
 */
class Calculator
{
    /** @var  int */
    private $date;
    /** @var  int */
    private $hours;

    /**
     * @param $date
     * @param $hours
     */
    function __construct($date, $hours)
    {
        $this->date = $date;
        $this->hours = $hours;

    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return gmdate("Y-m-d\TH:i:s\Z", $this->date);
    }

    public function treatment()
    {
        $hour = 60 * 60;
        for ($i = 0; $i < $this->hours; $i++) {
            if ($this->isWorks() ) {
                $this->date += $hour;
            } else {
                while (!($this->isWorks())) {
                    $this->date += $hour;
                }
            }
        }
    }

    /**
     *
     * @return bool
     */
    private function isWorks()
    {
        $isWeekend = date('w', $this->date) % 6 == 0;
        if ($isWeekend) {
            return false;
        }
        $hour = date('H', $this->date);
        if ($hour <= 10 || $hour >= 16) {
            return false;
        }
        return true;
    }

}