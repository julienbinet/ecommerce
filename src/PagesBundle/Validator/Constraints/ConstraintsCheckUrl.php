<?php

namespace PagesBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintsCheckUrl extends Constraint{
    
    public $message= "Le champ contient un ou des liens Urls non valide(s)";
    
}
