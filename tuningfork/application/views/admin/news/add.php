<h3><?php echo $title; ?></h3>

<br>

<?php echo form_open('admin/news/add', array('id' =>'add-news', 'class' => 'form-horizontal')); ?>

	<div class="form-group">
        <label for="titre" class="control-label col-sm-1 hidden-xs">Titre</label>
        <div class="col-sm-11 col-xs-12">
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" required>
        </div>
    </div>

	<div class="form-group">
        <label for="texte" class="control-label col-sm-1 hidden-xs">Texte</label>
        <div class="col-xs-12 col-sm-11">
        	<?php echo $toolbox; ?>
            <!-- <textarea type="text" class="form-control" id="texte" name="texte" placeholder="Text" rows="20" required></textarea> -->
            <div id="texte" name="texte" style="padding:5px;clear:both;width:100%;height:200px;border:1px solid #ccc;" contenteditable="true"></div>
        </div>
    </div>



</form>