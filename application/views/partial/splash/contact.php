<section id="contact" data-id="contact">

	<div class="container">
		<h3 class="text-center">Contactez-nous !</h3>

		<a class="btn btn-block btn-social btn-facebook" href="https://www.facebook.com/contact.tuningfork/" target="_blank" rel="noopener">
			<span class="fa fa-facebook"></span>
			Suivez-nous sur facebook
		</a>

		<form role="form" name="vm.contactForm" osd-submit="vm.contact()" novalidate>
		    <osd-field attr="name">
		        <label class="control-label">Nom</label>
		        <input type="text" class="form-control" name="name"
		               ng-model="vm.currentUser.name" required="required">
		        <osd-error msg="Nom requis"></osd-error>
		    </osd-field>

		    <osd-field attr="email">
		        <label class="control-label">Email</label>
		        <input type="email" class="form-control" name="email"
		               ng-model="vm.currentUser.email" required="required">
		        <osd-error msg="Email requis"></osd-error>
		        <osd-error error-type="email" msg="Email invalide"></osd-error>
		    </osd-field>

		    <osd-field attr="message">
		        <label class="control-label">Message</label>
		        <textarea class="form-control" name="message"
		               ng-model="vm.currentUser.message" required="required"></textarea>
		        <osd-error msg="Message requis"></osd-error>
		    </osd-field>

		    <button type="submit" class="btn btn-primary col-xs-12">Envoyer</button>
		</form>

	</div>

</section>