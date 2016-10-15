<section id="contact" data-id="contact">

	<div>
		<h2>Section Contact</h2>

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

		    <button type="submit" class="btn btn-primary">Envoyer</button>
		</form>

	</div>

</section>