<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class InstallController extends Controller {
    public function index() {
        if (file_exists('../.env')) {
            return redirect()->to('/');
        }
        return view('install/index');
    }

    public function checkRequirements() {
        $checks = [
            'php_version' => version_compare(PHP_VERSION, '7.4', '>='),
            'mysql' => extension_loaded('mysqli'),
            'writable_env' => is_writable('../'),
            'writable_public' => is_writable('../public'),
            'writable_writable' => is_writable('../writable')
        ];
        return $this->response->setJSON($checks);
    }

    public function install() {
        $dbHost = $this->request->getPost('db_host');
        $dbName = $this->request->getPost('db_name');
        $dbUser = $this->request->getPost('db_user');
        $dbPass = $this->request->getPost('db_pass');
        $baseUrl = $this->request->getPost('base_url');
        $adminEmail = $this->request->getPost('admin_email');
        $adminPass = $this->request->getPost('admin_pass');

        // Test database connection
        $mysqli = @new \mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if ($mysqli->connect_error) {
            return $this->response->setJSON(['success' => false, 'error' => 'Database connection failed']);
        }

        // Create tables
        $schema = file_get_contents('../install/sql/schema.sql');
        $mysqli->multi_query($schema);
        while ($mysqli->next_result()) {;}

        // Insert admin user
        $adminPassHash = password_hash($adminPass, PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO users (username, email, password) VALUES ('admin', '$adminEmail', '$adminPassHash')");

        // Generate .env file
        $env = "app.baseURL = '$baseUrl'\n";
        $env .= "database.default.hostname = '$dbHost'\n";
        $env .= "database.default.database = '$dbName'\n";
        $env .= "database.default.username = '$dbUser'\n";
        $env .= "database.default.password = '$dbPass'\n";
        $env .= "database.default.DBDriver = MySQLi\n";
        file_put_contents('../.env', $env);

        $mysqli->close();
        return $this->response->setJSON(['success' => true]);
    }
}