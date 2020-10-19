<?php


namespace Calendar\Controller;


use Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
        $leapYear = new LeapYear();

        if ($leapYear->isLeapYear($year)) {
            $response = new Response('Yep, this is a leap year!');
        }else{
            $response = new Response('Nope, this is not a leap year.');
        }

        $response ->setContent($response->getContent().rand());
//        $response->setEtag($year);
//        $response->setTtl(30);
        return $response;
    }
}