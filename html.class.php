<?php
/**
 * @package
 *
 * @author Thomas Lackemann
 *
 * Adapted from tenantmls-php
 * https://github.com/tlackemann/tenantmls-php
 *  
 */

class HTML {

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

  function formSelect($name = null, $values = array(), $selected = null, $id = null, $class = null) {
    if ($name) $displayName = ' name="'.$name.'"'; else $displayName = '';
    if ($id) $displayId = ' id="'.$id.'"'; else $displayId = '';
    if ($class) $displayClass = ' class="'.$class.'"'; else $displayClass = '';

    $data = '<select'.$displayName.$displayId.$displayClass.'>';
    foreach($values as $value => $name) {
      if ((string) $value==(string) $selected) {
        $data.= '<option value="'.$value.'" selected >'.$name.'</option>';
      } else {
        $data.= '<option value="'.$value.'">'.$name.'</option>';
      }
    }
    $data.= '</select>';

    return $data;
  }

  function formInput($type = 'text', $name = null, $value = null, $size = null, $id = null, $class = null) {
    if ($name) $displayName = ' name="'.$name.'"'; else $displayName = '';
    if ($id) $displayId = ' id="'.$id.'"'; else $displayId = '';
    if ($class) $displayClass = ' class="'.$class.'"'; else $displayClass = '';
    if ($value) $displayValue = ' value="'.$value.'"'; else $displayValue = '';
    if ($size) $displaySize = ' size="'.$size.'"'; else $displaySize = '';

    $data = "<input type=\"$type\"$displayName$displayId$displayClass$displayValue$displaySize />";
    return $data;
  }
}
?>
