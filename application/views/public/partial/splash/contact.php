<section id="contact" data-id="contact">

    <h3 class="text-center">Contactez-nous !</h3>
    <div class="container">

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

<!--    <div class="col-xs-12 col-md-6 col-lg-3">

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=1442961679312676";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-page" data-href="https://www.facebook.com/contact.tuningfork/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/contact.tuningfork/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/contact.tuningfork/">L&#039;instrumenthèque</a></blockquote></div>
    </div>
 -->
</section>
