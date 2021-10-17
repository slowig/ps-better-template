<?php


namespace Company\Module\Tests\Unit\Database;


use Company\Module\Database\SqlQuery;

class SqlQueryTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldBindParametersInSql()
    {
        $sql = 'select  * from {prefix}database;';
        $query = new SqlQuery($sql);

        $query->bind('prefix', 'ps_');

        $this->assertGreaterThan(0, strpos($query->build(), 'ps_database'));
        $this->assertNotFalse(strpos($query->build(), 'ps_database'));
    }
}
