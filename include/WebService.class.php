<?
class WebService
{
  function isPasswordValid($id, $password)
  {
    $valid = 0;
    
    if(strlen($id) && strlen($password))
    {
      // SPARC Testing
      include_once (ROOT_PATH."/include/pop3.class.php");
      $pop3 = new POP3("cc.ncu.edu.tw");

      if($pop3->Open() == "" && $pop3->Login($id,$password,0)=="")
	return 1;

      return 0;
    }
  }
}
?>

