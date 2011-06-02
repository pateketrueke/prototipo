<?php
/**
 * Prototipo
 *
 * Easily can be used through our scripts to achieve some extra
 * functionality against classical object inheritance
 */
 
/**
 * Prototypal class
 */
class Prototipo {
  /**#@+
   * @ignore
   */
  // singleton
  private static $_this = NULL;
  
  // arguments
  private static $_args = array();

  // function stack
  private static $_stack = array();


  // avoid constructor
  private function __construct()
  {
  }

  // avoid clonation
  private function __clone()
  {
  }

  // dynamic calls
  public function __call($method, $arguments = array())
  {
    if ($property = $this->$method)
    {
      if (is_callable($property))
      {
        if (($output = call_user_func_array($property, $arguments)) !== NULL)
        {
          return $output;
        }
      }
      else
      {
        array_unshift($arguments, $property);
        return $arguments;
      }
    }
    return $this;
  }

  // static calls
  public static function __callStatic($method, $arguments = array())
  {
    return self::instance()->__call($method, $arguments);
  }

  // properties setter
  public function __set($key, $value = NULL)
  {
    self::$_stack[$key] = $value;
  }

  // properties getter
  public function __get($key)
  {
    if ( ! isset(self::$_stack[$key]))
    {
      trigger_error(sprintf('%s method or property `%s` unavailable', get_called_class(), $key), E_USER_ERROR);
    }
    return self::$_stack[$key];
  }
  
  // raw output
  public function __toString()
  {
    return print_r(self::get(), TRUE);
  }
  /**#@-*/


  /**
   * Internal method definition
   *
   * @param  string $name   Name of the property
   * @param  mixed  $lambda Any callable value
   * @return Prototipo
   */
  public static function method($name, $lambda)
  {
    if ( ! is_callable($lambda))
    {
      trigger_error(sprintf('%s method `%s` must be callable', get_called_class(), $name), E_USER_ERROR);
    }
    self::instance()->$name = $lambda;
    return self::instance();
  }
  
  /**
   * Single instance from object
   *
   * @return Prototipo
   */
  public static function instance()
  {
    return is_null(self::$_this) ? self::$_this = new self : self::$_this;
  }

  /**
   * Asign arguments quietly
   *
   * @param  array     $arguments Array of arguments
   * @return Prototipo
   */
  public static function set($arguments)
  {
    self::$_args = (array) $arguments;
    return self::instance();
  }
  
  /**
   * Returns the cached arguments
   *
   * @return array
   */
  public static function get()
  {
    return self::$_args;
  }
}

/* EOF: prototipo.php */
