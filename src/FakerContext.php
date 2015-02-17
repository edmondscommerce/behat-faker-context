<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 17/02/15
 * Time: 10:51
 */

namespace EdmondsCommerce\FakerContext;

use Behat\Mink\Element;
use Behat\MinkExtension\Context;

final class FakerContext extends Context\RawMinkContext
{

    /** @var  \Faker\Generator */
    private $_faker;

    /** @var  Guesser */
    private $_guesser;

    /**
     * @return \Faker\Generator
     */
    protected function faker()
    {
        if (!$this->_faker) {
            $this->_faker = \Faker\Factory::create();
        }
        return $this->_faker;
    }

    /**
     * @return Guesser
     */
    protected function guesser()
    {
        if (!$this->_guesser) {
            $this->_guesser = new Guesser($this->faker());
        }
        return $this->_guesser;
    }


    /**
     * @When I fill in the form element :arg1
     */
    public function iFillInTheFormElement($arg1)
    {
        $page = $this->getSession()->getPage();
        $form = $page->find('css', $arg1);

        $this->fillForm($form);
    }

    /**
     * Fuzz fill all form fields with random data
     *
     * @param Element\NodeElement $form
     */
    protected function fillForm(Element\NodeElement $form)
    {
        $inputs = $form->findAll('css', 'input[type="text"]');
        foreach ($inputs as $i) {
            /** @var  Element\NodeElement $i */
            if ($i->isVisible()) {
                if ($i->hasAttribute('name')) {
                    $name = $i->getAttribute('name');
                    $value = $this->getFakerValue($name);
                } else {
                    $value = $this->faker()->text();
                }
                $i->setValue($value);
            }


        }

        $passwords = $form->findAll('css', 'input[type="password"]');
        $password = $this->faker()->password;
        foreach ($passwords as $p) {
            if ($p->isVisible()) {
                $p->setValue($password);
            }
        }

        $selects = $form->findAll('css', 'select');
        foreach ($selects as $s) {
            /** @var  Element\NodeElement $s */
            if ($s->isVisible()) {
                $s->selectOption($s->find('css', 'option')->getAttribute('name'));
            }
        }

        $checkboxes = $form->findAll('css', 'checkbox');
        foreach ($checkboxes as $c) {
            /** @var  Element\NodeElement $c */
            if ($c->isVisible()) {
                $c->check();
            }
        }

        $radios = $form->findAll('css', 'input[type="radio"]');
        $radio_names = array();
        foreach ($radios as $r) {
            /** @var  Element\NodeElement $r */
            if ($r->isVisible()) {
                if ($r->hasAttribute('name')) {
                    $name = $r->getAttribute('name');
                    if (!isset($radio_names[$name])) {
                        $radio_names[$name] = true;
                        $r->click();
                    }
                }
            }
        }

    }

    /**
     * @param string $name
     * @return bool|mixed
     */
    protected function getFakerValue($name)
    {
        $guess = $this->guesser()->guessFormat($name);

        if (!$guess) {
            return $this->faker()->text();
        }

        return $guess();
    }


}