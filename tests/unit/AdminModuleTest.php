<?php
/**
 * Copyright (c) Liigem 2017.
 */

use App\Modules\AdminModule;
use App\Version;

class AdminModuleTest extends TestCase
{
    /**
     * Trying to create a version
     *
     * @return void
     */
    public function testVersions()
    {
        $module = new AdminModule();

        // Testing creation
        $module->addVersion(0.05,"New Version");
        $version = Version::where('version_number',0.05)->first();
        $this->assertTrue($version->update == "New Version");

        //Testing update
        $module->updateVersion(0.05,"Coucou");
        $version = Version::where('version_number',0.05)->first();
        $this->assertTrue($version->update == "Coucou");

        //Testing deletion
        $module->removeVersion(0.05);
        $version = Version::where('version_number',0.05)->first();
        $this->assertTrue($version === null);


    }


}
