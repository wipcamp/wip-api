<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    protected $questions;

    function __construct() {
        $this->questions = new QuestionRepository;
    }

    function get(Request $request) {
        return $this->questions->get();
    }

    function getById($question_id) {
        return $this->questions->getById($question_id);
    }
}
