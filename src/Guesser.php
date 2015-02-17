<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 17/02/15
 * Time: 12:46
 */

namespace EdmondsCommerce\FakerContext;


class Guesser extends \Faker\Guesser\Name
{
    public function guessFormat($name)
    {
        $name = strtolower($name);
        $generator = $this->generator;
        if (false !== strpos($name, 'email')) {
            return function () use ($generator) {
                return $generator->email;
            };
        }
        if (false !== strpos($name, 'phone')) {
            return function () use ($generator) {
                return $generator->phoneNumber;
            };
        }
        if (false !== strpos($name, 'pass')) {
            return function () use ($generator) {
                return $generator->password;
            };
        }
        $return = parent::guessFormat($name);
        if ($return) {
            return $return;
        }

        if (false !== strpos($name, 'company')) {
            return function () use ($generator) {
                return $generator->company;
            };
        }

        return false;
    }


}