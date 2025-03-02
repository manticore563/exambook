<?php
namespace App\Controllers;

use App\Models\TestModel;
use App\Models\QuestionModel;
use App\Models\UserResponseModel;

class TestController extends BaseController {
    public function index() {
        $testModel = new TestModel();
        $data['tests'] = $testModel->findAll();
        return view('tests/index', $data);
    }

    public function takeTest($testId) {
        $testModel = new TestModel();
        $questionModel = new QuestionModel();
        $data['test'] = $testModel->find($testId);
        $data['questions'] = $questionModel->where('test_id', $testId)->findAll();
        $data['current_question'] = 0; // Start at first question
        return view('tests/take_test', $data);
    }

    public function submitAnswer() {
        $responseModel = new UserResponseModel();
        $data = [
            'user_id' => session()->get('user_id'),
            'test_id' => $this->request->getPost('test_id'),
            'question_id' => $this->request->getPost('question_id'),
            'selected_answer' => $this->request->getPost('selected_answer')
        ];
        $questionModel = new QuestionModel();
        $question = $questionModel->find($data['question_id']);
        $data['is_correct'] = ($data['selected_answer'] === $question['correct_answer']) ? 1 : 0;
        $responseModel->insert($data);

        $nextQuestion = $this->request->getPost('next_question');
        $questions = $questionModel->where('test_id', $data['test_id'])->findAll();
        if ($nextQuestion < count($questions)) {
            return $this->response->setJSON([
                'success' => true,
                'question' => $questions[$nextQuestion],
                'question_number' => $nextQuestion
            ]);
        }
        return $this->response->setJSON(['success' => true, 'finished' => true]);
    }

    public function results($testId) {
        $responseModel = new UserResponseModel();
        $responses = $responseModel->where(['user_id' => session()->get('user_id'), 'test_id' => $testId])->findAll();
        $total = count($responses);
        $correct = array_sum(array_column($responses, 'is_correct'));
        $data = [
            'total_questions' => $total,
            'correct_answers' => $correct,
            'score' => $total ? ($correct / $total) * 100 : 0
        ];
        return view('tests/results', $data);
    }
}