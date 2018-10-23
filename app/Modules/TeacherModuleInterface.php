<?php
/**
 * Copyright (c) Liigem 2016.
 */

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 03/09/2016
 * Time: 10:10
 */
namespace App\Modules;

use Illuminate\Http\Request;

interface TeacherModuleInterface
{
    // ASSIGNMENTS
    function addAssignment(Request $request);
    function updateAssignment(Request $request);
    function deleteAssignment(Request $request);

    // DOCUMENTS
    function addDocument(Request $request);
    function removeDocument(Request $request);

    // CLASSES
    function addClass(Request $request, $teacher);
    function removeClass(Request $request, $teacher, $id);
    function updateClass(Request $request, $teacher, $id);

    // INVITES
    function newInvite(Request $request);
    function removeInvite(Request $request);

    // SETTINGS
    function updateDesign(Request $request);
    function courseSharing(Request $request); // Enables the teacher to share his or her course on her page
    function setVisibility(Request $request); // Enables a teacher to let only his/her students see her page or anyone
}
