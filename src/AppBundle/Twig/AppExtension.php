<?php

namespace AppBundle\Twig;

use Doctrine\ORM\EntityManager;


class AppExtension extends \Twig_Extension
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '₦ '.$price;

        return $price;
    }

    public function getGlobals()
    {

        // TODO: setting parameter change this i future cos currently the department can not be more than 8 ?

        // TODO: if the global gender declearation throws error remove it  ?
        $limit = 8;
        $Category = $this->em->getRepository('AppBundle:Category');
        $Department = $this->em->getRepository('AppBundle:Department');
        $Gender = $this->em->getRepository('AppBundle:Gender');

        $departments = $Department->findDepartment($limit);
        $categories = $Category->findAllvisable();
        $gender = $Gender->findAll();

        return array(
            'departments' => $departments,
            'categories' => $categories,
            'gender'=>$gender
        );
    }


    public function getName()
    {
        return 'app_extension';
    }
}