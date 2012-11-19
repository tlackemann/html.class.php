<?php
/**
 * @package html.class.php
 *
 * @author Thomas Lackemann
 *
 * Originally adapted from tenantmls-php
 * https://github.com/tlackemann/tenantmls-php
 *  
 */

class HTML {

  /**
   * Universal Options
   * =================
   * 
   * Most elements take a set of options and are
   * modified using an options array
   *
   * DEFAULTS:
   *   ID     => ''   #id attribute of the element
   *   CLASS  => ''   #class attribute of the element
   *   NAME   => ''   #name attribute of the element
   *   TITLE  => ''   #title attribute of the element
   *   REL    => ''   #rel attribute of the element
   *
   */
  protected function _process_options($options = array()) {
    $_options = array('ID','CLASS','REL','TITLE','NAME','FOR');
    $data = '';
    foreach($options as $option => $value) {
      if (in_array(strtoupper($option), $_options)) {
        $data.= ' '.strtolower($option).'="'.$value.'"';
      }
    }
    return $data;
  }

  /**
   * show_php_errors()
   * displays any non-fatal errors (set false for live environment)
   */
  function show_php_errors($option = false) {
    if ($option) {
      error_reporting(E_ALL);
      ini_set('display_errors', '1');
    }
  }

  function link_to($text, $path, $class = '', $id = '', $prompt = null,$confirmMessage = "Are you sure?") {
    $path = str_replace(' ','+',$path);
    
    $html = '';
    $html.= (!empty($id)) ? ' id="'.$id.'"' : '';
    $html.= (!empty($class)) ? ' class="'.$class.'"' : '';

    if ($prompt) {
      $data = '<a href="javascript:void(0);" onclick="javascript:confirm(\'.$confirmMessage.\')">'.$text.'</a>';
    } else {
      $data = '<a href="'.$path.'"'.$html.'>'.$text.'</a>';	
    }
    return $data;
  }

  function includeJs($fileArray) {
    $data = '';
    foreach($fileArray as $fileName) {
      $data.= '<script src="javascripts/'.$fileName.'.js"></script>'; 
    }  
    return $data;
  }

  function includeCss($fileArray) {
    $data = ''; 
    foreach($fileArray as $fileName) {
      $data.= '<link rel="stylesheet" type="text/css" media="screen" href="stylesheets/'.$fileName.'.css" />';
    }  
    return $data;
  }

  /**
   *
   * Form Helpers
   * ============
   *
   * Example:
   *
   *    $elements = array(
   *      $html->select_list('element',array('a','b','c'))
   *    );
   *    $html->make_form('name',$elements);
   *
   * Outputs:
   *
   *    <form name="name" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   *      <select name="element">
   *        <option value="0">a</option>
   *        <option value="1">b</option>
   *        <option value="2">c</option>
   *      </select>
   *    </form>
   *
   */

  /**
   * make_form([$name[,$elements[,$options]]])
   *   $name = name of the form
   *   $elements = array containing the HTML of each element
   *   $options = universal options array
   */
  function make_form($name = '', $elements = array(), $options = array()) {
    $option = $this->_process_options($options);
    $data = "<form name=\"$name\"$option>";
    $data.= "</form>";
    return $form;
  }

  /**
   * select_tag([$name[,$elements[,$selected[,$options]]]])
   *   $name = name of the select tag
   *   $elements = array containing the HTML of each element
   *   $selected = index of the selected element
   *   $options = universal options array
   */
  function select_tag($name = '', $elements = array(), $selected = false, $options = array()) {
    $option = $this->_process_options($options);
    $data = "<select name=\"$name\"$option>";
    foreach($elements as $k => $v) {
      $s = ($selected == $k) ? ' selected="selected"' : '';
      $data.= "<option value=\"$k\"$s>$v</option>";
    }
    $data.= '</select>';
    return $data;
  }

  /**
   * text_tag([$name[,$value[,$options]]])
   *   $name = name of the input tag
   *   $value = value of the element
   *   $options = universal options array
   */
  function text_tag($name = '', $value = '', $options = array()) {
    $option = $this->_process_options($options);
    $data = "<input type=\"text\" name=\"$name\" value=\"$value\"$option>";
    return $data;
  }
  /**
   * checkbox_tag([$name[,$value[,$label[,$options]]])
   *   $name = name of the input tag
   *   $value = value of the element
   *   $label = value of the label (default is blank)
   *   $options = universal options array
   */
  function checkbox_tag($name = '', $value = '', $label = '', $options = array()) {
    $option = $this->_process_options($options);
    $data = "<input type=\"checkbox\" name=\"$name\" value=\"$value\"$option>";
    $data.= ($label) ? "<label for=\"$name\">$label</label>" : '';
    return $data;
  }
}
?>