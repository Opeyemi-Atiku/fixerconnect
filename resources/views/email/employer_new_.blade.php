<link rel="stylesheet" href="https://fixer-connect.vipcarportal.com/css/apps/email.css">
  <div id="invoice-POS">
    <center id="top" >
      <div class="logo"></div>
      <img src="https://fixer-connect.vipcarportal.com/images/resource/logo.png" height="150px" style="z-index: 9999999;">
      <div class="info">
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="bot">

					<div id="legalcopy">
						<p class="legal">Hello, <strong>{{Auth::user()->name}}</strong><br/> thank you for signing up</p>
            <p class="legal">click the link to verify your account <a href="https://fixer-connect.vipcarportal.com/verificat_token_/{{Auth::user()->remember_token}}"><button>Verify</button></a></p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->
