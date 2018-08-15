<?php
//=====================================================================================
class db_functions
{		
	//user-defined constructor
	function db_functions()
	{
		// connects to database.		
		mysql_connect(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD) or die("Could not connect : " . mysql_error());
		mysql_select_db(DATABASE_NAME) or die("Could not select database <b>".DATABASE_NAME."</b>");
	}
	
	
	function InsertDB($field_names,$field_data,$tablename,$auto_increamentid)
	{
		$query = "INSERT INTO $tablename ($field_names[0]";	
	
		for($k=1;$k< count($field_names);$k++)
		{
			if ($field_data[$k] != "")
			{
				$query.=', '."$field_names[$k]";	
			}
		}
		$query.=") VALUES (\"$field_data[0]\"";
		for($k=1;$k< count($field_data);$k++)
		{
			if ($field_data[$k] != "")
			{
			$query.=', '."\"$field_data[$k]\""; 	
			}
		}	
		$query.=')';
                $query;
		
	   if (!($result =  mysql_query($query)))//$query is for the query
		{
			$mem .= "Error No: ".mysql_errno()."<BR>";
			$mem .=  "Error details: ".mysql_error();			
			$this->send_emails("<h4>$query<BR>$mem</h4>");			
			exit;
		}
		else
		{				
			$get_table_maxid=mysql_insert_id();
			return $get_table_maxid;
					
		}	
					
	}
	
	//¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦
	//Function Name : updateDB
	//purpose 		: To update the previous records in to the DB    <944>- ASCII
	//¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦
	function updateDB($field_names,$field_data,$tablename,$confld)
	{	
		
		$query="UPDATE $tablename SET $field_names[0]=\"$field_data[0]\"";
			
		for($k=1;$k< count($field_names);$k++)
		{
			 
			$query.=', '."$field_names[$k]=\"$field_data[$k]\"";
			 
		}
		$query.="  WHERE $confld ";		
		//echo "<br>".$query;	
	    if (!($result =  mysql_query($query)))//$query is for the query
		{
			$mem .= "Error No: ".mysql_errno()."<BR>";
			$mem .=  "Error details: ".mysql_error();
			$this->send_emails("<h4>$query<BR>$mem</h4>");
			exit;
		}
		else
		{
		$affrow=mysql_affected_rows();
		return $affrow;	
		}
			
	}
	
	function get_rsltset($mysql) //Retrieves a resultset based on the query
	{
	
		//    $result = mysql_query($mysql );
			if (!($result = mysql_query("$mysql")))//$mysql is for the query
			{
				$mem .= "Error No: ".mysql_errno()."<BR>";
				$mem .=  "Error details: ".mysql_error();
				$this->send_emails("<h4>$mysql<BR>$mem</h4>");
				exit;
			}
		else
			{
				$mysql_resultset = mysql_num_rows($result);
				//if($mysql_resultset>0)
				{				
					while ($row = mysql_fetch_array($result)) 
					{
					  $rsltset[] = $row;		
					}
				}
				
				mysql_free_result($result);
				return $rsltset;  
			}
	  
	}//function get_rsltset()
	//=====================================================================================
	
	//=====================================================================================
	function get_mysql_result($mysql) //Retrieves a resultset based on the query
	{
	
		//    $result = mysql_query($mysql );
			if (!($result = mysql_query("$mysql")))//$mysql is for the query
			{
				$mem .= "Error No: ".mysql_errno()."<BR>";
				$mem .=  "Error details: ".mysql_error();
				$this->send_emails("<h4>$mysql<BR>$mem</h4>");
				exit;
			}
		else
			{
				$mysql_resultset = mysql_result($result,0);			
				mysql_free_result($result);
				return $mysql_resultset;  
			}
	  
	}//function get_rsltset()
	//=====================================================================================
	
	//=====================================================================================
	function get_a_line($mysql )//Retrieves a single record based on the query
	{
			if (! ($result = mysql_query ("$mysql ")))
			{
				$mem .= "Error No: ".mysql_errno()."<BR>";
				$mem .=  "Error details: ".mysql_error();
				$this->send_emails("<h4>$mysql<BR>$mem</h4>");
				exit;
			}
			$num_rows=mysql_num_rows($result);
			if($num_rows>0)		
			$line = mysql_fetch_array($result);
			else
			$line=0;
			mysql_free_result ($result);
			return $line;
	}//function get_a_line()
	//=====================================================================================
	
	
	//====================================================================================
	function insert($mysql)
	{
		if (!(mysql_query($mysql)))//$mysql is for the query
		{
		    $mem .= "Error No: ".mysql_errno()."<BR>";
		    $mem .=  "Error details: ".mysql_error();
		    $this->send_emails("<h4>$mysql<BR>$mem</h4>");
		    exit;

		}
		else
		{
		    $get_table_maxid=mysql_insert_id();
		    return $get_table_maxid;
		}
	}//function insert()
    
