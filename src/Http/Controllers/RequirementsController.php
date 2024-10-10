<?php

namespace Manindersandhu\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequirementsController extends Controller
{
    private $_minPhpVersion = '7.0';
    /**
     * Display the requirements page.
     *
     * @return \Illuminate\View\View
     */

    public function checkPHPversion(string $minPhpVersion = null)
    {
        $minVersionPhp = $minPhpVersion;
        $currentPhpVersion = $this->getPhpVersionInfo();
        $supported = false;
        if ($minPhpVersion == null) {
            $minVersionPhp = $this->_minPhpVersion;
        }
        if (version_compare($currentPhpVersion['version'], $minVersionPhp) >= 0) {
            $supported = true;
        }
        $phpStatus = [
            'full' => $currentPhpVersion['full'],
            'current' => $currentPhpVersion['version'],
            'minimum' => $minVersionPhp,
            'supported' => $supported
        ];
        return $phpStatus;
    }

    /**
     * Get current Php version information
     *
     * @return array
     */
    private static function getPhpVersionInfo()
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];
        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion
        ];
    }

    public function requirements()
    {
        $phpSupportInfo = $this->checkPHPversion(config('installer.core.minimumPhpVersion'));
        return view('Installer::requirements', compact('phpSupportInfo'));
    }
}
