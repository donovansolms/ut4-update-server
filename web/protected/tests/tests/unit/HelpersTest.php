<?php


class HelpersTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testHashPassword()
    {
        $password = GeneralHelper::hashPassword('test');
        $this->assertContains('$2y$' . Yii::app()->params['BCRYPT_COST'] . '$', $password);
    }
}