    function db_query($mysql)
    {        
        $result = mysql_query($mysql);
        if (!$result)//$mysql is for the query
        {
            $mem .= "Error No: ".mysql_errno()."<BR>";
            $mem .=  "Error details: ".mysql_error();
            $this->send_emails("<h4>$mysql<BR>$mem</h4>");
            exit; 
        }
	
        return $result;
    }
    function db_next_autoid($result)
    {
        //$result = $connect_DB->db_query($mysql);  
        if(!$result)
        {
            $mem .= "Error No: ".mysql_errno()."<BR>";
            $mem .=  "Error details: ".mysql_error();
            $this->send_emails("<h4>$mysql<BR>$mem</h4>");
            exit;
        }
        else if($result)
        {
            $r=mysql_insert_id();
        }
        return $r;

    }
      
    function db_fetch_array($result,$sql='') 
    {
        //$result = $connect_DB->db_query($result);  
          if ($result) 
          {
            return mysql_fetch_array($result, MYSQL_ASSOC);
          }
          else
          {          
                $mem .= "Error No: ".mysql_errno()."<BR>";
                $mem .=  "Error details: ".mysql_error();
                $this->send_emails("<h4>$sql<BR>$mem</h4>");
                exit;
          }
          echo $sql;
          
    }
    function db_fetch_assoc($result)
    {
        //$result = $connect_DB->db_query($result);
          if ($result)
          {
            return mysql_fetch_assoc($result);
          }
          else
          {
                $mem .= "Error No: ".mysql_errno()."<BR>";
                $mem .=  "Error details: ".mysql_error();
                $this->send_emails("<h4>$sql<BR>$mem</h4>");
                exit;
          }
          echo $sql;

    }

    
	//===================================================================================
	
	
	//===================================================================================
	function mysql_nurows($mysql)
	{
	$result = mysql_query("$mysql");
		if(!$result)
		{
			$mem .= "Error No: ".mysql_errno()."<BR>";
			$mem .=  "Error details: ".mysql_error();
			$this->send_emails("<h4>$mysql<BR>$mem</h4>");
			exit;
		}
		else if($result)
		{
		$r=mysql_num_rows($result);
		}
		return $r;
	
	}//end insert data id
    
    function db_num_rows($result,$mysql='')
    {
        if(!$result)
        {
            $mem .= "Error No: ".mysql_errno()."<BR>";
            $mem .=  "Error details: ".mysql_error();
            $this->send_emails("<h4>$mysql<BR>$mem</h4>");
            exit;
        }
        else if($result)
        {
        $r=mysql_num_rows($result);
        }
        return $r;

    }//end numrowa

	//====================================================================================
	
	
	
	//====================================================================================
	function get_single_column($mysql)
	{
			$x = 0;
			$result = mysql_query($mysql);
			$affrow=mysql_affected_rows(); 
			if($affrow>0)
			{
				while ( $row = mysql_fetch_array($result) ) 
				{
					$q[$x] = $row[0];
					$x++;
				}
				mysql_free_result ($result);
			}	
			
			return $q;
	
		//access using $q[1]["fieldname"] or $q[1][3] etc
	}

	function send_emails($errormessage)
	{
	# Common Headers 
	$headers  = 'MIME-Version: 1.0' . $eol;
	$headers .= 'Content-type: text/plain; charset=iso-8859-1' .$eol;
	
	$headers .= 'From: '.COMPANY.' <'.EMAIL_FROM.'>'.$eol; 
	$headers .= 'Reply-To: '.COMPANY.' <'.EMAIL_FROM.'>'.$eol; 
	$headers .= "X-Mailer: PHP v".phpversion().$eol;          // These two to help avoid spam-filters 
	# Boundry for marking the split & Multitype Headers 
	$mime_boundary=md5(time()); 
	$num = time();
	//echo $num;
	$body = "Error Details : ".$errormessage.$eol.$eol."<BR>";
	//$body = "<span class = tx_nor_error_12>A database error has occurred.  Please contact your system administrator. <BR>".$errormessage."</span><br>";
	echo $body;
	$body .= "File Name : ".$_SERVER['PHP_SELF'].$eol.$eol."<BR>";
	$body .= "Error Time : ".date('d-m-Y').$eol.$eol."<BR>";
	//mail('pkumar125@gmail.com',COMPANY.' Query_error',$body,$headers);
	}
	
	function change_TO_YYYYMMDD($dateformat)
	{			 
		list($month,$day,$year) = split ('[/.-]', $dateformat); 
		$new=$year."-".$month."-".$day; 
		return $new;
	}
	function change_TO_DDMMYYYY($dateformat)
	{
		$new="";
		$dateformat = substr($dateformat,0,-9);
		//$dateformat = $dateformat[0];
		if($dateformat != '')
		{
			//echo('date '.  $dateformat);
			list($year, $month, $day,$h,$m,$s) = split('[/.-]',$dateformat); 
			$new=$month."/".$day."/".$year;
			//date("F Y", mktime(0, 0, 0, 12, 0, 2005));
 
		}
        return $new;
	}
	
