<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>404 Page Not Found</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style>
		div.logo {
			height: 200px;
			width: 155px;
			display: inline-block;
			opacity: 0.08;
			position: absolute;
			top: 2rem;
			left: 50%;
			margin-left: -73px;
		}
		body {
			height: 100%;
			background: #fafafa;
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			color: #777;
			font-weight: 300;
		}
		h1 {
			font-weight: lighter;
			letter-spacing: 0.8;
			font-size: 3rem;
			margin-top: 0;
			margin-bottom: 0;
			color: #222;
		}
		.wrap {
			max-width: 1024px;
			margin: 5rem auto;
			padding: 2rem;
			background: #fff;
			text-align: center;
			border: 1px solid #efefef;
			border-radius: 0.5rem;
			position: relative;
		}
		pre {
			white-space: normal;
			margin-top: 1.5rem;
		}
		code {
			background: #fafafa;
			border: 1px solid #efefef;
			padding: 0.5rem 1rem;
			border-radius: 5px;
			display: block;
		}
		p {
			margin-top: 1.5rem;
		}
		.footer {
			margin-top: 2rem;
			border-top: 1px solid #efefef;
			padding: 1em 2em 0 2em;
			font-size: 85%;
			color: #999;
		}
		a:active,
		a:link,
		a:visited {
			color: #dd4814;
		}
	</style>
</head>
<body>
	<div class="wrap">
		<h1>404 - File Not Found</h1>

		<p>
			<?php if (! empty($message) && $message !== '(null)') : ?>
				<?= nl2br(esc($message)) ?>
			<?php else : ?>
				Sorry! Cannot seem to find the page you were looking for.
			<?php endif ?>
			<br><br>
			<a class="btn btn-primary text-white" href="<?php echo base_url('FAH')?>">Go Home</a>
		</p>
	</div>
</body>
</html>
