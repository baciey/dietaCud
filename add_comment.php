<?php

//add_comment.php
session_start();

require "database/commentdatabase.php";

$error = '';
$comment_name = '';
$comment_content = '';





 













if(!isset($_SESSION['zalogowany']))
{
  if(empty($_POST["comment_name"]))
  {
   $error .= '<p class="text-danger">Imię jest wymagane</p>';
  }
  else
  {
    if(ctype_alnum($_POST["comment_name"])==false)
    {
     $error .= '<p class="text-danger">Imię może składać się tylko z liter i cyfr (bez polskich znaków) </p>';
    }
    else
    {
    	if((strlen($_POST["comment_name"])<0) || (strlen($_POST["comment_name"])>50))
    	{
       $error .= '<p class="text-danger">Imię musi posiadać od 1-50 znaków</p>';
      }
      else
      {
       $comment_name = $_POST["comment_name"];
      }
    }
  }
}
else
{
 $comment_name = $_SESSION["user"];
}

         if(empty(trim($_POST["comment_content"])))
         {
          $error .= '<p class="text-danger">Wpisz komentarz</p>';
         }
         else
         {
          if((strlen($_POST["comment_content"])<0) || (strlen($_POST["comment_content"])>1000))
          {
           $error .= '<p class="text-danger">Komentarz musi posiadać od 1-1000 znaków </p>';
          }
          else
          {
           $comment_content = $_POST["comment_content"];
            if($_POST['txtcode']!==$_SESSION['security_code'])
            {
              $error .= '<p class="text-danger">Niepoprawny kod</p>';
            }
          }
         }


    


    


if($error == '')
{
 $query = "
 INSERT INTO tbl_comment
 (parent_comment_id, comment, comment_sender_name, article_id) 
 VALUES (:parent_comment_id, :comment, :comment_sender_name, :article_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':comment_sender_name' => $comment_name,
   ':article_id' => $_SESSION['idz']
  )
 );
 $error = '<div class="komentarzDodany">Komentarz dodany</div>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>