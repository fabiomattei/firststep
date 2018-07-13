<?php

namespace Firststep\Common\Blocks;

use Firststep\Common\Blocks\BaseBlock;

class BaseInfo extends BaseBlock {

    private $title;
    private $subtitle;

    function __construct() {
        $this->body = '';
    }
	
	function setTitle( string $title ) {
		$this->title = $title;
	}
	
	function setSubTitle( string $subTitle ) {
		$this->subTitle = $subTitle;
	}

    function show(): string {
        $out = '<h3>' . $this->title . '</h3>';
        if ( $this->subtitle != '' ) {
            $out .= '<p>' . $this->subtitle . '</p>';
        }
        $out .= $this->body;
        return $out;
    }

    function addTextField( string $label, string $value, string $width ) {
        $this->body .= '<div class="'.$width.'"><h5>'.$label.'</h5><p>'.$value.'</p></div>';
    }

    function addTextAreaField( string $label, string $value, string $width ) {
        $this->body .= '<div class="'.$width.'"><h5>'.$label.'</h5><p>'.$value.'</p></div>';
    }

    function addDropdownField( string $name, string $label, array $options, string $value, string $width ) {
        $this->body .= '<div class="'.$width.'"><h5>'.$label.'</h5><p>';
        foreach ($options as $key => $val) {
            $this->body .= ( $key==$value ? $val : '' );
        }
        $this->body .= '</p></div>';
    }
	
	function addCurrencyField( string $label, string $value, string $width ) {
		$this->body .= '<div class="'.$width.'"><h5>'.$label.'</h5><p>'.$value.'</p></div>';
	}
	
	function addDateField( string $label, string $value, string $width ) {
		$this->body .= '<div class="'.$width.'"><h5>'.$label.'</h5><p>'.date( 'd/m/Y', strtotime($value) ).'</p></div>';
	}

    function addFileUploadField( string $name, string $label, string $width ) {
        $this->body .= '<div class="'.$width.'"><label for="'.$name.'">'.$label.'</label><input type="file" id="'.$name.'" name="'.$name.'"></div>';
    }

    function addHelpingText( string $title, string $text, string $width ) {
        $this->body .= '<div class="'.$width.'"><h5>'.$title.'</h5><p>'.$text.'</p></div>';
    }
	
	function addRow() {
		$this->body .= '<div class="row">';
	}
	
	function closeRow( string $comment = '' ) {
		$this->body .= '</div>  <!-- '.$comment.' -->';
	}

}
