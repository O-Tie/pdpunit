<?php

namespace services\FileService;

/**
 * Class FileService
 * @package services\FileService
 */
class DateService
{
    protected $currentDay;
    protected $currentDayArray;
    protected $day;
    protected $month;
    protected $year;
    protected const TOTAL_MONTH = 12;
    protected const WEEKEND_DAYS = [6, 7];
    protected const DATE_DAY = 0;
    protected const DATE_MONTH = 1;
    protected const DATE_YEAR = 2;
    protected const DATE_DELIMETER = '-';
    protected const BONUS_DAY = 15;
    protected const NEEDED_DAY = 3;
    protected const TOTAL_WEEK_DAYS = 7;

    public function getDateFormat()
    {
        return 'd' . self::DATE_DELIMETER  . 'm'  . self::DATE_DELIMETER . 'Y';
    }

    public function setCurrentDay()
    {
        $this->currentDay = date($this->getDateFormat(), time());
    }

    protected function setCurrentDayArray()
    {
        $this->currentDayArray = explode(self::DATE_DELIMETER, $this->currentDay);
    }

    protected function setDay()
    {
        $this->day = $this->currentDayArray[self::DATE_DAY];
    }

    protected function setMonth()
    {
        $this->month = $this->currentDayArray[self::DATE_MONTH];
    }

    protected function setYear()
    {
        $this->year = $this->currentDayArray[self::DATE_YEAR];
    }

    protected function getLastDayOfMonth($month, $year)
    {
        return date('t', mktime(0,0,0, (int) $month,1, (int) $year));
    }

    protected function getDate($day, $month, $year)
    {
        return $day . self::DATE_DELIMETER . $month . self::DATE_DELIMETER . $year;
    }

    protected function getFormattedDate($day, $month, $year)
    {
        return date($this->getDateFormat(), strtotime($this->getDate($day, $month, $year)));
    }

    protected function getDayOfWeek($day, $month, $year)
    {
        return date('N', strtotime($this->getDate($day, $month, $year)));
    }

    protected function isWeekend($day, $month, $year)
    {
        $dayOfWeek = $this->getDayOfWeek($day, $month, $year);
        return in_array($dayOfWeek, self::WEEKEND_DAYS);
    }

    public function init()
    {
        $this->setCurrentDay();
        $this->setCurrentDayArray();
        $this->setDay();
        $this->setMonth();
        $this->setYear();
    }

    public function getSalaryDate()
    {
        $salaryDate = null;
        $month = $this->month;
        $year = $this->year;
        $salaryDay = $this->getLastDayOfMonth($month, $year);
        while ($salaryDate === null) {
            if ($this->isWeekend($salaryDay, $month, $year)) {
                $salaryDay--;
            } else {
                $salaryDate = $this->getFormattedDate($salaryDay, $month, $year);
            }
        }
        return $salaryDate;
    }

    public function getBonusDate()
    {
        $bonusDay = self::BONUS_DAY;
        $month = $this->month < self::TOTAL_MONTH ? $this->month + 1 : 1;
        $year = $this->month < self::TOTAL_MONTH ? $this->year : $this->year + 1;
        if ($this->isWeekend($bonusDay, $month, $year)) {
            $dayOfWeek = $this->getDayOfWeek($bonusDay, $month, $year);
            $offset = self::TOTAL_WEEK_DAYS - $dayOfWeek + self::NEEDED_DAY;
            $bonusDay = $bonusDay + $offset;
        }
        $bonusDate = $this->getFormattedDate($bonusDay, $month, $year);
        return $bonusDate;
    }

    public function getSalaryDates()
    {
        $this->init();
        $dates = [];
        while ($this->month <= self::TOTAL_MONTH) {
            $dates[] = [$this->getSalaryDate(), $this->getBonusDate()];
            $this->month++;
        }
        return $dates;
    }
}