	function change_TO_MM_DD_YYYY($dateformat)
	{
	$starting_year = substr($dateformat,0,4);
	$starting_month = substr($dateformat,5,2);
	$starting_day = substr($dateformat,8,2);
	$first_of_month = gmmktime(0,0,0,$starting_month,$starting_day,$starting_year); 
	list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%y,%b,%w',$first_of_month));
	return $starting_day." ".$month_name.", ".$starting_year;
	}
	
	function change_TO_MMDDYYYY($dateformat) 
	{			  
		list($year,$month,$day) = split ('[/.-]', $dateformat);  
		$new=$month."-".$day.'-'.$year;  
		return $new; 
	}
	
	 

}

function page_custom_pagination($npurl,$page,$totalrows,$limit,$extra_arg='')
{
    $category = $npurl;
    $content = "";
    $broj_strana = ceil($totalrows / $limit);
    $extra_arg= $extra_arg;
    
    if ($broj_strana > 0)
    {
        $content = "<ul class='pager'>";
        $pre = $page-1;
        if ($page!=1)
        {
            if ($broj_strana > 5)
                $content .= "<li class='pager-first first'><a href=\"".HTTP_BASE.$category."?page=1".$extra_arg."\" title='Go to first page'>&laquo;&nbsp;first</a></li>";
            if ($broj_strana > 0)
                $content .= "<li class='pager-previous'><a href=\"".HTTP_BASE.$category."?page=$pre".$extra_arg."\"  title='Go to previous page' class='listActive'>&lsaquo;&nbsp;previous</a></li>";
        }
        $poc = 1;
        while ($poc > 0)
        {
            if ($page >= $poc && $page <= ($poc+4)) { $granica = $poc; $poc = -1; }
            else $poc++;
        }
        $brojac=0;
        for ($i=$granica; $i <= $broj_strana; $i++)
        {
            if ($i==$page) $content .= "<li class='pager-current'>$i</li>";
            else $content .= "<li class='pager-item'><a href=\"".HTTP_BASE.$category."?page=".$i.$extra_arg."\" title='Go to page ".$i."' class='listActive'>".$i."</a></li>";
            $brojac++;
            if ($brojac==5) break;
        }
        $nar = $page+1;
        if ($page!=$broj_strana)
        {
            if ($broj_strana > 0)
                $content .= "<li class='pager-next'><a href=\"".HTTP_BASE.$category."?page=$nar$extra_arg\" title='Go to next page' class='listActive'>next&nbsp;&rsaquo;</a></li>";
            if ($broj_strana > 5)
                $content .= "<li class='pager-last last'><a href=\"".HTTP_BASE.$category."?page=$broj_strana$extra_arg\" title='Go to last page' class='listActive'>last&nbsp;&raquo;</a></li>";
        }
        $content .= "</ul>";
    }
    return $content;
}
function utf8_strlen($str)
{
    $count = 0;
    for ($i = 0; $i < strlen($str); ++$i)
    {
        if ((ord($str[$i]) & 0xC0) != 0x80)
        {
            ++$count;
        }
    }
    return $count;
}
function utf8_substr($str,$from,$len)
{
    return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                       '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                       '$1',$str);
}

function IsecakPoruke($poruka,$limit,$allow,$link="")
{
    //skidam tagove
    $poruka = strip_tags($poruka,$allow);
    //echo $poruka;
    //die();
    $duzina = utf8_strlen($poruka);
    //echo utf8_strlen($poruka);
    
    if ($duzina > $limit)
    {
        if (substr_count($poruka," ")>0)
        {
            for ($i=$limit; $i >= 0; $i--)
            {
                if (substr($poruka,($i-1),1)==" ")
                //if (substr($poruka,($i-1),1)==" ")
                {
                    $vrati = substr($poruka,0,($i-1));
                    //$vrati = substr($poruka,0,($i-1));
                    if($link)
                        return $vrati."...<a href='".$link."' style='color:#660099;'>More</a>";
                    else    
                    return $vrati."...";
                    $nadjeno=true;
                    break;
                }
            }
        }
        else
        {
            $vrati = utf8_substr($poruka,0,$limit);
            //$vrati = substr($poruka,0,$limit);
            if($link)
                return $vrati."...<a href='".$link."' style='color:#660099;'>More</a>";
            else 
            return $vrati."...";
        }
    }
    else{
        if($link){
            return $poruka."...<a href='".$link."' style='color:#660099;'>More</a>";
        } else {
            return $poruka;
        }
    }
}

?>