
		<footer class="footer-distributed container-fluid">

        
			<div class="footer-left col1 col-xs-3 col-md-3 col-lg-3">

				<h3>Company<span>logo</span></h3>

				<p class="footer-links">
					·
					<a href="/condicionesVenta">Condiciones de venta</a></br>
					·
					<a href="/condicionesEmpresa">Condiciones de empresa</a></br>
					·
					<a href="/contacto">Contacto/Horarios</a></br>
					·
					<a href="/politicaPrivacidad">Política de privacidad</a></br>
					·
					<a href="/entregaTransporte">Entrega y transporte</a></br>
				</p>

				<p class="footer-company-name">{{ \GetSettings::companyName() }} &copy; {{ date("Y") }}</p>
			</div>

			<div class="footer-center col1 col-xs-3 col-md-3 col-lg-3">

				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>{{ \GetSettings::getStreet() }}</span> {{ \GetSettings::getTownAndCountry() }}</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>{{ \GetSettings::getContactPhone() }}</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:{{ \GetSettings::getContactMail() }}">{{ \GetSettings::getContactMail() }}</a></p>
				</div>

			</div>

			<div class="footer-right col1 col-xs-3 col-md-3 col-lg-3">

				<p class="footer-company-about">
					<span>About the company</span>
					Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
				</p>


				<div class="footer-icons">
<!--
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>
-->
				</div>

			</div>

		</footer>

	</body>

</html>
