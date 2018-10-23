<?php
/**
 * Copyright (c) Liigem 2017.
 */
namespace App\Modules;
/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 03/10/2016
 * Time: 19:50
 */
interface TeacherPageModuleInterface
{
    /**
     * @param $teacherId int
     * @return array of Assignment
     */
    static function getHomework($teacherId);

    /**
     * @param $teacherId int
     * @return String
     */
    static function getContactInformation($teacherId);
}