<?
/*
 * pop3.php
 *
 * @(#) $Header: /cvsroot/PHPlibrary/pop3.php,v 1.5 2001/07/09 01:07:26 mlemos Exp $
   
   蝭扬�: 
	$pop3_connection=new pop3_class;
	$pop3_connection->hostname=$POP3Server;


	if(($error=$pop3_connection->Open())=="")
	{
             print "Connect OK!";
             if(($error=$pop3_connection->Login($login_userid,$login_userpwd,$apop))==""){
                 print "撣唾�撖疯Ⅳ瑼ＸÏ甇Ⅱ!";
             }
             else { 
                 print "撣唾�撖疯Ⅳ瑼ＸÏ�航炊!";
             }
        }

 *
 */

class POP3
{
 var $hostname="";
 var $port=110;
 var $quit_handshake=0;

 /* Private variables - DO NOT ACCESS */

 var $connection=0;
 var $state="DISCONNECTED";
 var $greeting="";
 var $must_update=0;
 var $debug=0;

 /* Private methods - DO NOT CALL */

 function POP3($host)
 {
  $this->hostname = $host;	 
 }

 Function OutputDebug($message)
 {
  echo $message,"\n";
 }

 Function GetLine()
 {
  for($line="";;)
  {
   if(feof($this->connection))
    return(0);
   $line.=fgets($this->connection,100);
   $length=strlen($line);
   if($length>=2
   && substr($line,$length-2,2)=="\r\n")
   {
    $line=substr($line,0,$length-2);
    if($this->debug)
     $this->OutputDebug("< $line");
    return($line);
   }
  }
 }

 Function PutLine($line)
 {
  if($this->debug)
   $this->OutputDebug("> $line");
  return(fputs($this->connection,"$line\r\n"));
 }

 Function OpenConnection()
 {
  if($this->hostname=="")
   return("2 it was not specified a valid hostname");
  if($this->debug)
   $this->OutputDebug("Connecting to ".$this->hostname." ...");
  if(($this->connection=fsockopen($this->hostname,$this->port,$error))==0)
  {
   switch($error)
   {
    case -3:
     return("-3 socket could not be created");
    case -4:
     return("-4 dns lookup on hostname \"$hostname\" failed");
    case -5:
     return("-5 connection refused or timed out");
    case -6:
     return("-6 fdopen() call failed");
    case -7:
     return("-7 setvbuf() call failed");
    default:
     return($error." could not connect to the host \"".$this->hostname."\"");
   }
  }
  return("");
 }

 Function CloseConnection()
 {
  if($this->debug)
   $this->OutputDebug("Closing connection.");
  if($this->connection!=0)
  {
   fclose($this->connection);
   $this->connection=0;
  }
 }

 /* Public methods */

 /* Open method - set the object variable $hostname to the POP3 server address. */

 Function Open()
 {
  if($this->state!="DISCONNECTED")
   return("1 a connection is already opened");
  if(($error=$this->OpenConnection())!="")
   return($error);
  $this->greeting=$this->GetLine();
  if(GetType($this->greeting)!="string"
  || strtok($this->greeting," ")!="+OK")
  {
   $this->CloseConnection();
   return("3 POP3 server greeting was not found");
  }
  strtok("<");
  $this->must_update=0;
  $this->state="AUTHORIZATION";
  return("");
 }
 
 /* Close method - this method must be called at least if there are any
     messages to be deleted */

 Function Close()
 {
  if($this->state=="DISCONNECTED")
   return("no connection was opened");
  if($this->must_update
  || $this->quit_handshake)
  {
   if($this->PutLine("QUIT")==0)
    return("Could not send the QUIT command");
   $response=$this->GetLine();
   if(GetType($response)!="string")
    return("Could not get quit command response");
   if(strtok($response," ")!="+OK")
    return("Could not quit the connection: ".strtok("\r\n"));
  }
  $this->CloseConnection();
  $this->state="DISCONNECTED";
  return("");
 }

 /* Login method - pass the user name and password of POP account.  Set
     $apop to 1 or 0 wether you want to login using APOP method or not.  */

 Function Login($user,$password,$apop)
 {
  if($this->state!="AUTHORIZATION")
   return("connection is not in AUTHORIZATION state");
  if($apop)
  {
   if(!strcmp($this->greeting,""))
    return("Server does not seem to support APOP authentication");
   if($this->PutLine("APOP $user ".md5("<".$this->greeting.">".$password))==0)
    return("Could not send the APOP command");
   $response=$this->GetLine();
   if(GetType($response)!="string")
    return("Could not get APOP login command response");
   if(strtok($response," ")!="+OK")
    return("APOP login failed: ".strtok("\r\n"));
  }
  else
  {
   if($this->PutLine("USER $user")==0)
    return("Could not send the USER command");
   $response=$this->GetLine();
   if(GetType($response)!="string")
    return("Could not get user login entry response");
   if(strtok($response," ")!="+OK")
    return("User error: ".strtok("\r\n"));
   if($this->PutLine("PASS $password")==0)
    return("Could not send the PASS command");
   $response=$this->GetLine();
   if(GetType($response)!="string")
    return("Could not get login password entry response");
   if(strtok($response," ")!="+OK")
    return("Password error: ".strtok("\r\n"));
  }
  $this->state="TRANSACTION";
  return("");
 }

 /* Statistics method - pass references to variables to hold the number of
     messages in the mail box and the size that they take in bytes.  */

