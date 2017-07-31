<?php

class View
{
    public $template_view; // здесь можно указать общий вид по умолчанию.
    public $helper; //functions for html formatting

    function __construct($template_view = null)
    {
        if($template_view == null)
            $template_view = "template_view.php";
        $this->template_view = $template_view;
        $this->helper = new Helper();
    }


    function render($data = null, $template_view = null)
    {

        if(is_array($data)) {
            extract($data);
        }

        if($template_view != null)
            $this->template_view = $template_view;

        include 'application/views/'.$this->template_view;
    }

    function widget($name)
    {
        $w = new $name();
        $w->execute();
    }


}
