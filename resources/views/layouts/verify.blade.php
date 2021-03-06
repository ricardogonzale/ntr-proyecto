
<!DOCTYPE html>
<html lang="en">
	<!--Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>NTR Good Deals</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://agenttechfinder.com" />
		<!--Fonts-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,700&display=swap" rel="stylesheet">
		<!-- Vendors Styles
		<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" /> -->
		<!--Global Theme Styles-->
		<link href="{{ asset('css/plugins.bundle.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet">
		<!--bootstrap tag inputs-->
		<link rel="stylesheet" href="https://newtransportrevolution.com/assets/css/bootstrap-tagsinput.css">
		
        <!--Favicon-->
		<link rel="shortcut icon" href="https://newtransportrevolution.com/assets/media/logos/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>
	<!--Body-->
    <?php 
    ?>
	<body id="kt_body" class="header-fixed header-mobile-fixed page-loading frontcliente login-singup brown">
		<div class="d-flex flex-column flex-root">
			<!--Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--Content-->
					<div class="content fondoregistrotransportista" id="kt_content" style="padding-top: 70px;">
                        @csrf
    <v-app id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </v-app>
</div>
					
					
					
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12 logofooter">
                <img src="https://newtransportrevolution.com/assets/img-ntr/logo-ntr-white.svg" width="160"/>
            </div>
            <div class="col-md-3 col-sm-12 footer-links">
                <a href="quienes-somos.html">Quienes somos</a>
                <a href="como-funciona-ntr.html">??C??mo funciona?</a>
                <a href="faqs.html">FAQs</a>
                <a href="contacto.html">Contacto</a>
            </div>
            <div class="col-md-3 col-sm-12 footer-links">
                <a href="#">Aviso legal</a>
                <a href="#">Pol??tica de privacidad</a>
                <a href="#">Condiciones de uso</a>
                <a href="#">Cookies</a>
            </div>
            <div class="col-md-3 col-sm-12 redes">
                <a href="#"><i class="la la-linkedin"></i></a>
                <a href="#"><i class="la la-whatsapp"></i></a>
                <a href="#"><i class="la la-instagram"></i></a>
                <a href="#"><i class="la la-facebook"></i></a>
            </div>
        </div>
    </div>
</footer>



</div>
</div>
</div>

<!-- Navegaci??n usuario -->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
<div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
<div class="offcanvas-close mt-n1 pr-5">
<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
    <i class="ki ki-close icon-xs text-muted"></i>
</a>
</div>
</div>
<div class="offcanvas-content pr-5 mr-n5">
<div class="d-flex align-items-center mt-5">
<div class="symbol symbol-100 mr-5">
    <div class="symbol-label" style="background-image:url('https://newtransportrevolution.com/assets/media/users/300_21.jpg')"></div>
</div>
<div class="d-flex flex-column">
    <a href="dashboard.html" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">Uno&Nueve</a>
    <div class="navi mt-2">
        <a href="user-profile.html" class="navi-item">
            <span class="navi-link p-0 pb-2">
                <span class="navi-text text-muted text-hover-primary">Edit Profile</span>
            </span>
        </a>
        <a href="index.html" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
    </div>
</div>
</div>
<div class="separator separator-dashed mt-8 mb-5"></div>
<div class="navi navi-spacer-x-0 p-0">
<a href="user-products.html" class="navi-item">
    <div class="navi-link">
        <div class="navi-text">
            <div class="font-weight-bold">My Products</div>
            <div class="text-muted">Manage your uploaded products
            <span class="label label-light-danger label-inline font-weight-bold">update</span></div>
        </div>
    </div>
</a>
<a href="user-invoices.html" class="navi-item">
    <div class="navi-link">
        <div class="navi-text">
            <div class="font-weight-bold">My Invoices</div>
            <div class="text-muted">All your activity on the platform</div>
        </div>
    </div>
</a>
<a href="user-newproduct.html" class="navi-item">
    <div class="navi-link">
        <div class="navi-text">
            <div class="font-weight-bold"><i class="icon-xl far fa-plus-square"></i> Add More Products</div>
            <div class="text-muted">Upload new services from your company</div>
        </div>
    </div>
</a>
</div>
<div class="separator separator-dashed my-7"></div>
<div>
<h5 class="mb-5">Pending validation</h5>
<div class="d-flex align-items-center bg-light-warning rounded p-5 gutter-b">
    <div class="d-flex flex-column flex-grow-1 mr-2">
        <a href="user-editproduct.html" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Product title</a>
        <span class="text-muted font-size-sm">Uploaded two days ago</span>
    </div>
    <span class="font-weight-bolder text-warning py-1 font-size-lg">80%</span>
</div>
<div class="d-flex align-items-center bg-light-warning rounded p-5 gutter-b">
    <div class="d-flex flex-column flex-grow-1 mr-2">
        <a href="user-editproduct.html" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Product title</a>
        <span class="text-muted font-size-sm">Uploaded two days ago</span>
    </div>
    <span class="font-weight-bolder text-warning py-1 font-size-lg">80%</span>
</div>
</div>
</div>
</div>
<!-- Men?? Principal-->
<div id="kt_quick_panel" class="offcanvas offcanvas-left pt-5 pb-10">
<div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-10">
<div class="offcanvas-close mt-n1 pr-5">
<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
    <i class="ki ki-close icon-md"></i>
</a>
</div>
</div>
<div class="offcanvas-content px-10">
<ul class="menu-ppal list-unstyled">
<li><a href="index.html">HOME</a></li>
<li><a href="list-transportistas.html">TRANSPORTISTAS</a></li>
<li><a href="list-pujas-publicas.html">PUJAS P??BLICAS</a></li>
<li><a href="como-funciona.html">COMO FUNCIONA</a></li>
<li><a href="tipos-mercancia.html">TIPOS DE MERCANC??A</a></li>
<li><a href="quienes-somos.html">QUIENES SOMOS</a></li>
<li><a href="contacto.html">CONTACTO</a></li>
</ul>
</div>
</div>
<div id="kt_scrolltop" class="scrolltop">
<span class="svg-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    <polygon points="0 0 24 0 24 24 0 24" />
    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
</g>
</svg>
</span>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/plugins.bundle.js') }}" defer></script>
<script src="https://newtransportrevolution.com/assets/js/scripts.bundle.js"></script>
<script src="https://newtransportrevolution.com/assets/js/bootstrap-tagsinput.min.js"></script>
<script src="https://newtransportrevolution.com/assets/js/pages/widgets.js"></script>
</body>
</html>
<!doctype html>
