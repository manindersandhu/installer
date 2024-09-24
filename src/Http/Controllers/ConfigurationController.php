<?php

namespace Lara\Installer\Http\Controllers;
use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
use DB;

class ConfigurationController extends Controller
{
  function writeEnv() : Returntype {
    $path = base_path('.env');
			$key = "blaaaa";
			$value = "sssssssssss";
			$path = base_path('.env');
		// dd(is_bool(env($key)));
			if(is_bool(env($key)))
			{
				$old = env($key)? 'true' : 'false';
				echo "1111";
			}
			elseif(env($key)===null){
				$old = 'null';
				echo "22222";
			}
			else{
				$old = env($key);
				echo "4444";
			}
		
			if (file_exists($path)) {
				file_put_contents($path, str_replace(
					"$key=".$old, "$key=".$value, file_get_contents($path)
				));
			} 
  }
}

