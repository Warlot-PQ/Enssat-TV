<?php
error_reporting(!E_NOTICE);

class ini
{
  var $fichier="";
  var $groupe="";
  var $item="";
  var $valeur="";
  var $fichier_ini=array();
  
  function m_fichier($arg)
  {
     $this->fichier=$arg;
     $this->fichier_ini=null;
     $this->fichier_ini=array();

	  if(file_exists($arg) && $fichier_lecture=file($arg))
     {
       foreach($fichier_lecture as $ligne)
       {
         $ligne_propre=trim($ligne);
         if(preg_match("#^\[(.+)\]$#",$ligne_propre,$matches))
         {
           $groupe_curseur=$matches[1];
         }
         else
         {
           if($ligne_propre[0]!=';' && $tableau=explode("=",$ligne,2))
           {
             $this->fichier_ini[$groupe_curseur][$tableau[0]]=rtrim($tableau[1],"\n\r");
           }
         }
       }
     }
     $this->valeur=$this->fichier_ini[$this->groupe][$this->item];
  }
  function m_groupe($arg)
  {
     $this->groupe=$arg;
     $this->valeur=$this->fichier_ini[$this->groupe][$this->item];
     return true;
  }
  function m_item($arg)
  {
     $this->item=$arg;
     $this->valeur=$this->fichier_ini[$this->groupe][$this->item];
     return true;
  }
  function m_put($arg, $arg_i=false, $arg_g=false, $arg_f=false)
  {
     if($arg_f!==false) $this->m_fichier($arg_f);
     if($arg_g!==false) $this->m_groupe($arg_g);
     if($arg_i!==false) $this->m_item($arg_i);
     $this->fichier_ini[$this->groupe][$this->item]=$arg;
     $this->valeur=$arg;
     return $this->fichier." ==> [".$this->groupe."] ".$this->item."=".$this->valeur;
  }
  function m_count($arg_gr=false)
  {
     if($arg_gr===false)
     return array(1=>$gr_cou=count($this->fichier_ini), 0=>$itgr_cou=count($this->fichier_ini, COUNT_RECURSIVE), 2=>$itgr_cou-$gr_cou);
     else
     return count($this->fichier_ini[$arg_gr]);
  }
  function array_groupe($arg_gr=false)
  {
     if($arg_gr===false)
     $arg_gr=$this->groupe;
     return $this->fichier_ini[$arg_gr];
  }
  function save()
  {
     $fichier_save="";
     foreach($this->fichier_ini as $key => $groupe_n)
     {
         $fichier_save.="
[".$key."]";
         foreach($groupe_n as $key => $item_n)
         {
             $fichier_save.="
".$key."=".$item_n;
         }
     }
     $fichier_save=substr($fichier_save, 1);
     if(file_exists($this->fichier) && reset(explode('.',phpversion()))>=5)
     {
             if(false===file_put_contents($this->fichier, $fichier_save))
             {
                die("Impossible d'&eacute;crire dans ce fichier (mais le fichier existe).");
             }
     }
     else
     {
             $fichier_ouv=fopen($this->fichier,"w+");
             if(false===fwrite($fichier_ouv, $fichier_save))
             {
                die("Impossible d'&eacute;crire dans ce fichier (Le fichier n'existe pas).");
             }
             fclose($fichier_ouv);
     }
     return true;
  }
  function clear()
  {
      $this->fichier="";
      $this->groupe="";
      $this->item="";
      $this->valeur="";
      $this->fichier_ini=null;
      $this->fichier_ini=array();
  }
  function s_fichier()
  {
     $return=$this->fichier;
     if(file_exists($this->fichier)) unlink($this->fichier);
     $this->fichier="";
     $this->valeur="";
     return "fichier(".$return.") supprim&eacute;.";
  }
  function s_groupe()
  {
     $return=$this->groupe;
     if(isset($this->fichier_ini[$this->groupe])) unset($this->fichier_ini[$this->groupe]);
     $this->groupe="";
     $this->valeur="";
     return "groupe(".$return.") supprim&eacute;.";
  }
  function s_item()
  {
     $return=$this->item;
     if(isset($this->fichier_ini[$this->groupe][$this->item])) unset($this->fichier_ini[$this->groupe][$this->item]);
     $this->item="";
     $this->valeur="";
     return "item(".$return.") supprim&eacute;.";
  }
  function print_curseur()
  {
     echo "Fichier : <b>".$this->fichier."</b><br />";
     echo "Groupe : <b>".$this->groupe."</b><br />";
     echo "Item : <b>".$this->item."</b><br />";
     echo "Valeur : <b>".$this->valeur."</b><br />";
     return true;
  }
  function print_dossier()
  {
     if(is_dir($this->fichier)) {
     echo "<img src='dir.png' alt='Dossier' /><span style='position:relative; top:-10px;font-size:20px; font-weight:bold;'>".$this->fichier."</span><br />";
     if($handle=opendir($this->fichier))
     {
        while(false!==($file=readdir($handle)))
        {
            if(substr($file, -4, 4)==".ini")
            {
               echo "&nbsp;&nbsp;<a href='?fichier=".$file."'><img src='iniicone.png' alt='Ini' style='border:none;' /></a>&nbsp;".$file."<br />";
            }
        }
        closedir($handle);
     }
     return true; }
     else { echo "L'élément sélectionné n'est pas un dossier"; return false; }
  }
  function print_fichier()
  {
     if(file_exists($this->fichier) && is_file($this->fichier) && $fichier_lecture=file($this->fichier))
     {
       foreach($fichier_lecture as $ligne)
       {
         $ligne=preg_replace("#\s$#","",$ligne);
         if(preg_match("#^\[.+\]\s?$#",$ligne))
         $groupe=false;
         if(preg_match("#^\[".preg_quote($this->groupe, "#")."\]$#",$ligne))
         {
           $echo.= "<span style='background-color:aqua;'>".htmlspecialchars($ligne)."</span><br />";
           $groupe=true;
         }
         elseif($groupe==true && preg_match("#^(".$this->item."=)#",$ligne))
           $echo.= "<span style='background-color:yellow;'>".htmlspecialchars($ligne)."</span><br />";
         elseif($groupe==true && $this->item==reset(explode("=",$ligne)))
           $echo.= "<span style='background-color:yellow;'>".htmlspecialchars($ligne)."</span><br />";
         else
           $echo.= htmlspecialchars($ligne)."<br />";
       }
           echo $echo;
     }
     else
     {
       echo "Le fichier n'existe pas ou est incompatible";
     }
     $this->valeur=$this->fichier_ini[$this->groupe][$this->item];
     return true;
  }
  function m_valeur($arg_item, $arg_groupe)
  {
     return $this->fichier_ini[$arg_groupe][$arg_item];
  }
  
  
  function nbGroup()
  {
  	$nbGroup=0;
	foreach ($this->fichier_ini as $group) {
		$nbGroup++;
	}
	return $nbGroup;
  }
}
?>