 Function Statistics($messages,$size)
 {
  if($this->state!="TRANSACTION")
   return("connection is not in TRANSACTION state");
  if($this->PutLine("STAT")==0)
   return("Could not send the STAT command");
  $response=$this->GetLine();
  if(GetType($response)!="string")
   return("Could not get the statistics command response");
  if(strtok($response," ")!="+OK")
   return("Could not get the statistics: ".strtok("\r\n"));
  $messages=strtok(" ");
  $size=strtok(" ");
  return("");
 }

 /* ListMessages method - the $message argument indicates the number of a
     message to be listed.  If you specify an empty string it will list all
     messages in the mail box.  The $unique_id flag indicates if you want
     to list the each message unique identifier, otherwise it will
     return the size of each message listed.  If you list all messages the
     result will be returned in an array. */

 Function ListMessages($message,$unique_id)
 {
  if($this->state!="TRANSACTION")
   return("connection is not in TRANSACTION state");
  if($unique_id)
   $list_command="UIDL";
  else
   $list_command="LIST";
  if($this->PutLine("$list_command $message")==0)
   return("Could not send the $list_command command");
  $response=$this->GetLine();
  if(GetType($response)!="string")
   return("Could not get message list command response");
  if(strtok($response," ")!="+OK")
   return("Could not get the message listing: ".strtok("\r\n"));
  if($message=="")
  {
   for($messages=array();;)
   {
    $response=$this->GetLine();
    if(GetType($response)!="string")
     return("Could not get message list response");
    if($response==".")
     break;
    $message=intval(strtok($response," "));
    if($unique_id)
     $messages[$message]=strtok(" ");
    else
     $messages[$message]=intval(strtok(" "));
   }
   return($messages);
  }
  else
  {
   $message=intval(strtok(" "));
   return(intval(strtok(" ")));
  }
 }

 /* RetrieveMessage method - the $message argument indicates the number of
     a message to be listed.  Pass a reference variables that will hold the
     arrays of the $header and $body lines.  The $lines argument tells how
     many lines of the message are to be retrieved.  Pass a negative number
     if you want to retrieve the whole message. */

 Function RetrieveMessage($message,$headers,$body,$lines)
 {
  if($this->state!="TRANSACTION")
   return("connection is not in TRANSACTION state");
  if($lines<0)
  {
   $command="RETR";
   $arguments="$message";
  }
  else
  {
   $command="TOP";
   $arguments="$message $lines";
  }
  if($this->PutLine("$command $arguments")==0)
   return("Could not send the $command command");
  $response=$this->GetLine();
  if(GetType($response)!="string")
   return("Could not get message retrieval command response");
  if(strtok($response," ")!="+OK")
   return("Could not retrieve the message: ".strtok("\r\n"));
  for($headers=$body=array(),$line=0;;$line++)
  {
   $response=$this->GetLine();
   if(GetType($response)!="string")
    return("Could not retrieve the message");
   switch($response)
   {
    case ".":
     return("");
    case "":
     break 2;
    default:
     if(substr($response,0,1)==".")
      $response=substr($response,1,strlen($response)-1);
     break;
   }
   $headers[$line]=$response;
  }
  for($line=0;;$line++)
  {
   $response=$this->GetLine();
   if(GetType($response)!="string")
    return("Could not retrieve the message");
   switch($response)
   {
    case ".":
     return("");
    default:
     if(substr($response,0,1)==".")
      $response=substr($response,1,strlen($response)-1);
     break;
   }
   $body[$line]=$response;
  }
  return("");
 }

 /* DeleteMessage method - the $message argument indicates the number of
     a message to be marked as deleted.  Messages will only be effectively
     deleted upon a successful call to the Close method. */

 Function DeleteMessage($message)
 {
  if($this->state!="TRANSACTION")
   return("connection is not in TRANSACTION state");
  if($this->PutLine("DELE $message")==0)
   return("Could not send the DELE command");
  $response=$this->GetLine();
  if(GetType($response)!="string")
   return("Could not get message delete command response");
  if(strtok($response," ")!="+OK")
   return("Could not delete the message: ".strtok("\r\n"));
  $this->must_update=1;
  return("");
 }

 /* ResetDeletedMessages method - Reset the list of marked to be deleted
     messages.  No messages will be marked to be deleted upon a successful
     call to this method.  */

 Function ResetDeletedMessages()
 {
  if($this->state!="TRANSACTION")
   return("connection is not in TRANSACTION state");
  if($this->PutLine("RSET")==0)
   return("Could not send the RSET command");
  $response=$this->GetLine();
  if(GetType($response)!="string")
   return("Could not get reset deleted messages command response");
  if(strtok($response," ")!="+OK")
   return("Could not reset deleted messages: ".strtok("\r\n"));
  $this->must_update=0;
  return("");
 }

 /* IssueNOOP method - Just pings the server to prevent it auto-close the
     connection after an idle timeout (tipically 10 minutes).  Not very
     useful for most likely uses of this class.  It's just here for
     protocol support completeness.  */

 Function IssueNOOP()
 {
  if($this->state!="TRANSACTION")
   return("connection is not in TRANSACTION state");
  if($this->PutLine("NOOP")==0)
   return("Could not send the NOOP command");
  $response=$this->GetLine();
  if(GetType($response)!="string")
   return("Could not NOOP command response");
  if(strtok($response," ")!="+OK")
   return("Could not issue the NOOP command: ".strtok("\r\n"));
  return("");
 }
};

?>

