<?php
namespace App\Controllers;

use App\Models\TestModel;
use App\Models\QuestionModel;
use PhpOffice\PhpWord\IOFactory;

class AdminController extends BaseController {
    public function createTest() {
        if ($this->request->getMethod() === 'post') {
            $testModel = new TestModel();
            $testId = $testModel->insert([
                'title' => $this->request->getPost('title'),
                'duration' => $this->request->getPost('duration')
            ]);
            return redirect()->to("/admin/add-questions/$testId");
        }
        return view('admin/create_test');
    }

    public function addQuestions($testId) {
        if ($this->request->getMethod() === 'post') {
            $questionModel = new QuestionModel();
            $questionModel->insert([
                'test_id' => $testId,
                'question_text' => $this->request->getPost('question_text'),
                'option_a' => $this->request->getPost('option_a'),
                'option_b' => $this->request->getPost('option_b'),
                'option_c' => $this->request->getPost('option_c'),
                'option_d' => $this->request->getPost('option_d'),
                'correct_answer' => $this->request->getPost('correct_answer')
            ]);
        }
        $testModel = new TestModel();
        $data['test'] = $testModel->find($testId);
        return view('admin/add_questions', $data);
    }

    public function bulkUpload($testId) {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('word_file');
            if ($file->isValid() && $file->getExtension() === 'docx') {
                $phpWord = IOFactory::load($file->getTempName());
                $questionModel = new QuestionModel();
                $text = '';
                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        if (method_exists($element, 'getText')) {
                            $text .= $element->getText() . "\n";
                        }
                    }
                }
                $lines = explode("\n", $text);
                $question = null;
                foreach ($lines as $line) {
                    if (preg_match('/^Q\d+\.\s*(.+)$/', $line, $matches)) {
                        $question = ['test_id' => $testId, 'question_text' => $matches[1]];
                    } elseif (preg_match('/^A\)\s*(.+)\s*B\)\s*(.+)\s*C\)\s*(.+)\s*D\)\s*(.+)$/', $line, $matches)) {
                        $question['option_a'] = $matches[1];
                        $question['option_b'] = $matches[2];
                        $question['option_c'] = $matches[3];
                        $question['option_d'] = $matches[4];
                    } elseif (preg_match('/^Answer:\s*([A-D])$/', $line, $matches)) {
                        $question['correct_answer'] = $matches[1];
                        $questionModel->insert($question);
                        $question = null;
                    }
                }
                return redirect()->to("/admin/add-questions/$testId")->with('message', 'Questions uploaded successfully!');
            }
            return redirect()->back()->with('error', 'Invalid file');
        }
        $testModel = new TestModel();
        $data['test'] = $testModel->find($testId);
        return view('admin/bulk_upload', $data);
    }
}