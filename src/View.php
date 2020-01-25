<?php

namespace Massfice\View;

use Smarty;

class View {
    private $smarty;
    private $data;

    private static $instance;

    private function __construct(string $template_dir, array $data) {
        $this->smarty = new Smarty();
        $this->smarty->template_dir = $template_dir;
        $this->data = $data;
    }

    public function getInstance(?string $template_dir = null, ?array $data = null) : self {
        if(!isset(self::$instance)) {
            self::$instance = new self($template_dir,$data);
        }

        return self::$instance;
    }

    public function generate(string $template, array $data = []) {
        foreach($this->data as $tk => $td) {
            if(is_string($tk)) {
                $this->smarty->assign($tk,$td);
            }
        }

        foreach($data as $k => $d) {
            if(is_string($k)) {
                $this->smarty->assign($k,$d);
            }
        }

        $this->smarty->display($template);
    }
}

?>