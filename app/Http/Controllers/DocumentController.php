<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    // powers the trm translation page
    function index()
    {
        $comments = \App\Document::all();
        echo '<pre>';
        print_r($comments);
        echo '</pre>';
    }
}
