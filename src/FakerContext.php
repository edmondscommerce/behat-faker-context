<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 17/02/15
 * Time: 10:51
 */

namespace EdmondsCommerce\FakerContext;

use Behat\Behat\Context\Context;

final class FakerContext implements Context
{

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
     * @When I fill in the form element "([^"]+)"
     */
    public function iFillInTheFormElement($css)
    {
        $page = $this->getSession()->getPage();
        $form = $page->find('css', $css);
        return $this->fillForm($form);
    }

    /**
     * Fuzz fill all form fields with random data
     *
     * @param NodeElement $form
     */
    protected function fillForm(NodeElement $form)
    {
        $inputs = $form->findAll('css', 'input[type="text"]');
        foreach ($inputs as $i) {
            $i->setValue($this->faker()->text());

        }
        $selects = $form->findAll('css', 'select');
        foreach ($selects as $s) {
            $s->selectOption($s->find('css', 'option')->getAttribute('name'));
        }
        $checkboxes = $form->findAll('css', 'checkbox');
        foreach ($checkboxes as $c) {
            $c->check();
        }
    }

}