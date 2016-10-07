<div id="splash-container" ng-controller="SplashCtrl as splashCtrl">

	<section id="asso" data-id="asso">
		
		<div>
			<h2>Section Home</h2>
		</div>

	</section>

	<section id="actus" data-id="actus">

		<div>
			<h2>Section Infos</h2>
	</section>

	<section id="instrumentheque" data-id="instrumentheque">
		
		<div>
			<h2>Section Instruments</h2>
		</div>

	</section>

	<section id="stations" data-id="stations">

		<!-- <div id="map-stations" ng-gmap markers="stations"></div> -->
		<ng-map center="[40.74, -74.18]"></ng-map>
<!-- 		<div map-lazy-load="https://maps.google.com/maps/api/js"
			map-lazy-load-params="{{googleMapsUrl}}">
			<ng-map center="41,-87" zoom="3"></ng-map>
		</div>
 -->
	</section>

	<section id="contact" data-id="contact">

		<div>
			<h2>Section Contact</h2>

			<form role="form" name="contactForm" osd-submit="splashCtrl.contact()" novalidate>
			    <osd-field attr="name">
			        <label class="control-label">Nom</label>
			        <input type="text" class="form-control" name="name"
			               ng-model="splashCtrl.currentUser.name" required="required">
			        <osd-error msg="Name required"></osd-error>
			    </osd-field>

			    <osd-field attr="email">
			        <label class="control-label">Email</label>
			        <input type="email" class="form-control" name="email"
			               ng-model="splashCtrl.currentUser.email" required="required">
			        <osd-error msg="Email required"></osd-error>
			        <osd-error error-type="email" msg="Email must be valid"></osd-error>
			    </osd-field>

			    <osd-field attr="message">
			        <label class="control-label">Message</label>
			        <textarea class="form-control" name="message"
			               ng-model="splashCtrl.currentUser.message" required="required"></textarea>
			        <osd-error msg="Message required"></osd-error>
			    </osd-field>

			    <button type="submit" class="btn btn-primary">Envoyer</button>
			</form>

		</div>

	</section>

	<section id="jeparticipe" data-id="jeparticipe">

		<div>
			<h2>Section Je participe</h2>
		</div>

	</section>

</div>

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr0LVacacrqDtM5AGRpumKAYJ1r8UE6yk"></script> -->
