<?php

 $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->resource_path($file);
       return $pdf;
        $text = $pdf->getText();
        return $text;
             
            // Source PDF file to extract text 
           



// $parser = new \Smalot\PdfParser\Parser(); 
 
// // Source PDF file to extract text 

// $file = $_FILES["file"]["tmp_name"]; 

// // Parse pdf file using Parser library 
// $pdf = $parser->parseFile($file); 
//  echo $pdf;
// // Extract text from PDF 
// $textContent = $pdf->getText();
//   echo $textContent;

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>PDF READER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2 style ="text-align: center; background:green; ">PDF READER</h2>
  <button type="submit" onclick="add_custom('add_file')" class="btn btn-success">Upload File</button>
  <div class="container" id="add_file" style="display:none;">
    <form action="{{url('send_pdf')}}" method="POST" >
        @csrf

        <div class="form-group ">
            <label for="">Upload Files</label>
            <input type="file"  class="form-control form-control-sm" name="file" id="task_name" >
        </div>
        <button type="submit" class="btn btn-default">Upload</button>

    </form>  
    
    
    
  </div>
  <form action="/action_page.php">
    <div class="form-group ">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Name:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter Name" name="pwd">
    </div>
    <div class="form-group">
        <label for="pwd">Gender:</label>
        <input type="text" class="form-control" id="pwd" placeholder="Enter Gender" name="pwd">
      </div>
    
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
 
</div>

<script>
    function add_custom(i) {
        document.getElementById(i).style.display = 'block';
    }
</script>
</body>
</html>
