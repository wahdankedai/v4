<?php
class PDF extends PDFTable{
	
function PDF($orientation='L',$unit='mm',$format=array(215,330)){
	PDFTable::PDFTable($orientation,$unit,$format);
	$this->SetFont('helvetica');
	$this->SetFontSize(5);
	/*$this->AddFont('vni_times', 'B');
	$this->AddFont('vni_times', 'I');
	$this->AddFont('vni_times', 'BI');
	$this->AddFont('vni_helve', 'B');*/
	$this->SetAuthor('Alex');
	$this->AliasNbPages();
	
}

function Header($data){
	//parent::Header();
	$this->x = $this->left;
	$this->y = $this->top-$this->getLineHeight()-1.5;
	$html = "
	<table width=$this->width><tr>
			<td align=right>Printed by Simoneva Kota Mojokerto</td>	
	</tr></table>
	";
	$this->htmltable($html,0);
	$this->y = $this->top;
}

function Footer(){
	$this->x = $this->left;
	$this->y = $this->bottom+1.5;
	$time = date('d F Y h:m:s');
	$page = 'Page '.$this->PageNo().'/{nb}';
		
	$html = "
	<table width=$this->width>
	<tr>
		<td align=left> Date Print : ".$time."</td>	
		<td align=right nowrap>$page</td>
	</tr></table>
	";
	$this->hr();
	$this->htmltable($html,0);
}


function setStyle($style='normal'){
	switch ($style){
		case 'title':
			$this->SetFont('helvetica','',19);
			break;
		case 'small':
			$this->SetFont('helvetica','',8);
			break;
		case 'normal':
		default:
			$this->SetFont('helvetica','',10);
	}
}

function text($w,$txt,$border=0,$align='J',$fill=0){
	FPDF::MultiCell($w,$this->FontSizePt/2,$txt,$border,$align,$fill);
}



function hr(){
	$this->Line($this->left,$this->y,$this->right,$this->y);
}



/**
 * @return array
 * @desc Xac dinh kich thuoc cac cot tuong ung voi data
 */
function _getColumnSize($data, $size=array()){
	if (is_array(current($data))){
	    foreach($data as $row){
	    	foreach ($row as $i=>$txt){
	    		$wtxt = $this->GetStringWidth($txt)+2;
	    		if (!isset($size[$i]) || $size[$i] < $wtxt) $size[$i] = $wtxt;
	    	}
	    }
	}elseif (is_array($data)){
    	foreach ($data as $i=>$txt){
    		$wtxt = $this->GetStringWidth($txt)+2;
    		if (!isset($size[$i]) || $size[$i] < $wtxt) $size[$i] = $wtxt;
    	}
	}
	return $size;
}
}//end of class