@extends('layout')

@section('content')
<div class='container main-container'>


<h1>Plugin manager 
  <div class='pull-right'>
  <a href="admin/plugin/onlinestore" class='btn btn-info'><i class="fa fa-cloud-download" aria-hidden="true"></i> Download apps</a>
  <a id='upl' class='btn btn-primary' data-toggle='modal' data-target='.upload_plugin' <?php if(!$data['zip_enabled']){ echo "disabled"; } ?>><i class='fa fa-upload'></i>&nbspUpload new plugin</a>
  </div>
</h1>

</br>



<div class='list-group'>

<?php

foreach($all_plugin as $current_plugin){


  echo  "<div class='list-group-item ' style='height:120px;'>";
  	
      echo "<div class='col-md-10'>";

       echo Html::img($current_plugin->icon,"class='img img-thumbnail pull-left' onerror='this.src=\"storage/images/icons/plugin.png\"' style='width:80px;height:80px;margin-right:10px;'");

        echo "<h4 class='list-group-item-heading'>
              <a href='admin/plugin/".$current_plugin->dir_name."'>".$current_plugin->get_info('name')."</a> <small>version: ".$current_plugin->get_info('version')." | author: <a href='".$current_plugin->get_info('author_url')."'>".$current_plugin->get_info('author')."</a></small></h4>

            <p class='list-group-item-text' style='margin-bottom:8px;margin-right:70px;'>".$current_plugin->get_info('description')."</p>";

        echo "</div>";


        echo "<div class='col-md-2'>";
         
         if(file_exists("plugins/" .$current_plugin->dir_name ."/install.sql") && !Plugin::is_installed($current_plugin->dir_name)){
          echo "<a id='install' class='btn btn-primary btn-block' href='admin/plugin/install/".$current_plugin->dir_name."'>Install</a></br>";
          }
          else{
               echo "<a class='btn btn-success btn-block'>Installed</a>";
          }
          echo "<button class='btn btn-danger btn-block' data-toggle='modal' data-target='.delete_".$current_plugin->dir_name."' >Delete</button>";

         echo "</div>";



      echo "</div>";


   Bootstrap::delete_confirmation(
    "delete_".$current_plugin->dir_name,
    "Are you sure?",
    "<b>Delete this plugin: </b>".$current_plugin->get_info('name')." <b>?</b>",
    "<a href='admin/plugin/delete/".$current_plugin->dir_name."' type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete</a>
    <button type='button' class='btn btn-default' data-dismiss='modal'>Cencel</button>"
    );


       
}

?>


</div>


<div class='modal upload_plugin' id='create_file' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header modal-header-primary'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title'>New file</h4>
      </div>
      <div class='modal-body'>

<form action='admin/plugin/upload' method='POST' enctype='multipart/form-data'>
<div class='form-group'>
      <label for='file'>Upload file:</label>
      <input name='up_file[]' id='input-2' type='file' class='file' accept='.zip' multiple='true' data-show-upload='false' data-show-caption='true'>
    </div>


      </div>
      <div class='modal-footer'>
        <button type='submit' class='btn btn-primary'>Upload</button></form>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



</div>
@endsection