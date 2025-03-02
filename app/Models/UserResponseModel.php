<?php
namespace App\Models;

use CodeIgniter\Model;

class UserResponseModel extends Model {
    protected $table = 'user_responses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'test_id', 'question_id', 'selected_answer', 'is_correct', 'submitted_at'];
    protected $useTimestamps = false;
}