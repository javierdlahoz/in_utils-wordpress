<?php
require "Helper/TextHelper.php";

use INUtils\Helper\TextHelper;
/**
 * TextHelperTest test case.
 */
class TextHelperTestTest extends PHPUnit_Framework_TestCase
{
    const CAMELCASE_EXAMPLE = "myTest";
    const UNDERSCORE_EXAMPLE = "my_test";

    private $textHelper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->textHelper = new TextHelper();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated TextHelperTestTest::tearDown()
        $this->textHelperTest = null;

        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }


    public function testCamelcaseToUnderscoreCase(){
        $this->assertEquals(self::UNDERSCORE_EXAMPLE, $this->textHelper->camelCaseToUnderscoreCase(self::CAMELCASE_EXAMPLE));
    }
}

