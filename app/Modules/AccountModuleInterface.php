<?php
/**
 * Copyright (c) Liigem 2016.
 */
namespace App\Modules;

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 30/09/2016
 * Time: 08:02
 */
use Illuminate\Http\Request;

interface AccountModuleInterface
{
    /**
     * There are two main account types for users : teacher and school. A teacher that's not linked to any school can switch his or her account to a school one
     * A school can switch account type as long as there is only one teacher. Any other case will result in a failure to switch account type
     */
    function changeAccountType(Request $request);


    /**
     * School accounts should be able to invite new teachers, which can be rejected if the user's plan doesn't allow for more teachers
     */
    function inviteTeacher(Request $request);

    /**
     * This function allows for a school account to remove a specific teacher.
     */
    function removeTeacher(Request $request);

    /**
     * This function retrieves all teacher accounts associated with a specific school account
     */
    function findAssociatedTeachers(Request $request);

    /**
     * This function deletes an account
     */
    function deleteAccount(Request $request);
}