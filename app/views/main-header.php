<!DOCTYPE html>
<html>

<head>
	<title><? echo $mv->seo->title; ?></title>
	<meta name="description" content="<? echo $mv->seo->description; ?>" />
	<meta name="keywords" content="<? echo $mv->seo->keywords; ?>" />
	<script type="text/javascript">
		var rootPath = "<? echo $mv->root_path; ?>";
	</script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.2/plyr.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="/media/css/styles.css">

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.2/plyr.js"></script>
	<!-- <script type="text/javascript" src="/js/script.js"></script> -->

	<? echo $mv->seo->displayMetaData("head"); ?>
</head>

<body class="d-flex flex-column min-vh-100">
	<div id="wrap">
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
				<div class="container-md">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="true" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarToggler">
						<a class="navbar-brand my-2" href="/videos">
							<img src="/media/images/logo/new_logo.svg" alt="Logo" height="32" class="d-inline-block align-text-top">
							Видеотека
						</a>
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="/">Главная</a>
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" href="#">О сервисе</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Выйти</a>
							</li>
						</ul>
						<form class="d-flex">
							<input class="form-control me-2" type="search" placeholder="Поиск по сайту.." aria-label="Search">
							<button class="btn btn-outline-success" type="submit">Искать</button>
						</form>
					</div>
				</div>
			</nav>
		</header>
		<main>
			<div class="container">