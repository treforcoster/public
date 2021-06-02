<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;








class InstalledVersions
{
private static $installed = array (
  'root' =>
  array (
    'pretty_version' => 'dev-fastline/2.5.1',
    'version' => 'dev-fastline/2.5.1',
    'aliases' =>
    array (
    ),
    'reference' => '6d49575631d53d797aa95a0695fb42e9e7266ce7',
    'name' => 'incsub/wp-defender',
  ),
  'versions' =>
  array (
    'container-interop/container-interop' =>
    array (
      'pretty_version' => '1.2.0',
      'version' => '1.2.0.0',
      'aliases' =>
      array (
      ),
      'reference' => '79cbf1341c22ec75643d841642dd5d6acd83bdb8',
    ),
    'container-interop/container-interop-implementation' =>
    array (
      'provided' =>
      array (
        0 => '^1.0',
      ),
    ),
    'gettext/gettext' =>
    array (
      'pretty_version' => 'v4.8.4',
      'version' => '4.8.4.0',
      'aliases' =>
      array (
      ),
      'reference' => '58bc0f7f37e78efb0f9758f93d4a0f669f0f84a1',
    ),
    'gettext/languages' =>
    array (
      'pretty_version' => '2.6.0',
      'version' => '2.6.0.0',
      'aliases' =>
      array (
      ),
      'reference' => '38ea0482f649e0802e475f0ed19fa993bcb7a618',
    ),
    'incsub/wp-defender' =>
    array (
      'pretty_version' => 'dev-fastline/2.5.1',
      'version' => 'dev-fastline/2.5.1',
      'aliases' =>
      array (
      ),
      'reference' => '6d49575631d53d797aa95a0695fb42e9e7266ce7',
    ),
    'mnapoli/php-di' =>
    array (
      'replaced' =>
      array (
        0 => '*',
      ),
    ),
    'php-di/invoker' =>
    array (
      'pretty_version' => '1.3.3',
      'version' => '1.3.3.0',
      'aliases' =>
      array (
      ),
      'reference' => '1f4ca63b9abc66109e53b255e465d0ddb5c2e3f7',
    ),
    'php-di/php-di' =>
    array (
      'pretty_version' => '5.4.6',
      'version' => '5.4.6.0',
      'aliases' =>
      array (
      ),
      'reference' => '3f9255659595f3e289f473778bb6c51aa72abbbd',
    ),
    'php-di/phpdoc-reader' =>
    array (
      'pretty_version' => '2.1.1',
      'version' => '2.1.1.0',
      'aliases' =>
      array (
      ),
      'reference' => '15678f7451c020226807f520efb867ad26fbbfcf',
    ),
    'psr/container' =>
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' =>
      array (
      ),
      'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
    ),
    'psr/container-implementation' =>
    array (
      'provided' =>
      array (
        0 => '^1.0',
      ),
    ),
    'vlucas/valitron' =>
    array (
      'pretty_version' => 'v1.4.9',
      'version' => '1.4.9.0',
      'aliases' =>
      array (
      ),
      'reference' => '81515dcc951e1f636a1a18ece2f4154dfa123438',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}

if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}





private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {
foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}