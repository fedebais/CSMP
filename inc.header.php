<link href="../../css/layout.css" rel="stylesheet" type="text/css" />
<link href="../../css/chosen.css" rel="stylesheet" type="text/css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="../../modulo/0_barra/ddaccordion.js" type="text/javascript" ></script>
<script src="../../js/chosen.jquery.min.js" type="text/javascript" ></script>

<script type="text/javascript">
$(document).ready(function(){

	var config = {
	  '.chosen-select'           : {disable_search_threshold: 10, allow_single_deselect:true},
	  '.chosen-select-deselect'  : {allow_single_deselect:true},
	  '.chosen-select-no-single' : {disable_search_threshold:10},
	  '.chosen-select-no-results': {no_results_text:'Nothing found.'},
	  '.chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
	  $(selector).chosen(config[selector]);
	}

});	
</script>
