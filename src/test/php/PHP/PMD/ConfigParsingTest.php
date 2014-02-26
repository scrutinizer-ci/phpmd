<?php

require_once dirname(__FILE__) . '/AbstractTest.php';

require_once 'PHP/PMD.php';
require_once 'PHP/PMD/RuleSetFactory.php';
require_once 'PHP/PMD/Renderer/XMLRenderer.php';

class PHP_PMD_ConfigParsingTest extends PHP_PMD_AbstractTest
{
    /**
     * @dataProvider getInvalidConfigFiles
     */
    public function testParseConfigFilesWithErrors($configFile, $expectedMessage)
    {
        $this->setExpectedException('RuntimeException', $expectedMessage);

        $renderer = new PHP_PMD_Renderer_XMLRenderer();

        $phpmd = new PHP_PMD();
        $phpmd->processFiles(
            self::createFileUri('source/ccn_function.php'),
            self::createFileUri('config/'.$configFile),
            array($renderer),
            new PHP_PMD_RuleSetFactory()
        );
    }

    public function getInvalidConfigFiles()
    {
        return array(
            array('unknown_rule.xml', 'Could not find any rule named "NestedScopes", available rules: BooleanArgumentFlag, ElseExpression, StaticAccess'),
        );
    }
}