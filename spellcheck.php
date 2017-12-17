<?php
$sentence=$_POST["sentence"];
echo "$sentence<br><br><br>";
$n=str_word_count($sentence);
$i=0;
$j=0;
$k=0;
$m=0;
$check=explode(' ',$sentence);
$conn = mysqli_connect('localhost','root','','entries');
if(!$conn)
{
	die(mysqli_connect_error());
}
else
{
    while($i<$n)
    {
        $query1="select word, definition from entries where word='".$check[$i]."';";
	    $result1= mysqli_query($conn, $query1);
	    $row1= $result1->fetch_array();
        if ($result1->num_rows <= 0)
        {
            $word=$check[$i];
            echo "$word is not spelled correctly<br><br><br>";
            $m=strlen($word);
            $l=($m/2)+2;
            $part=substr($word,0,$l);
            echo "$part<br>";
            $query2="select distinct word from entries where word like '$part%';";
	        $result2= mysqli_query($conn, $query2);
            while($row2= $result2->fetch_array())
            {
                echo "$row2[word]<br>";
            }
            
        }
        else
        {
            echo " $check[$i] <br>Meaning : <br>";
             echo "$row1[definition]<br><br><br>";
        }
        $i++;
    }
}
mysqli_close($conn);
?>