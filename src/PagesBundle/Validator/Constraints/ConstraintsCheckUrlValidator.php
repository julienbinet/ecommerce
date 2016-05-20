<?php

namespace PagesBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintsCheckUrlValidator extends ConstraintValidator {

    public function curlUrl($site) {
        $site = curl_init($site);
        curl_setopt($site, CURLOPT_FAILONERROR, true);
        curl_setopt($site, CURLOPT_NOBODY, true);

        if (curl_exec($site) == false) {
            $curl = false;
        } else {
            $curl = true;
        }

        curl_close($site);

        return $curl;
    }

    public function findUrl($param) {

        $violation = false;
        $urls = preg_match_all('/<a href="(.*)">/', $param, $url);

        /*
          $url[0] => expression entiere recupere dans le match
          $url[1] => contenu recupere dans le match
         */
        foreach (array_unique($url[1]) as $site) {
            if ($this->curlUrl($site) == false)
                $violation = true;
        }

        return $violation;
    }

    public function validate($value, Constraint $constraint) {

        if ($this->findUrl($value) == true)
            $this->context->addViolation($constraint->message);
    }

}
