<?php
namespace services;

/**
 * Class FileService
 * @package services\DateService
 */
class DateService
{
    protected $currentDay;
    protected $month;
    protected $year;
    protected const TOTAL_MONTH = 12;
    protected const WEEKEND_DAYS = [6, 7];
    protected const DATE_DELIMETER = '-';
    protected const FIRST_DAY_OF_MONTH = 1;
    protected const BONUS_DAY = 15;
    protected const NEEDED_DAY = 3;
    protected const TOTAL_WEEK_DAYS = 7;
    protected const DATA_HEADER = ['Month', 'Salary Date', 'Bonus Date'];

    /**
     * @return string
     */
    protected function getDateFormat(): string
    {
        return 'd-m-Y';
    }

    protected function setCurrentDay()
    {
        $this->currentDay = time();
    }

    protected function setMonth()
    {
        $this->month = date('n', $this->currentDay);
    }

    protected function setYear()
    {
        $this->year = date('Y', $this->currentDay);
    }

    /**
     * @param $month
     * @param $year
     * @return string
     */
    protected function getLastDayOfMonth($month, $year): string
    {
        return date('t', mktime(0, 0, 0, $month, 1, $year));
    }

    /**
     * @param $day
     * @param $month
     * @param $year
     * @return string
     */
    protected function getDate($day, $month, $year): string
    {
        return $day . self::DATE_DELIMETER . $month . self::DATE_DELIMETER . $year;
    }

    /**
     * @param $day
     * @param $month
     * @param $year
     * @return string
     */
    protected function getFormattedDate($day, $month, $year): string
    {
        return date($this->getDateFormat(), strtotime($this->getDate($day, $month, $year)));
    }

    /**
     * @param $day
     * @param $month
     * @param $year
     * @return string
     */
    protected function getDayOfWeek($day, $month, $year): string
    {
        return date('N', strtotime($this->getDate($day, $month, $year)));
    }

    /**
     * @param $day
     * @param $month
     * @param $year
     * @return bool
     */
    protected function isWeekend($day, $month, $year): bool
    {
        $dayOfWeek = $this->getDayOfWeek($day, $month, $year);
        return in_array($dayOfWeek, self::WEEKEND_DAYS);
    }

    /**
     * Returns month name, example 'June'
     * @param $day
     * @param $month
     * @param $year
     * @return string
     */
    protected function getMonthName($day, $month, $year): string
    {
        return date('F', strtotime($this->getDate($day, $month, $year)));
    }

    /**
     * Initialize application data
     */
    protected function init()
    {
        $this->setCurrentDay();
        $this->setMonth();
        $this->setYear();
    }

    /**
     * Returns formatted salary date
     * @return string|null
     */
    protected function getSalaryDate(): ?string
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

    /**
     * Returns formatted bonus date
     * @return string
     */
    protected function getBonusDate(): string
    {
        $bonusDay = self::BONUS_DAY;
        $month = $this->month < self::TOTAL_MONTH ? $this->month + 1 : 1; /*get the number of month for paying bonus*/
        $year = $this->month < self::TOTAL_MONTH ? $this->year : $this->year + 1; /*get the year for paying bonus*/
        if ($this->isWeekend($bonusDay, $month, $year)) {
            $dayOfWeek = $this->getDayOfWeek($bonusDay, $month, $year);
            $offset = self::TOTAL_WEEK_DAYS - $dayOfWeek + self::NEEDED_DAY;
            $bonusDay = $bonusDay + $offset; /*get wednesday*/
        }
        $bonusDate = $this->getFormattedDate($bonusDay, $month, $year);
        return $bonusDate;
    }

    /**
     * Returns prepared data for export to CSV
     * @return array
     */
    public function getData(): array
    {
        $this->init();
        $data = [self::DATA_HEADER];
        while ($this->month <= self::TOTAL_MONTH) {
            $data[] = [$this->getMonthName(self::FIRST_DAY_OF_MONTH, $this->month, $this->year), $this->getSalaryDate(), $this->getBonusDate()];
            $this->month++;
        }
        return $data;
    }
}
