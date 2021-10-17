<?php


namespace Company\Module\Installer;


use InvalidArgumentException;
use Company\Module\Database\SqlQuery;

class Installer
{
    /**
     * @var array
     */
    private $hooks = [];

    /**
     * @var \Module
     */
    private $module;

    /**
     * @var \Db
     */
    private $database;

    /**
     * Module path.
     * @var string
     */
    private $path;

    /**
     * @var SqlQuery
     */
    private $sqlQuery;

    /**
     * Installer constructor.
     * @param \Module $module
     * @param \Db $database
     */
    public function __construct($module, $database)
    {
        $this->module = $module;
        $this->database = $database;
        $this->path = $this->module->getLocalPath().'resources/';
        //todo: maybe should move it to factory e.g. PrestashopSql?
        $this->sqlQuery = new SqlQuery();
        $this->sqlQuery->bind('prefix', _DB_PREFIX_);
        $this->sqlQuery->bind('engine', _MYSQL_ENGINE_);
    }

    /**
     * @return boolean $this
     */
    public function install()
    {
        return  $this->installHooks() &&
                $this->loadSchemas();
    }

    /**
     * Uninstall module.
     * @return bool
     */
    public function uninstall()
    {
        return true;
    }

    /**
     * @param string $string
     */
    public function registerHook(string $string)
    {
        $this->hooks[] = $string;
    }

    /**
     * @return array
     */
    public function getHookList()
    {
        return $this->hooks;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param array $hooks
     */
    public function registerHooks($hooks)
    {
        if (!is_array($hooks)) {
            throw new InvalidArgumentException('Argument \'$hooks\' must be an array.');
        }
        array_map(function ($hook) {
            $this->hooks[] = $hook;
        }, $hooks);
    }

    private function installHooks() {
        foreach ($this->getHookList() as $hook) {
            if (!$this->module->registerHook($hook)) {
                return false;
            }
        }
        return true;
    }

    /**
     * todo: move finding files to another class, maybe sth like FileMapper or FileFlatWalker
     */
    private function loadSchemas() {
        $path = $this->path.'sql';
        $files = scandir($path);
        foreach ($files as $file) {
            if (!in_array($file, ['.', '..'])) {;
                $content = file_get_contents($path.'/'.$file);
                if ($content) {
                    $sql = $this->sqlQuery->setSql($content)->build();
                    if (!$this->database->execute($sql, false)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}
