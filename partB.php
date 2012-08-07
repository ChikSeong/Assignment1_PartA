<!--
   Web Database Applications Assignment1
-->
<html> 
   <head>
   <h3>Part B</h3>
   <?php
      
      function showError()
	  {
	     die("Error ". mysql_errno() . " : " .mysql_error());
	  }
	  
	  require 'db.php';
	  
	  if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW)))
	  {
         die("Could not connect");
      }
      if (!mysql_select_db(DB_NAME, $connection)) 
	  {
         showerror();
      }
   ?>
   </head>
   <body>
   <form action="result.php" method="GET">
      <table>
	  <tr>
         <td>Wine name: </td>
		 <td><input type="text" name="wineName" /></td>
      </tr>
	  <tr>
         <td>Winery name : </td>
		 <td><input type="text" name="wineryName" /></td>
      </tr>
	  <tr>
         <td>Region : </td>
		 <td>
		 <?php 
		     $regionSection = "SELECT region_name FROM region";
             if (!($result = @ mysql_query ($regionSection, $connection))) 
			 {
                showError();
	         }

		     echo '<select name="region">';
             while ($row = @ mysql_fetch_array($result))
             {
                echo '<option value="'.$row["region_name"].'">'.$row["region_name"].'</option>';
             }
             echo '</select>';
			  ?>
         </td>
      </tr>
	  <tr>
         <td>Grape variety : </td>
		 <td>
		 <?php
		    $grapeVariety = "SELECT variety FROM grape_variety";
			if (!($result2 = @ mysql_query ($grapeVariety, $connection)))
			{
			   showError();
			}
		    echo '<select name="grape_variety">';
			while ($row = @ mysql_fetch_array($result2))
			{
			   echo '<option value="'.$row["variety"].'">'.$row["variety"].'</option>';
			}
	        echo '</select>';
         ?>
         </td>
      </tr>
      <tr>
         <td>Range of Years : </td>
		 <td>
		 <?php
		    $rangeOfYears = "SELECT DISTINCT (year) FROM wine ORDER BY year ASC";
			if (!($result3 = @ mysql_query ($rangeOfYears, $connection)))
			{
			   showError();
			}
			echo '<select name="wine">';
	        while ($row = @ mysql_fetch_array($result3))
			{
			   echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
			}
		    echo '</select>';
         ?>
         </td>
      </tr>
      <tr>		   
         <td>Minimum number of wines in stock : </td>
		 <td><input type="text" name="numberStock" /></td>
      </tr>
	  <tr>
	     <td>Minimum number of wines ordered  : </td>
		 <td><input type="text" name="winesOrdered" /></td>
      </tr>
	  <tr>
	     <td>Dollar Range : </td>
		 <td><input type="text" name="minDollar"/> - 
	         <input type="text" name="maxDollar"/><br/>
         </td>
      </tr>
      <tr>
         <td></td>	  
         <td><input type="submit" value="Search"/></td>
      </tr>
      </table>	  
   </form>
   </body>
</html>

