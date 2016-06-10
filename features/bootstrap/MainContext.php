<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class MainContext extends FeatureContext
{

    private $welcome;
    private $search;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @Given I setup language
     */
    public function setLanguage()
    {
        if($this->getMinkParameter('base_url') == 'https://en.wikipedia.org/wiki/Main_Page') {
            $this->welcome = "Welcome to Wikipedia";
            $this->search  = "You are here";
        } elseif($this->getMinkParameter('base_url') == 'https://it.wikipedia.org/wiki/Main_Page') {
            $this->welcome = "Benvenuti su Wikipedia";
            $this->search  = "affrontando sia gli argomenti";
        }
    }

    /**
     * @Then I should see the text welcome text
     */
    public function iShouldSeeTheTextWelcomeText()
    {
        $this->assertPageContainsText($this->welcome);
        sleep(3);
    }


    /**
     * @Given I visit the home page
     */
    public function iVisitTheHomePage()
    {

        $this->visit($this->getMinkParameter('base_url'));
    }
}
