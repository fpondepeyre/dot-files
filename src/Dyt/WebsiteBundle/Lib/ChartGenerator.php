<?php

namespace Dyt\WebsiteBundle\Lib;

use Dyt\WebsiteBundle\Model\RefLevelQuery;
use Dyt\WebsiteBundle\Model\Student;

class ChartGenerator
{
    protected $classroom;

    public function __construct($classroom)
    {
        $this->classroom = $classroom;
    }

    public function getData()
    {
        $categories = $this->getChartCategories();
        $schoolName = $this->getChartSchoolName();
        $schoolYear = $this->getChartSchoolYear();
        $students = $this->getChartStudents();

        return array(
            'schoolName' => json_encode($schoolName),
            'schoolYear' => json_encode($schoolYear),
            'categories' => json_encode($categories),
            'boys' => json_encode($students['boys']),
            'girls' => json_encode($students['girls']),
        );
    }

    private function getChartCategories()
    {
        $levels = RefLevelQuery::create()->find();
        $data = array();
        foreach ($levels as $level) {
            $data[] = $level->getShortLevel();
        }

        $categories = array();
        $categories['categories'] = $data;

        return $categories;
    }

    private function getChartSchoolName()
    {
        $schoolName = array();
        $schoolName['text'] = $this->classroom->getSchool()->getName();

        return $schoolName;
    }

    private function getChartSchoolYear()
    {
        $schoolYear = array();
        $schoolYear['text'] = (date('n') < 7) ? (string) (date('Y') - 1) . '-' . date('Y') : date('Y') . '-' . (string) (date('Y') + 1);

        return $schoolYear;
    }

    private function getChartStudents()
    {
        $students = array ();

        $students['boys'] = array ();
        $students['boys']['data'] = array(0, 0, 0, 0);
        $students['boys']['name'] = 'Garçons';

        $students['girls'] = array ();
        $students['girls']['data'] = array(0, 0, 0, 0);
        $students['girls']['name'] = 'Filles';

        foreach ($this->classroom->getStudents() as $student) {
            if ($student->getSex() == Student::SEX_BOY)
                $students['boys']['data'][$student->getRefLevel()->getId() - 1]++;
            else
                $students['girls']['data'][$student->getRefLevel()->getId() - 1]++;
        }

        return $students;
    }

}
