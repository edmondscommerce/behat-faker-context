<?php namespace EdmondsCommerce\BehatFakerContext;

use Faker\Guesser\Name;

class Guesser extends Name
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