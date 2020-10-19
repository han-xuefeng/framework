<?php


namespace Calendar\Model;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LeapYear
{
    public function isLeapYear($year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }else{
            if (!is_numeric($year)) {
                throw new BadRequestHttpException('参数错误');
            }
        }
        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }
}