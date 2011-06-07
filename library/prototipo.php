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
  // arguments
  private $_args = array();

  // private function stack
  private $_private = array();

  // public function stack
  private static $_public = array();


  // constructor
  public function __construct()
  {
    $this->set(func_get_args());
  }

  // dynamic calls
  public function __call($method, $arguments = array())
  {
    if ($property = $this->$method)
    {
      if (is_callable($property))
      {
        array_unshift($arguments, $this);
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

  // public method callback
  public static function __callStatic($method, $arguments = array())
  {
    if ( ! isset(self::$_public[get_called_class()][$method]))
    {
      trigger_error(sprintf('%s method `%s` unavailable', get_called_class(), $method), E_USER_ERROR);
    }
    return call_user_func_array(self::$_public[get_called_class()][$method], $arguments);
  }

  // private method setter
  public function __set($key, $value = NULL)
  {
    $this->_private[$key] = $value;
  }

  // properties getter
  public function __get($key)
  {
    if (isset($this->_private[$key]))
    {
      $property = $this->_private[$key];
    }
    elseif (isset(self::$_public[get_called_class()][$key]))
    {
      $property = self::$_public[get_called_class()][$key];
    }
    elseif (isset(self::$_public[__CLASS__][$key]))
    {
      $property = self::$_public[__CLASS__][$key];
    }
    elseif (isset($this->$key))
    {
      $property = $this->$key;
    }
    else
    {
      trigger_error(sprintf('%s method `%s` unavailable', get_called_class(), $key), E_USER_ERROR);
    }
    return $property;
  }

  // raw output
  public function __toString()
  {
    return print_r($this->get(), TRUE);
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
    self::$_public[get_called_class()][$name] = $lambda;
  }

  /**
   * Assign arguments quietly
   *
   * @param  array     $arguments Array of arguments
   * @return Prototipo
   */
  public function set($arguments)
  {
    $this->_args = (array) $arguments;
    return $this;
  }

  /**
   * Returns the cached arguments
   *
   * @return array
   */
  public function get()
  {
    return $this->_args;
  }
}

/* EOF: prototipo.php */
