<?php

namespace Manindersandhu\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Manindersandhu\Installer\Traits\SetEnvironment;

class DatabaseController extends Controller
{
    use SetEnvironment;

    private $envPath;
    private $env;

    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->env =  file($this->envPath);;
    }
    /**
     * Show form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        return view('Installer::database', compact('host', 'port', 'database', 'username', 'password'));
    }

    /**
     * Manage form submission.
     *
     * @param  Illuminate\Http\Request                               $request
     * @return redirection
     */


    public function isStatusInstalled()
    {
        $this->set('APP_INSTALL', 'true');
        file_put_contents($this->envPath, implode($this->env));
    }
    public function setDatabaseSetting(Request $request)
    {
        $this->set('DB_DATABASE', $request->dbname);
        $this->set('DB_USERNAME', $request->username);
        $this->set('DB_PASSWORD', $request->password);
        $this->set('DB_HOST', $request->host);
        $this->set('DB_PORT', $request->port);
        $this->set('APP_DEBUG', 'false');
        file_put_contents($this->envPath, implode($this->env));
        $this->uploadLog();
        $this->isStatusInstalled();
    }
    private function set($key, $value)
    {
        $this->env = array_map(function ($item) use ($key, $value) {
            if (strpos($item, $key) !== false) {
                $start = strpos($item, '=') + 1;
                $item = substr_replace($item, $value . "\n", $start);
            };
            return $item;
        }, $this->env);
    }

    public function store(Request $request)
    {
        // Set config for migrations and seeds
        $connection = config('database.default');
        config([
            'database.connections.' . $connection . '.host'     => $request->host,
            'database.connections.' . $connection . '.port'     => $request->port,
            'database.connections.' . $connection . '.database' => $request->dbname,
            'database.connections.' . $connection . '.password' => $request->password,
            'database.connections.' . $connection . '.username' => $request->username,
        ]);
        $this->setDatabaseSetting($request);
        return redirect('install/database-fill');
    }

    public function seedMigrate()
    {
        try {
            ini_set('max_execution_time', 1600);
            Artisan::call('db:setup');
            return true;
        } catch (Exception $e) {
            return view($e->getMessage());
        }
    }
}
