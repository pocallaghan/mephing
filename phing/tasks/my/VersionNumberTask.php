<?

class VersionNumberTask extends Task
{
    private $versionprop;

    public function setVersionProp($versionprop)
    {
        $this->versionprop = $versionprop;
    }

    public function init()
    {
    }

    public function main()
    {
        $etcPath = $this->project->getProperty('path.etc');
        $filepath = realpath("./{$etcPath}config.xml");
        $moduleNode = $this->getModuleFullName();
        $sxe = simplexml_load_file($filepath);
        $version = $sxe->module->$moduleNode->version;
        $versionstr = str_replace('.', '_', $version);
        $this->project->setProperty($this->versionprop, "v$versionstr");
    }

    protected function getModuleFullName()
    {
        $namespace = $this->project->getProperty('module.namespace');
        $moduleName = $this->project->getProperty('module.name');
        return "{$namespace}_{$moduleName}";
    }
}