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
   * Most methods take a set of options and are
   * modified using an options array
   *
   * UNIVERSAL DEFAULTS:
   *   ID     => ''   #id attribute of the element
   *   CLASS  => ''   #class attribute of the element
   *   NAME   => ''   #name attribute of the element
   *   TITLE  => ''   #title attribute of the element
   *   REL    => ''   #rel attribute of the element
   *
   */
  protected function _process_options($options = array()) {
    $_options = array('ID','CLASS','REL','TITLE','NAME','FOR','ACTION','METHOD');
    $data = '';
    foreach($options as $option => $value) {
      if (in_array(strtoupper($option), $_options)) {
        $data.= ' '.strtolower($option).'="'.$value.'"';
      }
    }
    return $data;
  }

  /**
   * HTML Document Helpers
   * =====================
   *
   * Methods to help create standard, compliant
   * and functional HTML documents
   *
   * Example:
   *     
   *    $html->begin_document('My Webpage');
   *    $html->end_document();
   *
   * Outputs:
   *
   *    <!DOCTYPE html>
   *    <html>
   *    <head>
   *    <title>My Webpage</title>
   *    </head>
   *    <body>
   *
   *    </body>
   *    </html>
   *
   */

  /**
   * begin_document([$title[,$css[,$js[,$meta]]]])
   *   $title - title of the document
   *   $css - array of css file names (without .css)
   *   $js - array of js file names (without .js)
   *   $meta - array of meta tags
   */
  function begin_document($title = '', $css = array(), $js = array(), $meta = array()) {
$data = <<<HTML
<!DOCTYPE html>
<html>
<head>
<title>$title</title>
HTML;
$data.= $this->includeCss($css);
$data.= $this->includeJs($js);
$data.= $this->includeMeta($meta);
$data.= <<<HTML
</head>
<body>
HTML;
    echo $data;
  }

  /**
   * end_document()
   */
  function end_document() {
echo <<<HTML
</body>
</html>
HTML;
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

  function includeMeta($meta = '') {

  }

  /**
   * link_to($text,$path[,$prompt[,$message[,$options]]])
   *   $text = <a>$text</a>
   *   $path = href value
   *   $prompt = javascript confirm box (defaults to false)
   *   $message = message of confirm box
   *   $options = univeral options array
   */
  function link_to($text, $path, $prompt = null, $message = "Are you sure?", $options = array()) {
    $option = $this->_process_options($options);
    $js = ($prompt) ? ' onclick="javascript:confirm(\'.$confirmMessage.\')"' : '';
    $data = "<a href=\"$path\"$option$js>$text</a>";
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
   *      $html->select_tag('foo[bar]',array('a','b','c'))
   *    );
   *    $html->make_form('foo',$elements);
   *
   * Outputs:
   *
   *    <form name="foo" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   *      <div>
   *        <select name="foo[bar]">
   *          <option value="0">a</option>
   *          <option value="1">b</option>
   *          <option value="2">c</option>
   *        </select>
   *      </div>
   *    </form>
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
    foreach($elements as $label => $element) {
      $data.= '<div>';
      if ($label)
        $data.= "<label>$label</label>";
      $data.= $element;
      $data.= '</div>';
    }
    $data.= "</form>";
    return $data;
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
   * submit_tag([$name[,$value[,$options]]])
   *   $name = name of the input tag
   *   $value = value of the element
   *   $options = universal options array
   */
  function submit_tag($name = '', $value = '', $options = array()) {
    $option = $this->_process_options($options);
    $data = "<input type=\"submit\" name=\"$name\" value=\"$value\"$option>";
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
}
?>