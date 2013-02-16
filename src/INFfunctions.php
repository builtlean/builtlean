<?php
function INFdsQuery($AppName,$inftable,$infquery,$infreturnFields){
      $infApp = new iSDK;

      if(!$infApp->cfgCon($AppName)){
        die("Failed to connect to Infusionsoft!");
      }


      $infrecords = 1000;
      $infpage = 0;
      $infcontacts = $infApp->dsQuery($inftable,$infrecords,$infpage,	  $infquery,$infreturnFields);
      while(count($infcontacts)){
        foreach($infcontacts as $infcontact){
          $myinfcontacts[]=$infcontact;
        }
        $infpage++;
        $infcontacts = $infApp->dsQuery($inftable,$infrecords,$infpage,  $infquery,$infreturnFields);
      }

      unset($infApp);

      return $myinfcontacts;
    }
	
?>