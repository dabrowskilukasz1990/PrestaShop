<?php
class Tekst extends Module {
                                                                                                
private $_html= '';
                                                                                                
function __construct() {
    $this->name = 'tekst';
    $this->tab = 'front';
    $this->version = '0.0.1';
    $this->author = 'Komijo.pl';
    parent::__construct();
    $this->displayName = $this->l('Wyświetlanie tekstu AmaniDelivery');
    $this->description = $this->l('Moduł dodaje tekst na stronie sklepu');
}
                                                                                                
public function install() {
    parent::install()&&
    $this->registerHook('displayProductButtons')
    && $this->registerHook('displaymyNewFooter') 
	&& $this->registerHook('displayLeftColumnProduct');
}

                                                                                                
public function getContent() {
                                                                                                
    if(Tools::isSubmit('submit_text')) {
                                                                                                
      Configuration::updateValue(
            $this->name.'_text_to_show',
              Tools::getValue('the_text')
              );                                                                             
    }
    if(Tools::isSubmit('submit_text2')) {
                                                                                                
      Configuration::updateValue(
            $this->name.'_text_to_show2',
              Tools::getValue('the_text2')
              );                                                                             
    }
                                                                                                
    $this->_generateForm();
    $this->_generateForm2();
    return $this->_html;
}
                                                                                                
private function _generateForm() {
                                                                                                
    $textToShow=Configuration::get($this->name.'_text_to_show');
                                                                        
    
    $this->_html .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">';
    $this->_html .= '<label>'.$this->l('Wprowadź swój tekst: ').'</label>';
    $this->_html .= '<div class="margin-form">';
    $this->_html .= '<input type="text" name="the_text" value="'.$textToShow.'" >';
    $this->_html .= '<input type="submit" name="submit_text" ';
    $this->_html .= 'value="'.$this->l('Zaktualizuj tekst').'" class="button" />';
    $this->_html .= '</div>';
    $this->_html .= '</form>';
}
private function _generateForm2() {
    $textToShow2=Configuration::get($this->name.'_text_to_show2');
                                                                                                
    $this->_html .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">';
    $this->_html .= '<label>'.$this->l('Wprowadź swój tekst 2: ').'</label>';
    $this->_html .= '<div class="margin-form">';
    $this->_html .= '<input type="text2" name="the_text2" value="'.$textToShow2.'" >';
    $this->_html .= '<input type="submit" name="submit_text2" ';
    $this->_html .= 'value="'.$this->l('Zaktualizuj tekst').'" class="button" />';
    $this->_html .= '</div>';
    $this->_html .= '</form>';
}
                                                                                                
public function hookdisplayProductButtons() {
                                                                                                
    global $smarty;
    $smarty->assign('our_text',Configuration::get($this->name.'_text_to_show'));
    return $this->display(__FILE__, 'tekst.tpl');
}
public function hookdisplayLeftColumnProduct() {
  global $smarty;
    $smarty->assign('our_text2',Configuration::get($this->name.'_text_to_show2'));
    return $this->display(__FILE__, 'tekst2.tpl');
}
public function hookdisplayMyNewFooter()
{
      return $this->hookdisplayProductButtons();
}

}
?>