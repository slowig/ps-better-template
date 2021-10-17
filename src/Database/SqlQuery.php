<?php


namespace Company\Module\Database;


class SqlQuery
{
    /**
     * @var array
     */
    private $values = [];

    /**
     * @var string
     */
    private $sql;

    /**
     * SqlQuery constructor.
     * @param $sql
     */
    public function __construct($sql = null)
    {
        $this->sql = $sql;
    }

    /**
     * Bind parameter in sql
     * @param $name
     * @param $value
     * @return $this
     */
    public function bind($name, $value)
    {
        $this->values[$name] = $value;
        return $this;
    }

    /**
     * Bind all parameters into
     * @return string
     */
    public function build()
    {
        $preparedSql = $this->sql;
        foreach ($this->values as $name => $value) {
            $preparedSql = str_replace('{'.$name.'}', $value, $preparedSql);
        }
        return $preparedSql;
    }

    /**
     * @param string $sql
     */
    public function setSql(string $sql)
    {
        $this->sql = $sql;
        return $this;
    }
}
