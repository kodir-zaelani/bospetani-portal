<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8" />
		<meta name    = "viewport" content = "width=device-width, initial-scale=1.0" />
        @stack('before-styles')
		<link href="{{asset('')}}front/css/output.css" rel="stylesheet" />
		<link href="{{asset('')}}front/css/main.css" rel="stylesheet" />
		@stack('after-styles')

	</head>
	@yield('content')
    @stack('before-scripts')

    @stack('after-scripts')
</html>
