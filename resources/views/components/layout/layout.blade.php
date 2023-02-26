<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="shop, store, ecommerce, e-commerce, Building, Materials, Building Materials, demand, constuction.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="David Nnachi">
	<meta name="description" content="Builder Supplier - your one stop shop for building materials on demand.">
	<title>{{ $title ?? 'Builder Supplier' }}</title>
	<link rel="canonical" href="https://'+{{env('APP_URL')}}+'/'" />
	<meta name="keywords" content="HTML, CSS, JavaScript">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen" style="-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-webkit-text-size-adjust:100%;-moz-text-size-adjust:100%;text-size-adjust:100%">
	<x-layout.header.header />
	<main class="relative flex-grow" style="min-height: -webkit-fill-available; -webkit-overflow-scrolling: touch">
		{{$slot}}
	</main>
	<footer>
	</footer>
	<MobileNavigation />
	<Search />
	{{-- <CookieBar
		title={t("text-cookies-title")}
		hide={acceptedCookies}
		action={
			<Button variant="slim">
				text-accept-cookies
			</Button>
		} --}}
	
</body>
</html>