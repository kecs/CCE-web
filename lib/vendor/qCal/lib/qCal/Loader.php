<?php

/**
 * qCal_Loader
 * Loads files from the file system. Looks through the entire include path
 */
class qCal_Loader
{

  /**
   * Load a class
   */
  static public function loadClass($name)
  {

    $path = str_replace("_", DIRECTORY_SEPARATOR, $name) . ".php";
    return self::loadFile($path);
  }

  /**
   * Loads a file or throws an exception
   */
  static public function loadFile($filename)
  {
    $path = realpath(dirname(__FILE__) . '/../') . "/{$filename}";
    if (file_exists($path)) {
      require_once $path;
    }
    
  }

}