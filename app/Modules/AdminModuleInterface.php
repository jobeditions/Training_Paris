<?php
/**
 * Copyright (c) Liigem 2016.
 */
namespace App\Modules;

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 31/08/2016
 * Time: 14:51
 */
interface AdminModuleInterface
{
    // VERSIONS
    function addVersion($id,$content);
    function removeVersion($id);
    function updateVersion($id,$content);
}
