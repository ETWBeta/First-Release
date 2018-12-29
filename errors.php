<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link href="animate.css" rel="stylesheet">
<?php  if (count($errors) > 0) : ?>
  <div class="animated shake delay-1s, error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><i class="fas fa-exclamation-circle"></i> <?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>


<style> 

.error {
	
    color: #FFF;
	width: 300px;
    padding: 6px 10px;
    border-radius: 20px;
    border: none;
    box-shadow: none;
    box-sizing: border-box;	
    font-family: 'Raleway', sans-serif;
    text-align: center;	
	font-size: 90%;
	outline: none;
    font-weight: bold;		
	font-family: Helvetica;	
	text-transform: uppercase;	
	
}

</style>