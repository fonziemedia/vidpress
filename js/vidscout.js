//search form
jQuery(document).ready(function($){

if($('.svs-search').length > 0) /*note this refers to the menu item after the menu item where we put the glyphicon */
	{
		$('.svs-search').html('<div id="error"></div><form class="searchform" id="searchform" action="" role="search" method="get"><div class="nav-search-div"><input id="searchfield" type="text" data-validation="required" name="s" placeholder="Search Videos" /><button class="btn btn-primary" id="searchsubmit" type="submit">Go</button></div></form>'); 
	}

//validating our search form --- REED MORE ABOUT THE JQUERY VALIDATION PLUGIN
$('.svs-search').validate();

});