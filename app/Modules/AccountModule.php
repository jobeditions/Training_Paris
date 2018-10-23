<?php
/**
 * Copyright (c) Liigem 2016.
 */

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 30/09/2016
 * Time: 17:49
 */

namespace App\Modules;


use Illuminate\Http\Request;

class AccountModule implements AccountModuleInterface
{

    /**
     * There are two main account types for users : teacher and school. A teacher that's not linked to any school can switch his or her account to a school one
     * A school can switch account type as long as there is only one teacher. Any other case will result in a failure to switch account type
     */
    function changeAccountType(Request $request)
    {
        // TODO: Implement changeAccountType() method.
    }
    
    /**
     * School accounts should be able to invite new teachers, which can be rejected if the user's plan doesn't allow for more teachers
     */
    function inviteTeacher(Request $request)
    {
        // TODO: Implement inviteTeacher() method.
    }

    /**
     * This function allows for a school account to remove a specific teacher.
     */
    function removeTeacher(Request $request)
    {
        // TODO: Implement removeTeacher() method.
    }

    /**
     * This function retrieves all teacher accounts associated with a specific school account
     */
    function findAssociatedTeachers(Request $request)
    {
        // TODO: Implement findAssociatedTeachers() method.
    }

    /**
     * This function deletes an account
     */
    function deleteAccount(Request $request)
    {
        // TODO: Implement deleteAccount() method.
    }
}