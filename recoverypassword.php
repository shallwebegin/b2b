<?php
define('security',true);

require_once 'inc/header.php'; 

if( @$_SESSION['login'] == @sha1(md5(IP().$bcode)) ){
    go(site);
}


$code = get('code');
if(!$code){
	go(site);
}

$brow = $db->prepare("SELECT bayikodu,bayimail,sifirlamakodu FROM bayiler WHERE sifirlamakodu=:k");
$brow->execute([':k' => $code]);
if($brow->rowCount() < 1){
	go(site);
}

?>

<!-- WRAPPER START -->
<div class="wrapper bg-dark-white">

<!-- HEADER-AREA START -->
<?php require_once 'inc/menu.php'; ?>

<!-- HEADER-AREA END -->
<!-- Mobile-menu start -->
<?php require_once 'inc/mobilemenu.php'; ?>

<!-- Mobile-menu end -->
<!-- HEADING-BANNER START -->
<div class="heading-banner-area overlay-bg" style="background: rgba(0, 0, 0, 0) url(<?php echo site;?>/uploads/general.webp) no-repeat scroll center center / cover;">
<div class="container">
<div class="row">
<div class="col-md-12">
	<div class="heading-banner">
		<div class="heading-banner-title">
			<h2>GİRİŞ / KAYIT</h2>
		</div>
		<div class="breadcumbs pb-15">
			<ul>
				<li><a href="<?php echo site;?>">ANA SAYFA</a></li>
				<li>GİRİŞ / KAYIT</li>
			</ul>
		</div>
	</div>
</div>
</div>
</div>
</div>
<!-- HEADING-BANNER END -->
<!-- SHOPPING-CART-AREA START -->
<div class="login-area  pt-80 pb-80">
<div class="container">
<div class="row">



	<div class="col-lg-12">

	<form action="" method="POST" onsubmit="return false;" id="passwordform3">	
		<div class="customer-login text-left">
			<h4 class="title-1 title-border text-uppercase mb-30">ŞİFRE SIFIRLAMA EKRANI</h4>
			<input type="text" placeholder="Bayi e-posta" name="email">
			<input type="text" placeholder="Bayi yeni şifre" name="password1">
			<input type="text" placeholder="Bayi yeni şifre tekrar" name="password2">
			<input type="hidden" value="<?php echo $code;?>" name="code" />

			<button type="submit" onclick="passwordbutton3();" id="passwordbuton3" class="button-one submit-button mt-15">ŞİFREMİ YENİLE</button>
		</div>		
		</form>			
	</div>



</div>

</div>
</div>
<!-- SHOPPING-CART-AREA END -->
<!-- FOOTER START -->
<?php require_once 'inc/footer.php'; ?>
